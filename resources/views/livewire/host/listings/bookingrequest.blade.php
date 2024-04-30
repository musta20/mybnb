<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('messages.booking requests') }}
    </h2>
</x-slot>

<div x-data class="py-12  gap-1 w-full ">
    {{-- <div class=" w-5/6 my-5  gap-10 bg-slate-50 dark:bg-slate-700
dark:text-slate-300
dark:border-slate-600 p-5 border rounded-lg mx-auto">
        {!! $filterBox !!}

    </div> --}}
    <div class=" w-5/6  gap-10 bg-slate-50 dark:bg-slate-700
dark:text-slate-300
dark:border-slate-600 p-5 border rounded-lg mx-auto">
        @foreach ($bookings as $item)
        <div class="w-3/4 mx-auto flex gap-3 justify-evenly border-t-2 p-2">
            <img src="{{asset('listings/'.$item->listing->media[0]->path)}}" class="w-32 h-32 border rounded-lg" alt="">
            <p class="my-auto flex gap-1 flex-col ">
                {{$item->listing->title}} ,
                {{$item->listing->city}}
                <span>
                    {{$item->listing->price_per_night}} <span class="text-xs">{{__('messages.EGP')}}</span>
                    {{__('messages.per night')}}

                </span>

            </p>
            @switch($item->status)
            @case('pending')
            <span class="bg-yellow-100 my-auto text-yellow-800 text-xs font-medium me-2 px-2.5 py-0.5 
                rounded dark:bg-gray-700 dark:text-yellow-300 border border-yellow-300">
                {{__('messages.'.$item->status)}}</span>
            @break
            @case('active')
            <span class="bg-green-100 my-auto text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700
                 dark:text-green-400 border border-green-400">
                {{__('messages.'.$item->status)}}</span>

            </span>

            @break

            @case('canceled')
            <span class="bg-red-100 my-auto text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded
                 dark:bg-gray-700 dark:text-red-400 border border-red-400">
                {{__('messages.'.$item->status)}}</span>
            </span>

            @break
            @default

            @endswitch
            <div class="my-auto text-sm">
                النزول : {{ date('d-m-Y', strtotime($item->check_in_date)) }} - المغادرة : {{ date('d-m-Y',
                strtotime($item->check_out_date)) }}
            </div>



            <div class="my-auto">
                <a href="{{route('host.BookingDetail', $item->id)}}" {{--
                    x-on:click.prevent="$dispatch('open-modal', 'confirm-booking-cancelation'); $wire.bookingId = '{{$item->id}}';"
                    --}} class="bg-slate-500 m-5 hover:bg-slate-600 text-slate-100 font-bold py-2 px-4 rounded-full">
                    عرض
                </a>

            </div>
        </div>
        @endforeach
        <span dir="ltr" class="w-3/4 mx-auto">
            {{$bookings->links()}}
        </span>

    </div>
</div>