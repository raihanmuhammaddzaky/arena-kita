<?php

namespace App\Http\Controllers\Renter;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class RenterBookingController extends Controller
{
    public function index()
    {
        // Dummy data for bookings
        $bookings = collect([
            (object) [
                'id' => 1,
                'venue_name' => 'Premium Futsal Arena A',
                'date' => '24 Okt 2024',
                'time' => '18:00 - 20:00 WIB',
                'price' => 300000,
                'status' => 'Berhasil',
                'status_color' => 'bg-tertiary-fixed text-on-tertiary-fixed-variant'
            ],
            (object) [
                'id' => 2,
                'venue_name' => 'Serenity Tennis Club',
                'date' => '26 Okt 2024',
                'time' => '07:00 - 09:00 WIB',
                'price' => 400000,
                'status' => 'Menunggu Pembayaran',
                'status_color' => 'bg-[#f59e0b] text-on-primary'
            ],
            (object) [
                'id' => 3,
                'venue_name' => 'Oasis Badminton Hall',
                'date' => '20 Okt 2024',
                'time' => '19:00 - 21:00 WIB',
                'price' => 170000,
                'status' => 'Dibatalkan',
                'status_color' => 'bg-surface-variant text-on-surface-variant'
            ]
        ]);

        return view('renter.bookings.index', compact('bookings'));
    }

    public function show($id)
    {
        // Dummy data for single booking details
        $booking = (object) [
            'id' => $id,
            'booking_code' => 'BKG-2410-00' . $id,
            'venue_name' => 'Serenity Tennis Club',
            'venue_address' => 'Tangerang Selatan',
            'date' => '26 Oktober 2024',
            'time' => '07:00 - 09:00 WIB',
            'duration' => 2,
            'price_per_hour' => 200000,
            'subtotal' => 400000,
            'admin_fee' => 5000,
            'tax' => 44000, // 11%
            'total_price' => 449000,
            'status' => 'Menunggu Pembayaran',
            'deadline' => '15:00 WIB Hari ini',
            'venue_image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAWpNvN2gu93g5BqcNgDwAhLhd5wQ-u8li7wvrhT8VtMm8cUTGDcORxETq5p0jfLxIdsMiNYeJRJQxdsJi4j-iUQ3QcX87fRykemMI0VCyXmZ8pNBjtHsHFpK8Cy4Kzp8Tcy9l5vpk4mz8QwC305BUGYPHehwbc_pyT5KEplwz-TdZsuKeCGqoG1nx5scOcLtOx9Uzkg8sqwneYNuZ6fEP0ne219Mt60EX1us-g8dEUSqMW6FrLXw_pLA'
        ];

        return view('renter.bookings.show', compact('booking'));
    }
}
