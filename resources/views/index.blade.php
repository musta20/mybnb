<x-layout.layout :title="request('search') ? request('search'): 'Mybnb| vacations, stays, and experiences'">

<div class="flex  flex-col sm:flex-col md:flex-col lg:flex-row xl:flex-row 2xl:flex-row " >
    @vite(['resources/js/map.js'])

    @if ($listings->count() == 0)


    <p class="text-center text-2xl py-10">No listings found based on your search</p>

    @else

    @if (request('search') || request('city') || request('pageCity')  )


                <script>

                    locations = JSON.parse('{!! $listings->map(fn($listing)=> $listing->only('number_of_guests','media','rating','number_of_bathrooms','title','city','latitude','longitude','id','price_per_night','address','number_of_bedrooms'))->toJson() !!}');

                    const search = {

                        name: '{{ request('search') }}',

                        city: JSON.parse('{!! json_encode(App\Enums\Cities::getByString(request('city') ?? request('pageCity'))->getPosition()) !!}'),

                        MAP_ID: '{{ config('app.MAP_ID') }}',



                    };

                </script>

    <div id="map"

    class="w-[95%] mx-1 h-[350px]  lg:h-auto lg:w-3/5"

   ></div>

   @else

   <script>
const search = {
    name: ' ',
    city: JSON.parse('{!! json_encode(App\Enums\Cities::getByString('Cairo')->getPosition()) !!}'),
    MAP_ID: '{{ config('app.MAP_ID') }}'
};
    </script>

    @endif

    @endif
    <x-listings :$listings />


</div>
</x-layout.layout>