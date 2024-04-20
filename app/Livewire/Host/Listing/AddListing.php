<?php

namespace App\Livewire\Host\Listing;

use Livewire\Attributes\On;
use Livewire\Component;

class AddListing extends Component
{
    public $subFiles = [];


    public function render()
    {
        return view('livewire.host.listings.add-listings');
    }
}
