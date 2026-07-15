<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Booking;
use App\Models\User;
use App\Models\Venue;
use Carbon\Carbon;

class BookingSeeder extends Seeder
{
    public function run(): void
    {
        $renter = User::where('email', 'renter@arenakita.com')->first();
        $venue1 = Venue::where('slug', 'premium-futsal-arena-a')->first();
        $venue2 = Venue::where('slug', 'serenity-tennis-club')->first();
        $venue3 = Venue::where('slug', 'oasis-badminton-hall')->first();

        // 1. Unpaid Booking
        Booking::create([
            'user_id' => $renter->id,
            'venue_id' => $venue1->id,
            'booking_date' => Carbon::today()->addDays(2),
            'start_time' => '18:00:00',
            'end_time' => '20:00:00',
            'total_price' => $venue1->price * 2,
            'status' => 'pending',
        ]);

        // 2. Confirmed Booking (Upcoming)
        Booking::create([
            'user_id' => $renter->id,
            'venue_id' => $venue2->id,
            'booking_date' => Carbon::today()->addDays(5),
            'start_time' => '07:00:00',
            'end_time' => '09:00:00',
            'total_price' => $venue2->price * 2,
            'status' => 'confirmed',
        ]);

        // 3. Completed/Past Booking
        Booking::create([
            'user_id' => $renter->id,
            'venue_id' => $venue3->id,
            'booking_date' => Carbon::today()->subDays(5),
            'start_time' => '19:00:00',
            'end_time' => '21:00:00',
            'total_price' => $venue3->price * 2,
            'status' => 'confirmed', // Assuming past dates are implicitly 'completed' for UI purposes
        ]);
        
        // 4. Cancelled Booking
        Booking::create([
            'user_id' => $renter->id,
            'venue_id' => $venue3->id,
            'booking_date' => Carbon::today()->subDays(2),
            'start_time' => '10:00:00',
            'end_time' => '12:00:00',
            'total_price' => $venue3->price * 2,
            'status' => 'cancelled',
        ]);
        // 5. Test Availability Grid (Today's Bookings on Venue 1)
        Booking::create([
            'user_id' => $renter->id,
            'venue_id' => $venue1->id,
            'booking_date' => Carbon::today(),
            'start_time' => '10:00:00',
            'end_time' => '12:00:00',
            'total_price' => $venue1->price * 2,
            'status' => 'confirmed',
        ]);

        Booking::create([
            'user_id' => $renter->id,
            'venue_id' => $venue1->id,
            'booking_date' => Carbon::today(),
            'start_time' => '18:00:00',
            'end_time' => '20:00:00',
            'total_price' => $venue1->price * 2,
            'status' => 'pending',
        ]);
    }
}
