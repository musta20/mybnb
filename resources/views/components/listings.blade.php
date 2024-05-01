
<div class="grid grid-cols-1  sm:grid-cols-2 gap-3 md:grid-cols-3 lg:grid-cols-4" >

    @foreach ($listings as $listing)

       <x-listing-card :$listing />

    @endforeach


</div>

<div class="m-5 p-10 ">
    <hr class="my-5" >

    {{$listings->links()}}
</div>