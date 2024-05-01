<x-layout.layout>
    <div class="w-5/6 mx-auto ">
        <div class="flex gap-3 w-2/6 justify-between py-2">
            <h3 class="text-2xl ">{{$listing->title}} , {{__('messages.'.$listing->city)}}</h3>
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
                <a href="{{route('hostProfile', $listing->host->id)}}" class="flex gap-3">
                    @if($listing->host->profile_picture)
                    <img src="{{asset('listings/'.$listing->host->profile_picture)}}" class="w-14 h-14 rounded-full" />
                    @else
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-14 h-14">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>

                    @endif

                    <span class="text-xl font-bold my-auto">
                        {{$listing->host->name}}
                    </span>
                </a>

                <hr class="my-5">
                <div>
                    {{$listing->description}}
                </div>
                <hr class="my-5">
                <span class="flex gap-3 py-3">

                    <div class="flex gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24"
                            class="w-5 h-5 text-slate-600"  
                            width="512" height="512">
                                <path
                                    d="M19,2H5C2.243,2,0,4.243,0,7v14c0,.553,.448,1,1,1s1-.447,1-1v-2H22v2c0,.553,.447,1,1,1s1-.447,1-1V7c0-2.757-2.243-5-5-5ZM5,4h14c1.654,0,3,1.346,3,3v6h-2c0-2.206-1.794-4-4-4h-1c-1.194,0-2.266,.526-3,1.357-.734-.832-1.806-1.357-3-1.357h-1c-2.206,0-4,1.794-4,4H2V7c0-1.654,1.346-3,3-3ZM13,13c0-1.103,.897-2,2-2h1c1.103,0,2,.897,2,2h-5Zm-7,0c0-1.103,.897-2,2-2h1c1.103,0,2,.897,2,2H6Zm-4,4v-2H22v2H2Z" />
                            </svg>
                        {{$listing->number_of_bedrooms}} سرير
                    </div>
                    <div class="flex gap-3">
                        
                        <svg 
                        class="w-5 h-5 text-slate-600"  

                        xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24">
                            <path d="m23.249,13.015c-.569-.645-1.389-1.015-2.249-1.015H2v-7.518c0-.841.38-1.673,1.093-2.12,1.089-.683,2.419-.347,3.107.571l.259.345-.483,2.771c-.058.334.011.678.194.963.425.662,1.323.824,1.952.352l3.606-2.704c.567-.425.71-1.217.327-1.814l-.013-.021c-.237-.37-.64-.602-1.079-.622l-2.906-.129-.174-.232c-.658-.877-1.593-1.542-2.669-1.755C2.44-.462,0,1.656,0,4.333c0,0,.004,5.71.006,7.923,0,.576.037,1.145.108,1.717.101.809.237,1.9.237,1.9.251,2.005,1.223,3.767,2.635,5.037l-.457,1.85c-.133.536.194,1.078.73,1.211.081.02.161.029.241.029.449,0,.857-.305.97-.76l.277-1.121c1.109.564,2.36.881,3.676.881h7.417c1.223,0,2.39-.273,3.44-.765l.249,1.005c.112.455.521.76.97.76.08,0,.16-.01.241-.029.536-.133.863-.675.73-1.211l-.41-1.66c1.53-1.282,2.591-3.12,2.854-5.226l.062-.501c.106-.854-.158-1.712-.728-2.357Zm-1.257,2.109l-.062.501c-.383,3.064-3.001,5.375-6.089,5.375h-7.417c-3.088,0-5.705-2.311-6.088-5.375l-.203-1.625h18.867c.291,0,.558.12.75.338.192.219.278.497.242.786Z"/>
                          </svg>
                        
                        {{$listing->number_of_bathrooms}} حمام</div>

                </span>
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

                <div class="rounded-lg  border-2 max-h-96 w-1/2  p-5 dark:bg-slate-800 bg-white ">

                    <div class="flex gap-3">

                        @if ($avalbleDate == now()->format('F j, Y'))
                        متوفر من الان
                        @else
                        <span
                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800  dark:bg-yellow-800 dark:text-yellow-200">
                            غير متوفر حاليا </span>
                        متوفر من {{$avalbleDate}}
                        @endif


                    </div>
                    <form action="{{route('booking', $listing->id)}}" method="GET">

                        {{-- @csrf --}}

                        <div class="my-5 gap-2">
                            {{$listing->price_per_night}} <span class="text-xs">{{__('messages.EGP')}}</span>
                            {{__('messages.per night')}}
                        </div>
                        <x-layout.booking-check-date />
                        <hr class="my-5">
                        <x-layout.guest />


                        <button class="w-full bg-slate-500 rounded-lg text-white p-2 mt-5">
                            {{__('messages.Book now')}}</button>

                    </form>
                </div>
            </div>

        </div>
    </div>
</x-layout.layout>