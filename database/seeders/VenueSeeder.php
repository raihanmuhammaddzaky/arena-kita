<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Venue;

class VenueSeeder extends Seeder
{
    public function run(): void
    {
        $venue1 = Venue::create([
            'name' => 'Lapangan Badminton A',
            'address' => 'Jl. Olahraga No. 1, Jakarta',
            'description' => 'Lapangan badminton premium dengan karpet vinyl standar BWF.',
            'price' => 50000,
            'time_unit_minutes' => 60,
            'max_capacity' => 4,
            'is_active' => true,
        ]);
        
        $venue1->images()->createMany([
            ['image_path' => 'https://images.unsplash.com/photo-1626224583764-f87db24ac4ea?w=800&q=80', 'is_main' => true],
            ['image_path' => 'https://images.unsplash.com/photo-1599839619722-39751411ea63?w=800&q=80', 'is_main' => false],
        ]);

        $venue2 = Venue::create([
            'name' => 'Lapangan Badminton B',
            'address' => 'Jl. Olahraga No. 1, Jakarta',
            'description' => 'Lapangan badminton reguler.',
            'price' => 40000,
            'time_unit_minutes' => 60,
            'max_capacity' => 4,
            'is_active' => true,
        ]);
        
        $venue2->images()->createMany([
            ['image_path' => 'https://images.unsplash.com/photo-1599839619722-39751411ea63?w=800&q=80', 'is_main' => true],
        ]);
    }
}
