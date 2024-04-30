<?php

namespace App\Livewire\Host\Listing;

use App\Models\Booking;
use Livewire\Component;
use Livewire\WithPagination;
use App\Enums\BookingStatus;
use Livewire\WithoutUrlPagination;

class Bookingrequest extends Component
{
    use WithPagination,WithoutUrlPagination;

    public function render()
    {
        
        return view('livewire.host.listings.bookingrequest', [
            'bookings' => Booking::whereIn('listing_id', auth()->user()->listings()->pluck('id'))
            ->paginate(5),//$this->getbookings()->Filter()->RequestPaginate(),
          //  'filterBox' => Booking::showFilter()
        ]);
    }
}
