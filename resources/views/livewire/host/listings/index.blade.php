<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('messages.listings') }}
    </h2>
    <hr class="my-2 dark:border-gray-600" >
    <div>
        <x-nav-link :href="route('host.AddListing')" :active="request()->routeIs('host.listing')" >
            {{ __('messages.new listing') }}
        </x-nav-link>
        </div>
</x-slot>
<div x-data class="py-12  gap-1 w-full ">
<x-toast />
<div class=" w-5/6  gap-10 bg-slate-50 dark:bg-slate-700
dark:text-slate-300
dark:border-slate-600 p-5 border rounded-lg mx-auto">



    @foreach ($listings as $item)



    <div class="w-3/4 mx-auto flex gap-3 justify-evenly border-t-2 p-2">
        <img src="{{ asset('listings/'.$item->media[0]->path) }}" class="w-32 h-32 border rounded-lg" alt="">
        <p class="my-auto flex gap-1 flex-col ">
            {{ $item->title }} ,
            {{ $item->city }}
            <span>
                {{ $item->price_per_night }} <span class="text-xs">{{ __('messages.EGP') }}</span>
                {{ __('messages.per night') }}

            </span>

        </p>
        @switch($item->status)
        @case('pending')
        <span class="bg-yellow-100 my-auto text-yellow-800 text-xs font-medium me-2 px-2.5 py-0.5
            rounded dark:bg-gray-700 dark:text-yellow-300 border border-yellow-300">
            {{ __('messages.'.$item->status) }}</span>
        @break
        @case('active')
        <span class="bg-green-100 my-auto text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700
             dark:text-green-400 border border-green-400">
            {{ __('messages.'.$item->status) }}</span>

        </span>

        @break

        @case('canceled')
        <span class="bg-red-100 my-auto text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded
             dark:bg-gray-700 dark:text-red-400 border border-red-400">
            {{ __('messages.'.$item->status) }}</span>
        </span>

        @break
        @default

        @endswitch
        {{-- <div class="my-auto text-sm">
            النزول : {{ date('d-m-Y', strtotime($item->check_in_date)) }} - المغادرة : {{ date('d-m-Y',
            strtotime($item->check_out_date)) }}
        </div> --}}



        <div class="my-auto">
            <a href="{{ route('host.EditListing', $item->id) }}"
                {{--
                x-on:click.prevent="$dispatch('open-modal', 'confirm-booking-cancelation'); $wire.bookingId = '{{ $item->id }}';"
                --}}

                class="bg-slate-500 m-5 hover:bg-slate-600 text-slate-100 font-bold py-2 px-4 rounded-full">
                عرض
            </a>

        </div>
    </div>


{{--
    <div class="min-w-7xl  min-h-9xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">


                @if ($item->media->count() == 0)
                    <span class="text-gray-900 m-auto w-24 dark:text-gray-100">No image</span>
                @else
                <img src="{{ asset('listings/'.$item?->media[0]?->path) }}" class=" max-w-full" alt="">

                    @endif


            <div class="p-5 flex justify-between align-baseline ">

                <div class=" text-gray-900 dark:text-gray-100">
                    {{ $item->title }}
                </div>

                <div class="flex gap-2 dark:text-white ">
                    <a href="{{ route('host.EditListing', $item->id) }}" class="hover:text-slate-500">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-9.75 0h9.75" />
                          </svg>

                    </a>

                </div>

            </div>

        </div>
    </div> --}}


@endforeach
<span dir="ltr" class="w-3/4 mx-auto">
    {{ $listings->links() }}
</span>
</div>
</div>
