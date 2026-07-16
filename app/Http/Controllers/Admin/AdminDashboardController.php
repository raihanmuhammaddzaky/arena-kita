<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\User;
use App\Models\Venue;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $pendingUsers = User::where('status', 'pending')->count();
        $pendingPayments = Payment::where('status', 'pending')->count();
        $activeVenues = Venue::count();
        $totalVenues = Venue::count();

        $recentPayments = Payment::with(['booking.user', 'booking.venue'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'pendingUsers',
            'pendingPayments',
            'activeVenues',
            'totalVenues',
            'recentPayments'
        ));
    }
}
