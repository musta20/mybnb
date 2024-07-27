<div class=" px-4 py-2">
    <div
        class="bg-white hover:shadow-xl dark:hover:shadow-gray-700 dark:bg-gray-900 overflow-hidden shadow-sm  rounded-lg">
        <a href="{{ route('listing', $listing->id) }}">
            @if ($listing->media->count() == 0)
            <span class="text-gray-900 m-auto w-24 dark:text-gray-100">No image</span>
            @else
            <img src="{{ asset('listings/'.$listing?->media[0]?->path) }}" class=" min-w-[350px]  w-full max-h-[200px]"
                alt="">
            @endif
            <div class="-mt-44 mx-2 absolute hover:text-slate-300   ">
                <livewire:wichlist-button :$listing />
            </div>
            <div class="p-2 flex sm:flex-col justify-between align-middle text-sm ">

                <a class="w-full" href="{{ route('listing', $listing->id) }}">

                    <div class="flex justify-between my-1">
                        <p>
                            {{ $listing->title }}
                        </p>



                        <div class="flex gap-2 items-center">
                            <span>
                                <x-user-rating :rating="$listing->rating" :showText="false" />
                            </span>
                            <svg class="w-4 h-4 text-yellow-300 me-1" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                <path
                                    d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                            </svg>
                        </div>
                    </div>
                    <div class="flex justify-between ">
                        <p class="text-xs my-auto">{{ $listing->address }}</p>


                        <span class="flex gap-1 border-2 p-1 dark:border-gray-700  rounded-md items-center">
                            <p class="dark:text-yellow-100">
                                {{ $listing->price_per_night }}
                            </p>
                            <p style="font-size: 10px; padding: 1px 1px"> جنيه </p>

                        </span>

                    </div>
                </a>









            </div>
        </a>
    </div>
</div>