<?php

namespace App\Livewire\Host\Listing;

use App\Models\Listing as ModelsListing;
use Livewire\Component;

class Listing extends Component
{
    public $listings;


    public function mount(){

        $this->listings = ModelsListing::with('media')->get();
        
    }

    public function render()
    {
        return view('livewire.host.listings.index');
    }
}
