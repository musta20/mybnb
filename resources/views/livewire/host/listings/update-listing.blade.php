<?php

use Livewire\Volt\Component;
use App\Enums\Amenities;
use App\Enums\Cities;
use App\Models\Listing;
use Illuminate\Validation\Rule;

new class extends Component {

   public $listing;

   public $amenities = [];

   public $allAmenities = [];

   public $selectedAmenities;

   public $title;

   public $address;

   public $description;

   public $guests;

   public $beds;

   public $bedrooms;

   public $baths;

   public $price;

   public $city;

   public $Allcities;

   public $Latitude;

   public $Longitude;

   public function updateListing(){


    $validated = $this->validate([
            'title' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'guests' => ['required', 'numeric'],
            'beds' => ['required', 'numeric'],
            'baths' => ['required', 'numeric'],
            'Latitude' => ['required', 'numeric', 'between:-90,90'],
            'Longitude' => ['required', 'numeric', 'between:-180,180'],

            'price' => ['required','numeric'],
            'city' => ['required', Rule::in(Cities::cases())],

        ]);

        if ($this->listing) {


        $this->listing->update([
            'title' => $validated['title'],
            'address' => $validated['address'],
            'city' => $validated['city'],
            'description' => $validated['description'],
            'number_of_guests' =>   $validated['guests'],
            'number_of_bedrooms' => $validated['beds'],
            'number_of_bathrooms' => $validated['baths'],
            'price_per_night' => $validated['price'],
            'latitude' => $validated['Latitude'],
            'longitude' => $validated['Longitude'],
            'amenities' => json_encode($this->amenities)

        ]);

        return  $this->dispatch('listing-updated');
    }

   $newListing = Listing::create([
            'title' => $validated['title'],
            'latitude' => $validated['Latitude'],
            'longitude' => $validated['Longitude'],
            'address' => $validated['address'],
            'description' => $validated['description'],
            'number_of_guests' =>   $validated['guests'],
            'number_of_bedrooms' => $validated['beds'],
            'number_of_bathrooms' => $validated['baths'],
            'price_per_night' => $validated['price'],
            'city' => $validated['city'],
            'host_id' => Auth::user()->id,
            'amenities' => json_encode($this->amenities)
    ]);


      $this->dispatch('saveListingImages', $newListing->id);





   }

   public function updatedselectedAmenities(){

    if (!in_array($this->selectedAmenities, $this->amenities)) {
        $this->amenities[] = $this->selectedAmenities;

    }

   }

   public function mount($listing=null)
   {

    $this->allAmenities = Amenities::cases();
    $this->Allcities = Cities::cases();

    if ($listing) {

    $this->listing = $listing;
    $this->amenities = json_decode($listing->amenities);

    $this->title = $listing->title;
    $this->Latitude = $listing->latitude;
    $this->Longitude = $listing->longitude;
    $this->address = $listing->address;
    $this->description = $listing->description;
    $this->guests = $listing->number_of_guests;
    $this->beds = $listing->number_of_bedrooms;
    $this->baths = $listing->number_of_bathrooms;
    $this->price = $listing->price_per_night;
    $this->city = $listing->city;

    }
   }

   public function removeAmenity($item)
   {

    $this->amenities = array_filter($this->amenities, function($value) use ($item) {
        return $value != $item;
    });

}

}; ?>


<section>

    <script>

        const process = { env: {} };
        process.env.GOOGLE_MAPS_API_KEY = '{{ config('app.GOOGLE_MAPS_KEY') }}';

    </script>


    {{-- //locations = JSON.parse('{!! $listings->map(fn($listing)=> $listing->only('title','city','latitude','longitude','id'))->toJson() !!}'); --}}
    <script>

        const search = {
            name: '{{ request('search') }}',
            city: JSON.parse('{!! json_encode(App\Enums\Cities::getByString($city ? $city : "Cairo")->getPosition()) !!}')
         };


    </script>



    {{-- @if ($errors->isNotEmpty())
    <div class="text-red-500">
        @foreach ($errors->all() as $error)
        <div>{{ $error }}</div>
        @endforeach
    </div>
    @endif --}}
<x-error-message/>


    <form wire:submit="updateListing" class="mt-6 space-y-6   ">


        <div class="flex gap-3 ">
            <div wire:ignore id="geoLoaction"
            style="width:100%;height:400px;"></div>

            <input name="Latitude" id="Latitude"
            wire:model="Latitude"

            type="hidden" >

            <input name="Longitude"
            wire:model="Longitude"
            id="Longitude" type="hidden" >


        </div>

        <div class="flex gap-3 ">
            <div class="w-full ">
                <x-input-label for="listing_title" :value="__('messages.host_title')" />
                <x-text-input wire:model="title" id="listing_title" name="title" type="text" class="mt-1 block w-full"
                    autocomplete="listing_title" />
                <x-input-error :messages="$errors->get('title')" class="mt-2" />
            </div>
            <div class="w-full ">
                <x-input-label for="listing_address" :value="__('messages.host_address')" />
                <x-text-input wire:model="address" id="listing_address" name="address" type="text"
                    class="mt-1 block w-full" autocomplete="listing_address" />
                <x-input-error :messages="$errors->get('address')" class="mt-2" />
            </div>
        </div>

        <div class="flex  gap-3 ">


            <div class="w-full">
                <x-input-label for="listing_amenities" :value="__('messages.listing_amenities')" />
                <div class="flex gap-2 my-3  min-h-[40px]">
                    @foreach ($amenities as $item)
                    <span
                        class="inline-flex items-center   gap-x-1.5 py-0.5 ps-3 pe-2 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-800/30 dark:text-blue-500">
                        {{ __("messages.".$item) }}
                        <button type="button" wire:click="removeAmenity('{{ $item }}')"
                            class="flex-shrink-0 size-4 inline-flex items-center justify-center rounded-full hover:bg-blue-200 focus:outline-none focus:bg-blue-200 focus:text-blue-500 dark:hover:bg-blue-900">
                            <svg class="flex-shrink-0 size-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="M18 6 6 18"></path>
                                <path d="m6 6 12 12"></path>
                            </svg>
                        </button>
                    </span>
                    @endforeach
                </div>

                <select wire:model.live="selectedAmenities"
                    class="border-gray-300 w-full dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                    <option  selected  value=""> -- اختر من القائمة -- </option>
                    @foreach ($allAmenities as $key => $value)


                    <option value="{{ $value->value }}">{{ __('messages.'.$value->value ) }}</option>

                    @endforeach
                </select>

                <x-input-error :messages="$errors->get('amenities')" class="mt-2" />
            </div>
            <div class="w-full mt-12">
                <x-input-label for="listing_title" class="py-2" :value="__('messages.host_title')" />

                <x-select-input class="w-full" :options="$Allcities" wire:model="city" />
            </div>

        </div>

        <div>
            <x-input-label for="listing_description" :value="__('messages.listing_description')" />
            <x-text-area wire:model="description" id="listing_description" name="description"
                class="mt-1 block w-full" />
            <x-input-error :messages="$errors->get('description')" class="mt-2" />
        </div>

        <div class="flex gap-4">

            <div class="w-full ">
                <x-input-label for="listing_guests" :value="__('messages.number_of_guests')" />
                <x-text-input wire:model="guests" id="number_of_guests" name="number_of_guests" type="number"
                    class="mt-1 block w-full" autocomplete="listing_guests" />
                <x-input-error :messages="$errors->get('guests')" class="mt-2" />
            </div>

            <div class="w-full ">
                <x-input-label for="listing_bedrooms" :value="__('messages.number_of_bedrooms')" />
                <x-text-input wire:model="beds" id="number_of_bedrooms" name="number_of_bedrooms" type="number"
                    class="mt-1 block w-full" autocomplete="number_of_bedrooms" />
                <x-input-error :messages="$errors->get('beds')" class="mt-2" />
            </div>

        </div>

        <div class="flex gap-4">

            <div class="w-full ">
                <x-input-label for="listing_guests" :value="__('messages.number_of_bathrooms')" />
                <x-text-input wire:model="baths" id="number_of_bathrooms" name="number_of_bathrooms" type="number"
                    class="mt-1 block w-full" autocomplete="number_of_bathrooms" />
                <x-input-error :messages="$errors->get('baths')" class="mt-2" />
            </div>

            <div class="w-full ">
                <x-input-label for="price_per_night" :value="__('messages.price_per_night')" />
                <x-text-input type="number" min="0" max="1000" step="0.01" wire:model="price" id="price_per_night"
                    name="price_per_night" class="mt-1 block w-full" autocomplete="price_per_night" />
                <x-input-error :messages="$errors->get('price')" class="mt-2" />
            </div>

        </div>



        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('messages.Save') }}</x-primary-button>
{{--
            <x-action-message class="me-3" on="listing-updated">
                {{ __('messages.Saved.') }}
            </x-action-message> --}}

            <x-event-toast on="listing-updated">
                {{ __('messages.Saved.') }}
            </x-event-toast>
        </div>
    </form>

    <script>


    </script>

</section>