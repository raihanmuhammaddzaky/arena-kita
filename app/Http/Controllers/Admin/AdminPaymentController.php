<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class AdminPaymentController extends Controller
{
    public function index(Request $request)
    {
        $query = Payment::with(['booking.user', 'booking.venue']);

        $statusFilter = $request->input('status', 'pending');
        if ($statusFilter !== 'all') {
            $query->where('status', $statusFilter);
        }

        $payments = $query->latest()->paginate(10)->appends($request->query());

        return view('admin.bookings.verifications', compact('payments', 'statusFilter'));
    }

    public function verify(Payment $payment)
    {
        $payment->update(['status' => 'verified']);
        $payment->booking->update(['status' => 'confirmed']);

        return redirect()->back()
            ->with('success', 'Pembayaran berhasil diverifikasi. Booking dikonfirmasi.');
    }

    public function reject(Payment $payment)
    {
        $payment->update(['status' => 'rejected']);
        $payment->booking->update(['status' => 'cancelled']);

        return redirect()->back()
            ->with('success', 'Pembayaran ditolak. Booking dibatalkan.');
    }
}
