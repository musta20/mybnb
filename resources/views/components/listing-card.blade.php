<div  class=" px-4 py-2">
    <div class="bg-white hover:shadow-xl dark:hover:shadow-gray-700 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
    <a href="{{ route('listing', $listing->id) }}">
        @if ($listing->media->count() == 0)
        <span class="text-gray-900 m-auto w-24 dark:text-gray-100">No image</span>
        @else
        <img src="{{ asset('listings/'.$listing?->media[0]?->path) }}" class=" min-w-[350px] w-full max-h-[200px]"
            alt="">
        @endif
        <div class="-mt-44 mx-2 absolute hover:text-slate-300   ">
            <livewire:wichlist-button :$listing />
        </div>
        <div class="p-5 flex sm:flex-col justify-between align-baseline text-sm ">
            <a  href="{{ route('listing', $listing->id) }}" class=" text-gray-900 dark:text-gray-100">
                {{ $listing->title }}
            </a>
            <x-user-rating  :rating="$listing->rating" :showText="false" />
        </div>
    </a>
    </div>
</div>