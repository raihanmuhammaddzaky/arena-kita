<?php

namespace App\View\Components;

use App\Models\Venue;
use Illuminate\View\Component;

class VenueCard extends Component
{
    public Venue $venue;

    public function __construct(Venue $venue)
    {
        $this->venue = $venue;
    }

    public function render()
    {
        return view('components.venue-card');
    }
}
