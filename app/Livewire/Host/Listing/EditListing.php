<?php

namespace App\Livewire\Host\Listing;

use App\Models\Listing;
use Livewire\Component;

class EditListing extends Component
{
    public $listing;

    public $photo;

    public $subFiles = [];

    public function mount(Listing $listing)
    {
        $this->listing = $listing;

        $this->subFiles = $listing->media->toArray();

    }

    public function render()
    {
        return view('livewire.host.listings.edit-listing');
    }
}
