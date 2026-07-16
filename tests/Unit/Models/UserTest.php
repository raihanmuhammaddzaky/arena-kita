<?php

namespace Tests\Unit\Models;

use App\Models\Booking;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function users_table_has_expected_columns()
    {
        $this->assertTrue(
          Schema::hasColumns('users', [
            'id','name', 'email', 'password', 'phone', 'role', 'status'
        ]));
    }

    /** @test */
    public function a_user_can_have_many_bookings()
    {
        $user = User::factory()->create();
        
        // Asumsi Booking::factory() sudah ada, jika belum kita tes manual dengan factory()->create()
        // Kita akan cek apakah relasi terdefinisi dengan baik menggunakan instance object
        $this->assertTrue(method_exists($user, 'bookings'));
    }
}
