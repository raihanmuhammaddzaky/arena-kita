<?php

namespace Tests\Unit\Models;

use App\Models\Venue;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class VenueTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function venues_table_has_expected_columns()
    {
        $this->assertTrue(
          Schema::hasColumns('venues', [
            'id','name', 'slug', 'address', 'description', 'price', 'time_unit_minutes', 'max_capacity'
        ]));
    }

    /** @test */
    public function a_venue_has_many_bookings()
    {
        $venue = new Venue();
        $this->assertTrue(method_exists($venue, 'bookings'));
    }

    /** @test */
    public function a_venue_has_many_images()
    {
        $venue = new Venue();
        $this->assertTrue(method_exists($venue, 'images'));
    }
    
    /** @test */
    public function a_venue_has_one_main_image()
    {
        $venue = new Venue();
        $this->assertTrue(method_exists($venue, 'mainImage'));
    }

    /** @test */
    public function venue_route_key_name_is_slug()
    {
        $venue = new Venue();
        $this->assertEquals('slug', $venue->getRouteKeyName());
    }
}
