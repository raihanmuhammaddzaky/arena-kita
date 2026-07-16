<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use App\Models\Venue;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VenueManagementTest extends TestCase
{
    use RefreshDatabase;

    protected $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->create(['role' => 'admin']);
    }

    /** @test */
    public function admin_can_view_venues_list()
    {
        $this->actingAs($this->admin);

        $response = $this->get('/admin/venues');
        $response->assertStatus(200);
    }

    /** @test */
    public function admin_can_create_a_venue()
    {
        $this->actingAs($this->admin);

        $response = $this->post('/admin/venues', [
            'name' => 'Lapangan Baru',
            'address' => 'Jalan Baru',
            'description' => 'Deskripsi lapangan baru',
            'price' => 150000,
            'time_unit_minutes' => 60,
            'max_capacity' => 12,
            'main_image' => \Illuminate\Http\UploadedFile::fake()->image('venue.jpg')
        ]);

        $response->assertRedirect('/admin/venues');
        $this->assertDatabaseHas('venues', [
            'name' => 'Lapangan Baru',
            'slug' => \Illuminate\Support\Str::slug('Lapangan Baru')
        ]);
    }

    /** @test */
    public function admin_can_update_a_venue()
    {
        $this->actingAs($this->admin);

        $venue = Venue::create([
            'name' => 'Lapangan Lama',
            'slug' => 'lapangan-lama',
            'address' => 'Jalan',
            'description' => 'Desc',
            'price' => 50000,
            'time_unit_minutes' => 60,
            'max_capacity' => 10,
        ]);

        $response = $this->put("/admin/venues/{$venue->slug}", [
            'name' => 'Lapangan Updated',
            'address' => 'Jalan Updated',
            'description' => 'Desc Updated',
            'price' => 75000,
            'time_unit_minutes' => 60,
            'max_capacity' => 15,
        ]);

        $response->assertRedirect('/admin/venues/lapangan-updated');
        $this->assertDatabaseHas('venues', [
            'id' => $venue->id,
            'name' => 'Lapangan Updated'
        ]);
    }

    /** @test */
    public function admin_can_delete_a_venue()
    {
        $this->actingAs($this->admin);

        $venue = Venue::create([
            'name' => 'Lapangan Hapus',
            'slug' => 'lapangan-hapus',
            'address' => 'Jalan',
            'description' => 'Desc',
            'price' => 50000,
            'time_unit_minutes' => 60,
            'max_capacity' => 10,
        ]);

        $response = $this->delete("/admin/venues/{$venue->slug}");

        $response->assertRedirect('/admin/venues');
        $this->assertDatabaseMissing('venues', [
            'id' => $venue->id,
        ]);
    }
}
