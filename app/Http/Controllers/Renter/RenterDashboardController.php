<?php

namespace App\Http\Controllers\Renter;

use App\Http\Controllers\Controller;
use App\Models\Venue;
use App\Models\Booking;
use App\Models\User;
use App\Models\Announcement;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RenterDashboardController extends Controller
{
    public function index()
    {
        // Karena belum ada sistem Login, kita pakai data user 'renter' pertama
        $user = User::where('role', 'renter')->first() ?? (object) ['name' => 'Pengguna', 'id' => 0];

        // =============================================
        // 1. MENUNGGU PEMBAYARAN (status = 'pending')
        // =============================================
        $unpaidBookingRaw = Booking::with('venue')
            ->where('user_id', $user->id)
            ->where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->first();

        $unpaidBooking = null;
        if ($unpaidBookingRaw) {
            $unpaidBooking = (object) [
                'id' => $unpaidBookingRaw->id,
                'venue_name' => $unpaidBookingRaw->venue->name,
                'deadline' => Carbon::parse($unpaidBookingRaw->created_at)->addHours(2)->format('H:i'),
            ];
        }

        // =============================================
        // 2. PAPAN PENGUMUMAN
        // =============================================
        $announcements = Announcement::latest()->take(2)->get();

        // =============================================
        // 3. REKOMENDASI LAPANGAN
        // =============================================
        $featuredVenues = Venue::with('mainImage')->where('is_active', true)->inRandomOrder()->take(3)->get();

        // =============================================
        // 4. JADWAL TERDEKAT (hanya status 'confirmed')
        //    Booking yang sudah dibayar & tanggalnya >= hari ini
        // =============================================
        $upcomingBookingsRaw = Booking::with('venue')
            ->where('user_id', $user->id)
            ->where('status', 'confirmed')
            ->where('booking_date', '>=', Carbon::today())
            ->orderBy('booking_date', 'asc')
            ->orderBy('start_time', 'asc')
            ->take(2)
            ->get();

        $upcomingBookings = $upcomingBookingsRaw->map(function ($booking) {
            return (object) [
                'id' => $booking->id,
                'booking_code' => $booking->booking_code,
                'venue_name' => $booking->venue->name,
                'date' => Carbon::parse($booking->booking_date)->translatedFormat('d F Y'),
                'time' => Carbon::parse($booking->start_time)->format('H:i') . ' - ' . Carbon::parse($booking->end_time)->format('H:i') . ' WIB',
                'status' => 'Disewa',
            ];
        });

        // =============================================
        // 5. AKTIVITAS TERAKHIR
        //    Booking yang sudah lewat tanggalnya atau cancelled
        // =============================================
        $recentBookingsRaw = Booking::with('venue')
            ->where('user_id', $user->id)
            ->where(function ($query) {
                $query->where('booking_date', '<', Carbon::today())
                      ->orWhere('status', 'cancelled');
            })
            ->orderBy('booking_date', 'desc')
            ->take(2)
            ->get();

        $recentBookings = $recentBookingsRaw->map(function ($booking) {
            $statusLabel = match ($booking->status) {
                'confirmed' => 'Selesai',
                'cancelled' => 'Dibatalkan',
                default => ucfirst($booking->status),
            };

            return (object) [
                'id' => $booking->id,
                'booking_code' => $booking->booking_code,
                'venue_name' => $booking->venue->name,
                'date' => Carbon::parse($booking->booking_date)->translatedFormat('d F Y'),
                'time' => Carbon::parse($booking->start_time)->format('H:i') . ' - ' . Carbon::parse($booking->end_time)->format('H:i') . ' WIB',
                'status' => $statusLabel,
            ];
        });

        return view('renter.dashboard', compact('user', 'unpaidBooking', 'announcements', 'featuredVenues', 'upcomingBookings', 'recentBookings'));
    }
}
