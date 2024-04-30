<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('messages.Booking') }}
    </h2>
</x-slot>
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-2 py-12">
 
    @foreach ($bookings as $item)
    <div class="min-w-7xl  min-h-9xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

            {{-- <div class="grid grid-cols-2 gap-1"> --}}
                {{-- @foreach ($item->images as $img) --}}
                @if ($item->listing->media->count() == 0)
                    <span class="text-gray-900 m-auto w-24 dark:text-gray-100">No image</span>
                @else 
                <img src="{{ asset('listings/'.$item->listing?->media[0]?->path) }}" class=" max-w-full" alt="">

                    @endif
                
                {{-- @endforeach --}}
            {{-- </div> --}}

            <div class="p-5 flex justify-between align-baseline ">

                <div class=" text-gray-900 dark:text-gray-100">
                    {{ $item->guest->name }}
                </div>


                <div class=" text-gray-900 dark:text-gray-100">
                    {{ $item->listing->title }}
                </div>
                
                <div class="flex gap-2 dark:text-white ">
                    <a href="{{ route('host.BookingDetail', $item->id) }}" class="hover:text-slate-500">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-9.75 0h9.75" />
                          </svg>
                          
                    </a>
              
                </div>

            </div>
   
        </div>
    </div>

@endforeach
</div>