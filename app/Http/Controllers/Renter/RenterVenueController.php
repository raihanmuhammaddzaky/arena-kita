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

        $venues = $query->paginate(9);
        
        return view('renter.venues.index', compact('venues'));
    }

    public function show($slug)
    {
        $venue = Venue::with('images')->where('slug', $slug)->firstOrFail();

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
