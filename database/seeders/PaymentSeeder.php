<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Payment;
use App\Models\Booking;

class PaymentSeeder extends Seeder
{
    public function run(): void
    {
        // Get all confirmed bookings to attach payments to
        $confirmedBookings = Booking::where('status', 'confirmed')->get();

        foreach ($confirmedBookings as $booking) {
            Payment::create([
                'booking_id' => $booking->id,
                'proof_image' => 'dummy_proof.jpg',
                'status' => 'verified',
            ]);
        }
        
        // Optional: Get cancelled bookings and simulate failed/refunded payments if needed
        // But for UI dashboard purposes, success payments for confirmed bookings is enough.
    }
}
