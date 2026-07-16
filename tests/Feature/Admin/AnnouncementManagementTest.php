<?php

namespace Tests\Feature\Admin;

use App\Models\Announcement;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AnnouncementManagementTest extends TestCase
{
    use RefreshDatabase;

    protected $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->create(['role' => 'admin']);
    }

    /** @test */
    public function admin_can_view_announcements_list()
    {
        $this->actingAs($this->admin);

        $response = $this->get('/admin/announcements');
        $response->assertStatus(200);
    }

    /** @test */
    public function admin_can_create_an_announcement()
    {
        $this->actingAs($this->admin);

        $response = $this->post('/admin/announcements', [
            'title' => 'Pengumuman Penting',
            'content' => 'Isi pengumuman yang sangat penting.',
            'is_active' => true,
        ]);

        $response->assertRedirect('/admin/announcements');
        $this->assertDatabaseHas('announcements', [
            'title' => 'Pengumuman Penting'
        ]);
    }

    /** @test */
    public function admin_can_update_an_announcement()
    {
        $this->actingAs($this->admin);

        $announcement = Announcement::create([
            'title' => 'Lama',
            'content' => 'Lama',
            'is_active' => false
        ]);

        $response = $this->put("/admin/announcements/{$announcement->id}", [
            'title' => 'Baru',
            'content' => 'Baru',
            'is_active' => true,
        ]);

        $response->assertRedirect('/admin/announcements');
        $this->assertDatabaseHas('announcements', [
            'id' => $announcement->id,
            'title' => 'Baru'
        ]);
    }

    /** @test */
    public function admin_can_delete_an_announcement()
    {
        $this->actingAs($this->admin);

        $announcement = Announcement::create([
            'title' => 'Hapus',
            'content' => 'Hapus',
            'is_active' => false
        ]);

        $response = $this->delete("/admin/announcements/{$announcement->id}");

        $response->assertRedirect('/admin/announcements');
        $this->assertDatabaseMissing('announcements', [
            'id' => $announcement->id,
        ]);
    }
}
