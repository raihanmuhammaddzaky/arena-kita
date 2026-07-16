<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guest_can_view_login_page()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
        $response->assertSee('Login');
    }

    /** @test */
    public function guest_can_view_register_page()
    {
        $response = $this->get('/register');
        $response->assertStatus(200);
        $response->assertSee('Sign Up');
    }

    /** @test */
    public function guest_can_register()
    {
        $response = $this->post('/register', [
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'phone' => '081234567890',
        ]);

        $response->assertRedirect('/login');
        $this->assertDatabaseHas('users', [
            'email' => 'johndoe@example.com',
            'role' => 'renter',
            'status' => 'pending'
        ]);
    }

    /** @test */
    public function renter_can_login_and_redirected_to_dashboard()
    {
        $renter = User::factory()->create([
            'role' => 'renter',
            'password' => bcrypt('password')
        ]);

        $response = $this->post('/login', [
            'email' => $renter->email,
            'password' => 'password',
        ]);

        $response->assertRedirect('/dashboard');
    }

    /** @test */
    public function admin_can_login_and_redirected_to_admin_dashboard()
    {
        $admin = User::factory()->create([
            'role' => 'admin',
            'password' => bcrypt('password')
        ]);

        $responseAdmin = $this->post('/login', [
            'email' => $admin->email,
            'password' => 'password',
        ]);

        $responseAdmin->assertRedirect('/admin/dashboard');
    }

    /** @test */
    public function logged_in_user_can_logout()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post('/logout');
        $response->assertRedirect('/login');
        $this->assertGuest();
    }

    /** @test */
    public function renter_cannot_access_admin_routes()
    {
        $renter = User::factory()->create(['role' => 'renter']);
        $this->actingAs($renter);

        // Assuming middleware checks role inside Admin routes. Wait, does it?
        // In web.php there is no specific middleware mentioned for role 'admin', maybe it's checked inside the controller?
        // Let's verify by just sending request. If there's an abort(403), it will be caught here.
        // If not, we might need to add it or the test will fail and we fix the bug!
        
        $response = $this->get('/admin/dashboard');
        // Let's assert forbidden or redirect depending on how it's implemented.
        // Actually, if it's not implemented, this test will fail, which is exactly why we test.
        $this->assertTrue(in_array($response->status(), [403, 401, 302, 404]));
    }
}
