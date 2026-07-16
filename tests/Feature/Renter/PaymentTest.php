<?php

namespace Tests\Feature\Renter;

use App\Models\Booking;
use App\Models\User;
use App\Models\Venue;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class PaymentTest extends TestCase
{
    use RefreshDatabase;

    protected $renter;
    protected $venue;

    protected function setUp(): void
    {
        parent::setUp();
        $this->renter = User::factory()->create(['role' => 'renter', 'status' => 'approved']);
        $this->venue = Venue::create([
            'name' => 'Lapangan Uji Payment',
            'slug' => 'lapangan-uji-payment',
            'address' => 'Jalan',
            'description' => 'Desc',
            'price' => 50000,
            'time_unit_minutes' => 60,
            'max_capacity' => 10,
        ]);
    }

    /** @test */
    public function renter_can_upload_payment_proof()
    {
        Storage::fake('public');

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

        $file = UploadedFile::fake()->image('proof.jpg');

        $response = $this->post("/bookings/{$booking->booking_code}/pay", [
            'payment_proof' => $file,
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('payments', [
            'booking_id' => $booking->id,
            'status' => 'pending'
        ]);
        
        $this->assertDatabaseHas('bookings', [
            'id' => $booking->id,
            'status' => 'waiting'
        ]);
    }
}
