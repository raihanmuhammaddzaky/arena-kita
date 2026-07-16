<?php

namespace App\Http\Controllers\Renter;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\User;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RenterBookingController extends Controller
{
    public function index(Request $request)
    {
        // Karena belum ada sistem Login, ambil user 'renter' pertama
        $user = User::where('role', 'renter')->first();

        if ($user) {
            $query = Booking::with('venue')
                ->where('user_id', $user->id);

            // Filter: AND logic — setiap filter mempersempit hasil
            $search = $request->input('search');
            $date = $request->input('date');
            $status = $request->input('status');

            if ($search) {
                $query->where(function ($q) use ($search) {
                    $q->whereHas('venue', function ($venueQuery) use ($search) {
                        $venueQuery->where('name', 'like', '%' . $search . '%');
                    })
                    ->orWhere('booking_code', 'like', '%' . $search . '%');
                });
            }

            if ($date) {
                $query->where('booking_date', $date);
            }

            if ($status) {
                if ($status === 'completed') {
                    $query->where('status', 'confirmed')
                          ->whereRaw('CONCAT(booking_date, " ", end_time) < ?', [Carbon::now()]);
                } elseif ($status === 'confirmed') {
                    $query->where('status', 'confirmed')
                          ->whereRaw('CONCAT(booking_date, " ", end_time) >= ?', [Carbon::now()]);
                } else {
                    $query->where('status', $status);
                }
            }

            // Batal otomatis untuk yang pending lebih dari 5 menit
            Booking::where('status', 'pending')
                   ->where('created_at', '<', Carbon::now()->subMinutes(5))
                   ->update(['status' => 'cancelled']);

            $bookingsRaw = $query->orderBy('booking_date', 'desc')->get();

            $bookings = $bookingsRaw->map(function ($booking) {
                // Kalkulasi status dinamis: jika confirmed dan waktunya sudah lewat, maka completed
                $endDateTime = Carbon::parse($booking->booking_date->format('Y-m-d') . ' ' . $booking->end_time);
                $isCompleted = $booking->status === 'confirmed' && $endDateTime->isPast();
                
                $actualStatus = $isCompleted ? 'completed' : $booking->status;

                $statusMap = [
                    'pending' => ['label' => 'Pending', 'color' => 'bg-[#f59e0b] text-on-primary'],
                    'waiting' => ['label' => 'Menunggu Konfirmasi', 'color' => 'bg-secondary text-on-secondary'],
                    'confirmed' => ['label' => 'Confirmed', 'color' => 'bg-tertiary-fixed text-on-tertiary-fixed-variant'],
                    'completed' => ['label' => 'Completed', 'color' => 'bg-[#3b82f6] text-white'],
                    'cancelled' => ['label' => 'Cancelled', 'color' => 'bg-surface-variant text-on-surface-variant'],
                ];

                $status = $statusMap[$actualStatus] ?? ['label' => ucfirst($actualStatus), 'color' => 'bg-surface-variant text-on-surface-variant'];

                return (object) [
                    'id' => $booking->id,
                    'booking_code' => $booking->booking_code,
                    'venue_name' => $booking->venue->name,
                    'date' => Carbon::parse($booking->booking_date)->translatedFormat('d M Y'),
                    'time' => Carbon::parse($booking->start_time)->format('H:i') . ' - ' . Carbon::parse($booking->end_time)->format('H:i') . ' WIB',
                    'price' => $booking->total_price,
                    'status' => $status['label'],
                    'status_color' => $status['color'],
                ];
            });
        } else {
            $bookings = collect();
        }

        return view('renter.bookings.index', compact('bookings'));
    }

    public function store(Request $request, $venue_id)
    {
        $request->validate([
            'date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ]);

        // Cek overlap booking
        $isBooked = Booking::where('venue_id', $venue_id)
            ->where('booking_date', $request->date)
            ->whereIn('status', ['pending', 'confirmed'])
            ->where(function ($query) use ($request) {
                $query->where(function ($q) use ($request) {
                    $q->where('start_time', '<', $request->end_time)
                      ->where('end_time', '>', $request->start_time);
                });
            })->exists();

        if ($isBooked) {
            return redirect()->back()->with('error', 'Maaf, jadwal ini baru saja dipesan oleh orang lain. Silakan pilih jadwal lain.');
        }

        // Kalkulasi harga
        $venue = \App\Models\Venue::findOrFail($venue_id);
        $duration = Carbon::parse($request->start_time)->diffInHours(Carbon::parse($request->end_time));
        $totalPrice = $duration * $venue->price;

        // User dummy (karena auth belum aktif)
        $user = User::where('role', 'renter')->first();

        // Buat booking
        $booking = Booking::create([
            'user_id' => $user->id ?? 1,
            'venue_id' => $venue_id,
            'booking_date' => $request->date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'total_price' => $totalPrice,
            'status' => 'pending',
        ]);

        return redirect()->route('renter.bookings.show', $booking->booking_code)
                         ->with('success', 'Berhasil mengamankan jadwal!');
    }

    public function show($booking_code)
    {
        $booking = Booking::with(['venue.mainImage', 'payment'])->where('booking_code', $booking_code)->firstOrFail();

        // Batal otomatis jika lebih dari 5 menit
        if ($booking->status === 'pending' && Carbon::parse($booking->created_at)->addMinutes(5)->isPast()) {
            $booking->update(['status' => 'cancelled']);
            $booking->status = 'cancelled'; // Update local object
        }

        $statusMap = [
            'pending' => 'Pending',
            'waiting' => 'Waiting Verification',
            'confirmed' => 'Confirmed',
            'cancelled' => 'Cancelled',
        ];

        $duration = Carbon::parse($booking->start_time)->diffInHours(Carbon::parse($booking->end_time));
        $pricePerHour = $booking->venue->price;
        $subtotal = $pricePerHour * $duration;
        $adminFee = 5000;
        $tax = (int) round($subtotal * 0.11);

        $bookingData = (object) [
            'id' => $booking->id,
            'booking_code' => $booking->booking_code,
            'venue_name' => $booking->venue->name,
            'venue_address' => $booking->venue->address,
            'date' => Carbon::parse($booking->booking_date)->translatedFormat('d F Y'),
            'time' => Carbon::parse($booking->start_time)->format('H:i') . ' - ' . Carbon::parse($booking->end_time)->format('H:i') . ' WIB',
            'duration' => $duration,
            'price_per_hour' => $pricePerHour,
            'subtotal' => $subtotal,
            'admin_fee' => $adminFee,
            'tax' => $tax,
            'total_price' => $subtotal + $adminFee + $tax,
            'status' => $statusMap[$booking->status] ?? ucfirst($booking->status),
            'deadline' => Carbon::parse($booking->created_at)->addMinutes(5)->format('H:i') . ' WIB Hari ini',
            'venue_image' => $booking->venue->mainImage ? $booking->venue->mainImage->image_path : 'https://placehold.co/600x400?text=No+Image',
        ];

        return view('renter.bookings.show', compact('booking'))->with('booking', $bookingData);
    }

    public function cancel($booking_code)
    {
        $booking = Booking::where('booking_code', $booking_code)->firstOrFail();
        
        if ($booking->status === 'pending') {
            $booking->update(['status' => 'cancelled']);
            return redirect()->back()->with('success', 'Pesanan berhasil dibatalkan.');
        }

        return redirect()->back()->with('error', 'Pesanan tidak dapat dibatalkan karena status sudah bukan pending.');
    }

    public function pay(Request $request, $booking_code)
    {
        $booking = Booking::where('booking_code', $booking_code)->firstOrFail();

        // Validasi: hanya pesanan pending yang belum kedaluwarsa yang bisa dibayar
        if ($booking->status !== 'pending' || Carbon::parse($booking->created_at)->addMinutes(5)->isPast()) {
            return redirect()->back()->with('error', 'Pembayaran gagal. Pesanan sudah dibatalkan atau waktu pembayaran telah habis.');
        }

        $request->validate([
            'payment_proof' => 'required|file|mimes:jpeg,png,jpg,pdf|max:5120',
        ]);

        $path = $request->file('payment_proof')->store('payments', 'public');

        Payment::create([
            'booking_id' => $booking->id,
            'proof_image' => $path,
            'status' => 'pending', // Atau 'completed' jika ingin langsung terkonfirmasi
        ]);

        // Mengubah status booking menjadi waiting verification
        $booking->update(['status' => 'waiting']);

        return redirect()->back()->with('success', 'Bukti pembayaran berhasil diunggah. Mohon tunggu konfirmasi dari Admin.');
    }

    public function invoice($booking_code)
    {
        $booking = Booking::with('venue', 'user')->where('booking_code', $booking_code)->firstOrFail();

        // Cek apakah booking sudah dikonfirmasi (atau completed)
        if (!in_array($booking->status, ['confirmed', 'completed'])) {
            return redirect()->route('renter.bookings.show', $booking_code)->with('error', 'Tiket belum tersedia karena pembayaran belum dikonfirmasi.');
        }

        $duration = Carbon::parse($booking->start_time)->diffInHours(Carbon::parse($booking->end_time));
        $pricePerHour = $booking->venue->price;
        $subtotal = $pricePerHour * $duration;
        $adminFee = 5000;
        $tax = (int) round($subtotal * 0.11);

        $bookingData = (object) [
            'booking_code' => $booking->booking_code,
            'renter_name' => $booking->user->name ?? 'Penyewa',
            'venue_name' => $booking->venue->name,
            'venue_address' => $booking->venue->address,
            'date' => Carbon::parse($booking->booking_date)->translatedFormat('d F Y'),
            'time' => Carbon::parse($booking->start_time)->format('H:i') . ' - ' . Carbon::parse($booking->end_time)->format('H:i') . ' WIB',
            'duration' => $duration,
            'total_price' => $subtotal + $adminFee + $tax,
            'status' => 'LUNAS (PAID)',
            'created_at' => Carbon::parse($booking->created_at)->translatedFormat('d F Y H:i WIB'),
        ];

        return view('renter.bookings.invoice', compact('bookingData'));
    }
}
