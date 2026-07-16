<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserManagementTest extends TestCase
{
    use RefreshDatabase;

    protected $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->create(['role' => 'admin']);
    }

    /** @test */
    public function admin_can_view_users_list()
    {
        $this->actingAs($this->admin);

        $response = $this->get('/admin/users');
        $response->assertStatus(200);
    }

    /** @test */
    public function admin_can_approve_user()
    {
        $this->actingAs($this->admin);

        $renter = User::factory()->create(['role' => 'renter', 'status' => 'pending']);

        $response = $this->patch("/admin/users/{$renter->id}/approve");

        $response->assertRedirect();
        $this->assertDatabaseHas('users', [
            'id' => $renter->id,
            'status' => 'approved'
        ]);
    }

    /** @test */
    public function admin_can_reject_user()
    {
        $this->actingAs($this->admin);

        $renter = User::factory()->create(['role' => 'renter', 'status' => 'pending']);

        $response = $this->patch("/admin/users/{$renter->id}/reject");

        $response->assertRedirect();
        $this->assertDatabaseHas('users', [
            'id' => $renter->id,
            'status' => 'rejected'
        ]);
    }
}
