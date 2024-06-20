<?php

namespace App\Livewire\Host\Listing;

use App\Models\Booking;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Bookingrequest extends Component
{
    use WithoutUrlPagination, WithPagination;

    public function render()
    {

        return view('livewire.host.listings.bookingrequest', [
            'bookings' => Booking::whereIn('listing_id', auth()->user()->listings()->pluck('id'))->paginate(5),
        ]);
    }
}
