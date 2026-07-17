<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Venue;
use App\Models\Booking;

class ArenaKitaComprehensiveTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->admin = User::create([
            'name' => 'Admin',
            'email' => 'admin_test@arenakita.com',
            'phone' => '0811111',
            'password' => bcrypt('password'),
            'role' => 'admin',
            'status' => 'approved',
        ]);
        
        $this->venue = Venue::create([
            'name' => 'Test Venue',
            'slug' => 'test-venue',
            'address' => 'Jl. Test 1',
            'description' => 'Desc',
            'price' => 100000,
            'time_unit_minutes' => 60,
            'max_capacity' => 10,
        ]);
    }

    /** @test */
    public function admin_can_approve_and_reject_users()
    {
        $pendingUser = User::create([
            'name' => 'Pending',
            'email' => 'pending@test.com',
            'phone' => '123',
            'password' => bcrypt('password'),
            'role' => 'renter',
            'status' => 'pending',
        ]);

        $this->actingAs($this->admin);

        // Approve user
        $response = $this->patch(route('admin.users.approve', $pendingUser->id));
        $response->assertRedirect();
        $this->assertDatabaseHas('users', ['id' => $pendingUser->id, 'status' => 'approved']);

        // Reject user
        $pendingUser2 = User::create([
            'name' => 'Pending 2',
            'email' => 'pending2@test.com',
            'phone' => '123',
            'password' => bcrypt('password'),
            'role' => 'renter',
            'status' => 'pending',
        ]);

        $response2 = $this->patch(route('admin.users.reject', $pendingUser2->id));
        $response2->assertRedirect();
        $this->assertDatabaseHas('users', ['id' => $pendingUser2->id, 'status' => 'rejected']);
    }

    /** @test */
    public function admin_venue_creation_validates_required_fields()
    {
        $this->actingAs($this->admin);

        $response = $this->post(route('admin.venues.store'), [
            'name' => '', // Empty to trigger validation error
            'price' => 'invalid_price',
        ]);

        $response->assertSessionHasErrors(['name', 'address', 'price', 'main_image']);
    }

    /** @test */
    public function renter_can_book_venue_and_it_becomes_pending()
    {
        $renter = User::create([
            'name' => 'Renter',
            'email' => 'renter_ok@test.com',
            'phone' => '123',
            'password' => bcrypt('password'),
            'role' => 'renter',
            'status' => 'approved',
        ]);

        $this->actingAs($renter);

        // Test normal booking
        $response2 = $this->post(route('renter.venues.book', $this->venue->slug), [
            'date' => '2026-08-01',
            'start_time' => '10:00',
            'end_time' => '12:00'
        ]);

        $response2->assertRedirect(); // Should redirect to bookings.show
        
        // Assert booking exists in db
        $this->assertDatabaseHas('bookings', [
            'venue_id' => $this->venue->id,
            'user_id' => $renter->id,
            'status' => 'pending',
            'start_time' => '10:00',
            'end_time' => '12:00',
        ]);
    }

    /** @test */
    public function renter_cannot_book_overlapping_time()
    {
        $renter = User::create([
            'name' => 'Renter',
            'email' => 'renter_overlap@test.com',
            'phone' => '123',
            'password' => bcrypt('password'),
            'role' => 'renter',
            'status' => 'approved',
        ]);

        Booking::create([
            'booking_code' => 'BKG-001',
            'user_id' => $renter->id,
            'venue_id' => $this->venue->id,
            'booking_date' => '2026-08-02',
            'start_time' => '13:00:00',
            'end_time' => '15:00:00',
            'status' => 'confirmed',
            'total_price' => 200000,
        ]);

        $this->actingAs($renter);

        $response = $this->post(route('renter.venues.book', $this->venue->slug), [
            'date' => '2026-08-02',
            'start_time' => '14:00',
            'end_time' => '16:00'
        ]);

        $response->assertSessionHas('error');
    }
}
