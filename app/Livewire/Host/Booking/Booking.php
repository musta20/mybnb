<?php

namespace App\Livewire\Host\Booking;

use App\Models\Booking as ModelsBooking;
use Livewire\Component;

class Booking extends Component
{

    public $bookings;
    
    public function mount(){
        $this->bookings = ModelsBooking::with('listing')->get();
    }

    public function render()
    {
        return view('livewire.host.booking.booking');
    }
}
