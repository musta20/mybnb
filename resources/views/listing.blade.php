<x-layout.layout>
    <div class="w-5/6 mx-auto ">
        <div class="flex gap-3 w-2/6 justify-between py-2">
            <h3 class="text-2xl ">{{$listing->title}}</h3>
            <x-user-rating :showText="false" :rating="$totalRating" />
        </div>
        <hr>
        <div class="flex gap-2  py-3">
            @if ($listing->media->count() == 0)
            <span class="text-gray-900 m-auto w-24 dark:text-gray-100">No image</span>
            @else
            <img src="{{ asset('listings/'.$listing?->media[0]?->path) }}" class=" w-1/2 h-1/2 rounded-md" alt="">

            <div class="grid grid-cols-3  gap-2">
                @for ($i = 1; $i < count($listing->media); $i++)
                    <img src="{{asset('listings/'.$listing->media[$i]->path)}}" class="w-full rounded-md" alt="">
                    @endfor
            </div>
            @endif

        </div>
        <hr class="py-5">
        <div class="flex">

            <div class=" py-5  w-1/2">
                <div>
                    {{$listing->host->name}}
                </div>

                <hr class="my-5">
                <div>
                    {{$listing->description}}
                </div>
                <hr class="my-5">
                <x-amenities :amenities="$listing->amenities" />
                <hr class="my-5">
                <div class="">
                    <span class="flex sm:flex-col justify-between my-2">
                        <x-user-rating :showText="false" :rating="$totalRating" />
                        <strong>
                            {{__('messages.over all rating')}}

                            {{__('messages.based on')}}({{array_sum($allRating)}}) {{__('messages.reviews')}}
                        </strong>
                    </span>
                    <hr>
                    @foreach ($allRating as $key=>$item)
                    <span class="flex max-h-6  p-1">
                        <span class="w-2/12 ">
                            {{$key}} star
                        </span>
                        @php
                        $perst =0 ;

                        if (array_sum($allRating) > 0) {
                        $perst = floor($item/array_sum($allRating)*100);
                        }
                        @endphp
                        <div dir="ltr" class="  w-10/12  bg-gray-100 rounded-full dark:bg-gray-200">
                            <div style="width: {{$perst}}%" @class(['bg-yellow-300 text-xs text-white font-medium
                                text-blue-100 text-center p-0.5 leading-none rounded-full', 'hidden'=> !$perst ]) >
                                {{$perst}}%</div>
                        </div>
                    </span>
                    @endforeach
                    <hr class="my-5">
                    <x-add-review :$listing />
                </div>
                @foreach ($reviews as $review)
                <x-comment-card :$review />
                @endforeach
                <span>
                    {{$reviews->links()}}
                </span>
            </div>


            <div class="flex  justify-center  py-5 w-1/2">

                <div class="rounded-lg  border-2 max-h-64 w-1/2  p-5 bg-white ">
                    
                    <form  action="{{route('booking', $listing->id)}}" method="POST" >
                        @csrf
                    <div class="my-5 gap-2">
                        {{$listing->price_per_night}} <span class="text-xs" >{{__('messages.EGP')}}</span>    {{__('messages.per night')}}
                    </div>
                    <x-layout.check-date />
                    <hr class="my-5">
                    <x-layout.guest />


                    <button class="w-full bg-slate-500 rounded-lg text-white p-2 mt-5">Book now</button>

                    </form>
                </div>
            </div>

        </div>
    </div>
</x-layout.layout>