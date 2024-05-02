<x-layout.layout :title="request('search') ? request('search'): 'Home'">
    @if ($listings->count() == 0)
        <p class="text-center text-2xl py-10">No listings found based on your search</p>
    @endif

<x-listings :$listings />
</x-layout.layout>