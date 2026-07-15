<?php

namespace App\Http\Controllers\Renter;

use App\Http\Controllers\Controller;
use App\Models\Venue;
use Illuminate\Http\Request;

class RenterDashboardController extends Controller
{
    public function index()
    {
        // Dummy data for now
        $user = (object) ['name' => 'Budi Setiawan'];
        
        $unpaidBooking = (object) [
            'id' => 1,
            'venue_name' => 'Premium Futsal Arena A',
            'deadline' => '15:00',
        ];

        $announcements = [
            (object) [
                'title' => 'Pemeliharaan Lapangan',
                'content' => 'Pemberitahuan: Lapangan Futsal A akan ditutup sementara untuk perbaikan lantai pada tanggal 25 Oktober 2024.'
            ]
        ];

        // We can still try to get real venues if they exist, or fallback to dummy
        $featuredVenues = Venue::with('mainImage')->where('is_active', true)->take(3)->get();
        if ($featuredVenues->isEmpty()) {
            $featuredVenues = collect([
                (object) [
                    'id' => 1,
                    'name' => 'Premium Futsal Arena A',
                    'address' => 'Jakarta Selatan',
                    'price' => 150000,
                    'type' => 'Indoor',
                    'rating' => 4.9,
                    'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCpmXyvyC51LNFtCr5kEeK8XkBiunV1RxK9P0U1rY-fd4IvYqYE4gDZm0jwUciuhtkGfDmDVUFxcEeTo-tTEzi9mHRZuEjbI_FR9forR_jOLVvbxk7Lt6fhjkWWNZ4NbC6m5rzUrSTGc3i7HpqJmwv95Tt4IBN883fMY7kYha0KusvfwHicl5EIV6m2V78G0L3P9dd8TbgReIiJaconX1CCOThmwUxFSOVjkBXUY_PgRE55wcGYDF44RA',
                ],
                (object) [
                    'id' => 2,
                    'name' => 'Grand Tennis Court',
                    'address' => 'Jakarta Pusat',
                    'price' => 200000,
                    'type' => 'Outdoor',
                    'rating' => 4.7,
                    'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCdEi-fxZ_GRmIPSwJfKZNvYIqRYGcm-3Gb8lrOC7EPUyvwD7H9DcUDfTtsTdENXiEvwv92VStiM9cVpLgxreKwFuxzV4WsDpJTuoW82wY6U6-ZZ07WWPyMIj60-XdF8Kjuy056vcB9EWOqVCLVVkR3DyakyKn2RyzF_HaM-uqDVMTWCS4rw3_wHr95m4uZb3AZRXgzL2vl5BQlo_2GV9c2ohhR2rQ564CO-0JOH67WQ9fZ766TH-SpUQ',
                ],
                (object) [
                    'id' => 3,
                    'name' => 'Oasis Badminton Hall',
                    'address' => 'Jakarta Barat',
                    'price' => 85000,
                    'type' => 'Indoor',
                    'rating' => 4.8,
                    'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCRFcuZwuk_dEttKhuMreE1Wk7NIrjedLH0Ma_Y-7FfSjSa09heSotRI0BRhkBbothXqCRcpn2CoK3oWjbIKjBqNOjXgjC9wzK3QtKQHHxEquV2EEoN4JD0XVT7xdzXTrq2xiJ5l2VS4MlSBIOrpmtIqKHFGK2ns-uwejAvBw-D-hG20CG3OOyhuw0tXXqAdkfCIgOw29_Iml24kj1LJI0rt0k6n80ufttINlcslXKMLSZR5EqJo1DgCw',
                ]
            ]);
        }

        // Simulating scenario where upcomingBookings is empty for testing empty state later
        $upcomingBookings = [
            (object) [
                'id' => 1,
                'venue_name' => 'Premium Futsal Arena A',
                'date' => '25 Oktober 2024',
                'time' => '18:00 - 20:00 WIB',
                'status' => 'Berhasil'
            ],
            (object) [
                'id' => 2,
                'venue_name' => 'Grand Tennis Court',
                'date' => '28 Oktober 2024',
                'time' => '09:00 - 11:00 WIB',
                'status' => 'Berhasil'
            ]
        ];

        $recentBookings = [
            (object) [
                'id' => 3,
                'venue_name' => 'Oasis Badminton Hall',
                'date' => '10 Oktober 2024',
                'time' => '19:00 - 21:00 WIB',
                'status' => 'Selesai'
            ]
        ];

        return view('renter.dashboard', compact('user', 'unpaidBooking', 'announcements', 'featuredVenues', 'upcomingBookings', 'recentBookings'));
    }
}
