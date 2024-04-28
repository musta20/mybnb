<?php

namespace App\Livewire\Host\Listing;

use App\Models\Booking;
use Livewire\Component;
use Livewire\WithPagination;

class Bookingrequest extends Component
{
    use WithPagination;
    //public $bookings;
    public function render()
    {
        // $user= auth()->user();

        // $this->bookings = 


        //->where('status', \App\Enums\BookingStatus::PENDING->value)->get();
        //$this->bookings =  Booking::where('listing_id', auth()->user()->id)->where('status', \App\Enums\BookingStatus::PENDING->value)->get();
        //  $this->bookings = auth()->user()->host->bookings()->where('status', \App\Enums\BookingStatus::PENDING->value)->get();

        return view('livewire.host.listings.bookingrequest', [
            'bookings' => auth()->user()->hostbookings()->paginate(10)
        ]);
    }
}
