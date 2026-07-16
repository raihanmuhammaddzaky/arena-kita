<?php

namespace App\View\Components\Bookings;

use App\Models\Booking;
use Illuminate\View\Component;

class BookingCard extends Component
{
    public Booking $booking;

    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
    }

    public function render()
    {
        return view('components.bookings.booking-card');
    }
}
