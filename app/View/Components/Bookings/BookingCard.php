<?php

namespace App\View\Components\Bookings;

use App\Models\Booking;
use Illuminate\View\Component;

class BookingCard extends Component
{
    public mixed $booking;

    public function __construct(mixed $booking)
    {
        $this->booking = $booking;
    }

    public function render()
    {
        return view('components.bookings.booking-card');
    }
}
