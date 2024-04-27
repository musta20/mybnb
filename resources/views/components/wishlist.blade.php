@auth

<a href="{{route('showCart')}}" class="hover:bg-slate-100 rounded-full p-2 flex justify-center justify-items-center">
    <span class="relative inline-block my-auto">

        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
        </svg>



        @if (count(Auth::user()->wichListings) > 0)
        <span class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs 
             font-bold leading-none text-red-100 transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full">
            {{ count(Auth::user()->wichListings) }}
        </span>
        @endif

    </span>
</a>
@else
<a href="{{route('showCart')}}" class="hover:text-red-400 rounded-full my-auto px-2 flex justify-center justify-items-center">
    <span class="relative inline-block">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
        </svg>





        @session('List')
        @if (count($value))
        <span class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs 
        font-bold leading-none text-red-100 transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full">
            {{ count($value) }}
        </span>
        @endif

        @endsession
    </span>
</a>
@endauth