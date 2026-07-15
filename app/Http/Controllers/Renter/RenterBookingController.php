<?php

namespace App\Http\Controllers\Renter;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\User;
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

            $bookingsRaw = $query->orderBy('booking_date', 'desc')->get();

            $bookings = $bookingsRaw->map(function ($booking) {
                // Kalkulasi status dinamis: jika confirmed dan waktunya sudah lewat, maka completed
                $endDateTime = Carbon::parse($booking->booking_date->format('Y-m-d') . ' ' . $booking->end_time);
                $isCompleted = $booking->status === 'confirmed' && $endDateTime->isPast();
                
                $actualStatus = $isCompleted ? 'completed' : $booking->status;

                $statusMap = [
                    'pending' => ['label' => 'Pending', 'color' => 'bg-[#f59e0b] text-on-primary'],
                    'confirmed' => ['label' => 'Confirmed', 'color' => 'bg-tertiary-fixed text-on-tertiary-fixed-variant'],
                    'completed' => ['label' => 'Completed', 'color' => 'bg-[#3b82f6] text-white'],
                    'cancelled' => ['label' => 'Cancelled', 'color' => 'bg-surface-variant text-on-surface-variant'],
                ];

                $status = $statusMap[$actualStatus] ?? ['label' => ucfirst($actualStatus), 'color' => 'bg-surface-variant text-on-surface-variant'];

                return (object) [
                    'id' => $booking->id,
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

    public function show($id)
    {
        $booking = Booking::with(['venue.mainImage', 'payment'])->findOrFail($id);

        $statusMap = [
            'pending' => 'Pending',
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
            'deadline' => Carbon::parse($booking->created_at)->addHours(2)->format('H:i') . ' WIB Hari ini',
            'venue_image' => $booking->venue->mainImage ? $booking->venue->mainImage->image_path : 'https://placehold.co/600x400?text=No+Image',
        ];

        return view('renter.bookings.show', compact('booking'))->with('booking', $bookingData);
    }
}
