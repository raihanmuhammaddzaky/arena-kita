<?php

namespace Tests\Feature\Renter;

use App\Models\Booking;
use App\Models\User;
use App\Models\Venue;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookingTest extends TestCase
{
    use RefreshDatabase;

    protected $renter;
    protected $venue;

    protected function setUp(): void
    {
        parent::setUp();
        $this->renter = User::factory()->create(['role' => 'renter', 'status' => 'approved']);
        $this->venue = Venue::create([
            'name' => 'Lapangan Uji',
            'slug' => 'lapangan-uji',
            'address' => 'Jalan',
            'description' => 'Desc',
            'price' => 50000,
            'time_unit_minutes' => 60,
            'max_capacity' => 10,
        ]);
    }

    /** @test */
    public function renter_can_view_venues_catalog()
    {
        $this->actingAs($this->renter);

        $response = $this->get('/venues');
        $response->assertStatus(200);
        $response->assertSee('Lapangan Uji');
    }

    /** @test */
    public function renter_can_make_a_booking()
    {
        $this->actingAs($this->renter);

        $response = $this->post("/venues/{$this->venue->slug}/book", [
            'date' => now()->addDay()->format('Y-m-d'),
            'start_time' => '10:00',
            'end_time' => '12:00',
        ]);

        $response->assertRedirect();
        
        $this->assertDatabaseHas('bookings', [
            'user_id' => $this->renter->id,
            'venue_id' => $this->venue->id,
            'start_time' => '10:00',
            'end_time' => '12:00'
        ]);
    }

    /** @test */
    public function renter_cannot_double_book_a_slot()
    {
        $this->actingAs($this->renter);

        // create existing booking
        Booking::create([
            'user_id' => $this->renter->id,
            'venue_id' => $this->venue->id,
            'booking_date' => now()->addDay()->format('Y-m-d'),
            'start_time' => '10:00',
            'end_time' => '12:00',
            'total_price' => 100000,
            'status' => 'pending'
        ]);

        $response = $this->post("/venues/{$this->venue->slug}/book", [
            'date' => now()->addDay()->format('Y-m-d'),
            'start_time' => '10:00',
            'end_time' => '12:00',
        ]);

        $response->assertSessionHas('error'); 
    }

    /** @test */
    public function renter_can_view_their_bookings()
    {
        $this->actingAs($this->renter);

        Booking::create([
            'user_id' => $this->renter->id,
            'venue_id' => $this->venue->id,
            'booking_date' => now()->addDay()->format('Y-m-d'),
            'start_time' => '10:00:00',
            'end_time' => '12:00:00',
            'total_price' => 100000,
            'status' => 'pending'
        ]);

        $response = $this->get('/bookings');
        $response->assertStatus(200);
    }
    
    /** @test */
    public function renter_can_cancel_pending_booking()
    {
        $this->actingAs($this->renter);

        $booking = Booking::create([
            'user_id' => $this->renter->id,
            'venue_id' => $this->venue->id,
            'booking_date' => now()->addDay()->format('Y-m-d'),
            'start_time' => '10:00:00',
            'end_time' => '12:00:00',
            'total_price' => 100000,
            'status' => 'pending'
        ]);

        $response = $this->post("/bookings/{$booking->booking_code}/cancel");

        $response->assertRedirect();
        $this->assertDatabaseHas('bookings', [
            'id' => $booking->id,
            'status' => 'cancelled'
        ]);
    }
}
