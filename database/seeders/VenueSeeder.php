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
            'name' => 'Premium Futsal Arena A',
            'slug' => 'premium-futsal-arena-a',
            'address' => 'Jakarta Selatan',
            'description' => 'Nikmati pengalaman bermain maksimal di Premium Futsal Arena A. Lapangan ini dilengkapi dengan lantai premium berkualitas tinggi yang memberikan pijakan yang stabil dan mengurangi risiko cedera.',
            'price' => 150000,
            'time_unit_minutes' => 60,
            'max_capacity' => 10,

        ]);
        $venue1->images()->createMany([
            ['image_path' => 'https://images.unsplash.com/photo-1622279457486-62dcc4a431d6?w=1000&q=80', 'is_main' => true],
            ['image_path' => 'https://images.unsplash.com/photo-1611689342806-0863700ce1e4?w=800&q=80', 'is_main' => false],
            ['image_path' => 'https://images.unsplash.com/photo-1599839619722-39751411ea63?w=800&q=80', 'is_main' => false],
            ['image_path' => 'https://images.unsplash.com/photo-1622279585642-4966601cb899?w=800&q=80', 'is_main' => false],
            ['image_path' => 'https://images.unsplash.com/photo-1611689342806-0863700ce1e4?w=1200&q=80', 'is_main' => false],
        ]);

        $venue2 = Venue::create([
            'name' => 'Serenity Tennis Club',
            'slug' => 'serenity-tennis-club',
            'address' => 'Tangerang Selatan',
            'description' => 'Lapangan tenis outdoor premium dengan pencahayaan maksimal untuk permainan malam hari.',
            'price' => 200000,
            'time_unit_minutes' => 60,
            'max_capacity' => 4,

        ]);
        $venue2->images()->createMany([
            ['image_path' => 'https://images.unsplash.com/photo-1622279457486-62dcc4a431d6?w=1000&q=80', 'is_main' => true],
            ['image_path' => 'https://images.unsplash.com/photo-1611689342806-0863700ce1e4?w=800&q=80', 'is_main' => false],
            ['image_path' => 'https://images.unsplash.com/photo-1599839619722-39751411ea63?w=800&q=80', 'is_main' => false],
            ['image_path' => 'https://images.unsplash.com/photo-1622279585642-4966601cb899?w=800&q=80', 'is_main' => false],
            ['image_path' => 'https://images.unsplash.com/photo-1611689342806-0863700ce1e4?w=1200&q=80', 'is_main' => false],
        ]);

        $venue3 = Venue::create([
            'name' => 'Oasis Badminton Hall',
            'slug' => 'oasis-badminton-hall',
            'address' => 'Jakarta Barat',
            'description' => 'Fasilitas badminton indoor lengkap dengan sirkulasi udara yang baik dan kantin yang nyaman.',
            'price' => 85000,
            'time_unit_minutes' => 60,
            'max_capacity' => 4,

        ]);
        $venue3->images()->createMany([
            ['image_path' => 'https://images.unsplash.com/photo-1622279457486-62dcc4a431d6?w=1000&q=80', 'is_main' => true],
            ['image_path' => 'https://images.unsplash.com/photo-1611689342806-0863700ce1e4?w=800&q=80', 'is_main' => false],
            ['image_path' => 'https://images.unsplash.com/photo-1599839619722-39751411ea63?w=800&q=80', 'is_main' => false],
            ['image_path' => 'https://images.unsplash.com/photo-1622279585642-4966601cb899?w=800&q=80', 'is_main' => false],
            ['image_path' => 'https://images.unsplash.com/photo-1611689342806-0863700ce1e4?w=1200&q=80', 'is_main' => false],
        ]);

        $venue4 = Venue::create([
            'name' => 'Lumina Padel Club',
            'slug' => 'lumina-padel-club',
            'address' => 'Depok',
            'description' => 'Klub olahraga padel modern dengan lapangan berstandar internasional.',
            'price' => 300000,
            'time_unit_minutes' => 60,
            'max_capacity' => 4,
        ]);
        $venue4->images()->createMany([
            ['image_path' => 'https://images.unsplash.com/photo-1622279457486-62dcc4a431d6?w=1000&q=80', 'is_main' => true],
            ['image_path' => 'https://images.unsplash.com/photo-1611689342806-0863700ce1e4?w=800&q=80', 'is_main' => false],
            ['image_path' => 'https://images.unsplash.com/photo-1599839619722-39751411ea63?w=800&q=80', 'is_main' => false],
            ['image_path' => 'https://images.unsplash.com/photo-1622279585642-4966601cb899?w=800&q=80', 'is_main' => false],
            ['image_path' => 'https://images.unsplash.com/photo-1611689342806-0863700ce1e4?w=1200&q=80', 'is_main' => false],
        ]);
    }
}
