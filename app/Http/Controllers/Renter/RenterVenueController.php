<?php

namespace App\Http\Controllers\Renter;

use App\Http\Controllers\Controller;
use App\Models\Venue;
use Illuminate\Http\Request;

class RenterVenueController extends Controller
{
    public function index()
    {
        // For now, if we don't have real data, we can provide dummy data
        $venues = Venue::with('mainImage')->where('is_active', true)->get();
        
        if ($venues->isEmpty()) {
            $venues = collect([
                (object) [
                    'id' => 1,
                    'name' => 'Premium Futsal Arena A',
                    'address' => 'Jakarta Selatan',
                    'price' => 150000,
                    'rating' => 4.9,
                    'status' => 'Tersedia',
                    'status_color' => 'bg-secondary-container text-on-secondary-container',
                    'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAp34cONLutwfp2CBySe9-qeKNmx-MtRENXwZJ24zbUifV3R1ThnXGvVyV_qzoZjATvDUx6JMflHk-COxtmTSmBFOq29qhnadMBagd3kmBcNOZeOMG4eFmtFMR2PUiaa2h4xllV5qT3uINo3zbjLiRzL1Uz2n4E38tTusS_-PmZflDUtuub8tEy_exbKPBrXsWjgy-NY5AhFx1YErCb0ZxyT4thmN7Cx2avec-LDUSkNVw88AY9E6Vvdg',
                    'featured' => true
                ],
                (object) [
                    'id' => 2,
                    'name' => 'Serenity Tennis Club',
                    'address' => 'Tangerang Selatan',
                    'price' => 200000,
                    'rating' => 4.7,
                    'status' => 'Hampir Penuh',
                    'status_color' => 'bg-[#f59e0b] text-on-primary',
                    'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAWpNvN2gu93g5BqcNgDwAhLhd5wQ-u8li7wvrhT8VtMm8cUTGDcORxETq5p0jfLxIdsMiNYeJRJQxdsJi4j-iUQ3QcX87fRykemMI0VCyXmZ8pNBjtHsHFpK8Cy4Kzp8Tcy9l5vpk4mz8QwC305BUGYPHehwbc_pyT5KEplwz-TdZsuKeCGqoG1nx5scOcLtOx9Uzkg8sqwneYNuZ6fEP0ne219Mt60EX1us-g8dEUSqMW6FrLXw_pLA',
                    'featured' => false
                ],
                (object) [
                    'id' => 3,
                    'name' => 'Oasis Badminton Hall',
                    'address' => 'Jakarta Barat',
                    'price' => 85000,
                    'rating' => 4.8,
                    'status' => 'Maintenance',
                    'status_color' => 'bg-surface-container-high text-on-surface-variant',
                    'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCRFcuZwuk_dEttKhuMreE1Wk7NIrjedLH0Ma_Y-7FfSjSa09heSotRI0BRhkBbothXqCRcpn2CoK3oWjbIKjBqNOjXgjC9wzK3QtKQHHxEquV2EEoN4JD0XVT7xdzXTrq2xiJ5l2VS4MlSBIOrpmtIqKHFGK2ns-uwejAvBw-D-hG20CG3OOyhuw0tXXqAdkfCIgOw29_Iml24kj1LJI0rt0k6n80ufttINlcslXKMLSZR5EqJo1DgCw',
                    'featured' => false
                ],
                (object) [
                    'id' => 4,
                    'name' => 'Lumina Padel Club',
                    'address' => 'Depok',
                    'price' => 300000,
                    'rating' => 5.0,
                    'status' => 'Penuh Hari Ini',
                    'status_color' => 'bg-error/90 text-on-error',
                    'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBMMZ1BlkYZ3xZWoabAPDzS9Wyg0w79e-5ObqnX_WL2HY8NORMfVnqA8M2Chv7yderEqaxdBor6oSdthAW-OeTDSvdcCoMjSUEdjjaHQ0wU9ea1gqs-TqMPViMisarkE47_KhyMi-PdtJBJRxqgYx0llaWcuClPFQxpzJbMXZzLNtYsHvV0zUkZEDtdsprZ02vP3eA45gpAD0Id29QmLO471TBkYa_PqWRb58CM98WUmXm4E-lJQQK1gQ',
                    'featured' => false,
                    'disabled' => true
                ]
            ]);
        }
        
        return view('renter.venues.index', compact('venues'));
    }

    public function show($id)
    {
        $venue = Venue::with('images')->find($id);
        
        if (!$venue) {
            // Dummy single venue
            $venue = (object) [
                'id' => $id,
                'name' => 'Lapangan Karpet Premium A',
                'price' => 50000,
                'address' => 'Jl. Sudirman No. 123, Jakarta',
                'description' => 'Nikmati pengalaman bermain maksimal di Lapangan Karpet Premium A. Lapangan ini dilengkapi dengan lantai vinyl premium berkualitas tinggi yang memberikan pijakan yang stabil dan mengurangi risiko cedera. Sistem pencahayaan modern memastikan visibilitas optimal tanpa silau, sementara sirkulasi udara yang sangat baik menjaga kenyamanan Anda selama pertandingan.',
                'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCkP-Pwa93SXR18SMcYhueYieqAJ-BZiDkMp013QY5tSZGfXgbUEZUQT4ryUB1lnVcBdnCYd-jkVgAtetqyVgqPScEuaIxqLNsnNn5SbzGbyBatxfhCUSDtUhIqCE_AFmZXxHFd1otQ8WNIXHIiptZbeCw006LmWwSYvjSE-dy5V7PIO--hYxPk1rM0gIYXe3wCR1ItFIT4XPXfdaRPyDhfW8VoS2UShpR324jm1pNRHeELCEpvuBzF8g'
            ];
        }

        return view('renter.venues.show', compact('venue'));
    }
}
