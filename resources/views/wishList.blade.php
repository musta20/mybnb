<x-layout.layout>

    @php

    if (Auth::check()) {

        $user= Auth::user();

        $wichListings = $user->wichListings;

    }else{

        $wichListings = App\Services\WishlistService::getList();

    }

    @endphp

    <section
        class="flex w-5/6 gap-10 bg-slate-50 dark:bg-slate-800 dark:border-slate-600 border-slate-200 p-5 border rounded-lg mx-auto">
        <ul class="py-5  w-1/2 mx-auto">

            @if ($wichListings->isEmpty())
                <p class="text-center text-2xl font-semibold">{{ __('messages.your wishlist is empty') }}</p>
            @endif

            @foreach ($wichListings as $item)
            <li class="rounded-lg w-full flex justify-between jistify-items-center border-b-2 dark:border-slate-600 p-5 m-2">
                @auth
                <img src="{{ asset('listings/'.$item->media[0]->path) }}" class="w-32 h-32 border rounded-lg" alt="">

                @else
                <img src="{{ asset('listings/'.$item->image) }}" class="w-32 h-32 border rounded-lg" alt="">

                @endauth

                <a href="{{ route('listing', $item->id) }}" class="my-auto">{{ $item->title }}</a>
                <span class="my-auto">
                    <a href="{{ route('removeList', $item->id) }}" class="hover:text-slate-950  ">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 cursor-pointer" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </a>
                </span>
            </li>
            @endforeach
        </ul>
    </section>
</x-layout.layout>