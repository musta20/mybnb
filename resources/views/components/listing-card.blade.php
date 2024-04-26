<div  class=" px-4 py-2">
    <div  class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

        @if ($listing->media->count() == 0)
        <span class="text-gray-900 m-auto w-24 dark:text-gray-100">No image</span>
        @else
        <img src="{{ asset('listings/'.$listing?->media[0]?->path) }}" class=" min-w-[350px] w-full max-h-[200px]"
            alt="">
        @endif
        <button class="-mt-44 mx-2 absolute hover:text-slate-300 text-slate-400  ">
            <svg xmlns="http://www.w3.org/2000/svg" fill="#f9f9f9" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-6 h-6  rounded-full">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
            </svg>
        </button>

        <div class="p-5 flex justify-between align-baseline text-sm ">
            <a href="{{ route('listing', $listing->id) }}" class=" text-gray-900 dark:text-gray-100">
                {{ $listing->title }}
            </a>
            <x-user-rating  :rating="$listing->rating" :showText="false" />
        </div>
    </div>
</div>