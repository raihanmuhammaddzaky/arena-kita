<?php

namespace Tests\Unit\Models;

use App\Models\Booking;
use App\Models\User;
use App\Models\Venue;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class BookingTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function bookings_table_has_expected_columns()
    {
        $this->assertTrue(
          Schema::hasColumns('bookings', [
            'id', 'booking_code', 'user_id', 'venue_id', 'booking_date', 'start_time', 'end_time', 'total_price', 'status'
        ]));
    }

    /** @test */
    public function a_booking_belongs_to_user_and_venue_and_has_one_payment()
    {
        $booking = new Booking();
        $this->assertTrue(method_exists($booking, 'user'));
        $this->assertTrue(method_exists($booking, 'venue'));
        $this->assertTrue(method_exists($booking, 'payment'));
    }

    /** @test */
    public function it_generates_booking_code_upon_creation()
    {
        $user = User::factory()->create();
        $venue = Venue::create([
            'name' => 'Lapangan Test',
            'slug' => 'lapangan-test',
            'address' => 'Test',
            'description' => 'Test',
            'price' => 50000,
            'time_unit_minutes' => 60,
            'max_capacity' => 10,
        ]);

        $booking = Booking::create([
            'user_id' => $user->id,
            'venue_id' => $venue->id,
            'booking_date' => now()->format('Y-m-d'),
            'start_time' => '10:00:00',
            'end_time' => '12:00:00',
            'total_price' => 100000,
            'status' => 'pending',
        ]);

        $this->assertNotNull($booking->booking_code);
        $this->assertStringStartsWith('BKG-', $booking->booking_code);
    }
}
