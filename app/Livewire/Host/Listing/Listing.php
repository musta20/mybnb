<?php

namespace App\Livewire\Host\Listing;

use App\Models\Listing as ModelsListing;
use Livewire\Component;
use Livewire\WithPagination;

class Listing extends Component
{
    use WithPagination;

    public function mount()
    {

    }

    public function render()
    {
        $listings = ModelsListing::with('media')->where('host_id', auth()->user()->id)->paginate(10);

        return view(
            'livewire.host.listings.index',
            ['listings' => $listings]
            // ['listings' => ModelsListing::with('media')->paginate(10)]
        );
    }
}
