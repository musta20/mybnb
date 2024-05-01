<?php
use Livewire\Volt\Component;
use Carbon\Carbon;
use App\Models\Listing;
use App\Services\WishlistService;

new class extends Component
{


    public $inmylist;


    public $listing;

    public function mount(Listing $listing)
    {
        $this->listing = $listing;

        if (Auth::check()) {

                $this->inmylist = auth()->user()->wichListings->contains('id', $listing->id);
        
            } else{

                $this->inmylist = WishlistService::getList()->contains('id', $listing->id);

            }

    }



}

?>

<div>


    @if ($inmylist)
    <a href="{{ route('removeList', $listing->id) }}">

        <svg xmlns="http://www.w3.org/2000/svg" fill="red" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="w-6 h-6  rounded-full">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
        </svg>

    </a>
    @else
    <a href="{{ route('addToList', $listing->id) }}">

        <svg xmlns="http://www.w3.org/2000/svg" fill="#f1f1f1" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="w-6 h-6  rounded-full">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
        </svg>

    </a>
    @endif




</div>