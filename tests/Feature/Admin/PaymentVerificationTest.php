<?php

namespace Tests\Feature\Admin;

use App\Models\Booking;
use App\Models\Payment;
use App\Models\User;
use App\Models\Venue;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PaymentVerificationTest extends TestCase
{
    use RefreshDatabase;

    protected $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->create(['role' => 'admin']);
    }

    /** @test */
    public function admin_can_view_payments_list()
    {
        $this->actingAs($this->admin);

        $response = $this->get('/admin/payments');
        $response->assertStatus(200);
    }

    /** @test */
    public function admin_can_verify_payment()
    {
        $this->actingAs($this->admin);

        $user = User::factory()->create();
        $venue = Venue::create([
            'name' => 'Lap',
            'slug' => 'lap',
            'address' => 'Lap',
            'description' => 'Lap',
            'price' => 10000,
            'time_unit_minutes' => 60,
            'max_capacity' => 10
        ]);

        $booking = Booking::create([
            'user_id' => $user->id,
            'venue_id' => $venue->id,
            'booking_date' => now()->format('Y-m-d'),
            'start_time' => '10:00:00',
            'end_time' => '11:00:00',
            'total_price' => 10000,
            'status' => 'waiting'
        ]);

        $payment = Payment::create([
            'booking_id' => $booking->id,
            'proof_image' => 'test.jpg',
            'status' => 'pending'
        ]);

        $response = $this->patch("/admin/payments/{$payment->id}/verify");

        $response->assertRedirect();
        $this->assertDatabaseHas('payments', [
            'id' => $payment->id,
            'status' => 'verified'
        ]);
        $this->assertDatabaseHas('bookings', [
            'id' => $booking->id,
            'status' => 'confirmed'
        ]);
    }

    /** @test */
    public function admin_can_reject_payment()
    {
        $this->actingAs($this->admin);

        $user = User::factory()->create();
        $venue = Venue::create([
            'name' => 'Lap2',
            'slug' => 'lap2',
            'address' => 'Lap2',
            'description' => 'Lap2',
            'price' => 10000,
            'time_unit_minutes' => 60,
            'max_capacity' => 10
        ]);

        $booking = Booking::create([
            'user_id' => $user->id,
            'venue_id' => $venue->id,
            'booking_date' => now()->format('Y-m-d'),
            'start_time' => '10:00:00',
            'end_time' => '11:00:00',
            'total_price' => 10000,
            'status' => 'waiting'
        ]);

        $payment = Payment::create([
            'booking_id' => $booking->id,
            'proof_image' => 'test2.jpg',
            'status' => 'pending'
        ]);

        $response = $this->patch("/admin/payments/{$payment->id}/reject");

        $response->assertRedirect();
        $this->assertDatabaseHas('payments', [
            'id' => $payment->id,
            'status' => 'rejected'
        ]);
        $this->assertDatabaseHas('bookings', [
            'id' => $booking->id,
            'status' => 'cancelled' // Or whatever logic it should be upon rejection
        ]);
    }
}
