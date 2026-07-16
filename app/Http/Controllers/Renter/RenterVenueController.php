<?php

namespace App\Http\Controllers\Renter;

use App\Http\Controllers\Controller;
use App\Models\Venue;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class RenterVenueController extends Controller
{
    public function index(Request $request)
    {
        $query = Venue::with('mainImage');
        
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('address', 'like', '%' . $search . '%');
            });
        }

        if ($query->count() > 0) {
            $venues = $query->paginate(9);
        } else {
            $items = collect([
                (object) [
                    'id' => 1,
                    'name' => 'Premium Futsal Arena A',
                    'slug' => 'premium-futsal-arena-a',
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
                    'slug' => 'serenity-tennis-club',
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
                    'slug' => 'oasis-badminton-hall',
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
                    'slug' => 'lumina-padel-club',
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
            
            // Create a dummy paginator so the view doesn't break when calling ->links()
            $venues = new LengthAwarePaginator($items, $items->count(), 9, 1, [
                'path' => request()->url(),
                'query' => request()->query()
            ]);
        }
        
        return view('renter.venues.index', compact('venues'));
    }

    public function show($slug)
    {
        $venue = Venue::with('images')->where('slug', $slug)->first();
        
        if (!$venue) {
            // Mapping dummy data based on slug
            $dummyNames = [
                'premium-futsal-arena-a' => 'Premium Futsal Arena A',
                'serenity-tennis-club' => 'Serenity Tennis Club',
                'oasis-badminton-hall' => 'Oasis Badminton Hall',
                'lumina-padel-club' => 'Lumina Padel Club'
            ];
            
            $name = $dummyNames[$slug] ?? 'Lapangan Karpet Premium A';
            
            // Dummy single venue
            $venue = (object) [
                'id' => 1,
                'name' => $name,
                'slug' => $slug,
                'price' => 150000,
                'address' => 'Jl. Sudirman No. 123, Jakarta',
                'description' => 'Nikmati pengalaman bermain maksimal di ' . $name . '. Lapangan ini dilengkapi dengan lantai premium berkualitas tinggi yang memberikan pijakan yang stabil dan mengurangi risiko cedera. Sistem pencahayaan modern memastikan visibilitas optimal tanpa silau, sementara sirkulasi udara yang sangat baik menjaga kenyamanan Anda.',
                'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCkP-Pwa93SXR18SMcYhueYieqAJ-BZiDkMp013QY5tSZGfXgbUEZUQT4ryUB1lnVcBdnCYd-jkVgAtetqyVgqPScEuaIxqLNsnNn5SbzGbyBatxfhCUSDtUhIqCE_AFmZXxHFd1otQ8WNIXHIiptZbeCw006LmWwSYvjSE-dy5V7PIO--hYxPk1rM0gIYXe3wCR1ItFIT4XPXfdaRPyDhfW8VoS2UShpR324jm1pNRHeELCEpvuBzF8g'
            ];
        }

        return view('renter.venues.show', compact('venue'));
    }

    public function availability(Request $request, $id)
    {
        $request->validate([
            'date' => 'required|date'
        ]);

        $date = $request->date;

        $bookings = Booking::where('venue_id', $id)
            ->where('booking_date', $date)
            ->whereIn('status', ['pending', 'confirmed'])
            ->get(['start_time', 'end_time']);

        return response()->json([
            'date' => $date,
            'booked_slots' => $bookings
        ]);
    }
}
