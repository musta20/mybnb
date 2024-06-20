
<div class="w-full">
<div
@class([
'grid grid-cols-1  sm:grid-cols-2 gap-3 md:grid-cols-3 lg:grid-cols-4',
    ' xl:grid-cols-3'=>request('city') || request('search') || request('pageCity'),
])
>
    @foreach ($listings as $listing)

       <x-listing-card :$listing />

    @endforeach

</div>

    <div class="m-5 p-10 ">
        
        <hr class="my-5" >

        {{$listings->links()}}

    </div>

</div>