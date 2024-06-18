<x-layout.layout :title="request('search') ? request('search'): 'Home'">

    @if ($listings->count() == 0)


    <p class="text-center text-2xl py-10">No listings found based on your search</p>

    @else
    
    @if(request('search') || request('city')  )

    {{-- @dd($listings->map(fn($listing)=> $listing->only('title','city','latitude','longitude','id'))->toJson()) --}}
    <script>
        locations = JSON.parse('{!! $listings->map(fn($listing)=> $listing->only('title','city','latitude','longitude','id'))->toJson() !!}');

        const search = {
            name: '{{ request('search') }}',
            city: JSON.parse('{!! json_encode(App\Enums\Cities::getByString(request('city'))->getPosition()) !!}')
         };

        
    </script>
    <div id="map" style="height: 400px; width: 100%;"></div>

    @endif

    @endif

    <x-listings :$listings />



</x-layout.layout>