<x-layout.layout :title="request('search') ? request('search'): 'Home'">

<div class="flex  " >
    @vite(['resources/js/map.js'])
    
    @if ($listings->count() == 0)


    <p class="text-center text-2xl py-10">No listings found based on your search</p>

    @else
    
    @if(request('search') || request('city')  )


                <script>

                    locations = JSON.parse('{!! $listings->map(fn($listing)=> $listing->only('number_of_guests','media','rating','number_of_bathrooms','title','city','latitude','longitude','id','price_per_night','address','number_of_bedrooms'))->toJson() !!}');

                    const search = {
                        
                        name: '{{ request('search') }}',

                        city: JSON.parse('{!! json_encode(App\Enums\Cities::getByString(request('city'))->getPosition()) !!}')

                    };

                </script>

    <div id="map" style="height: auto; width: 50%;"></div>

    @endif

    @endif
    <x-listings :$listings />



</div>
</x-layout.layout>