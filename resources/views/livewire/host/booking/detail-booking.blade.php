<?php
use Livewire\Volt\Component;
use Carbon\Carbon;
use App\Enums\Status;
use App\Enums\BookingStatus;
use App\Models\Booking;
new class extends Component
{

public $events = [];
public $width = 'w-1/2';

public $guest;
public $status;
public $price;
public $listing;
public $special_requests;
public $month;
public $booking;

public function accept(){
        $this->booking->status = BookingStatus::ACTIVE->value;
        $this->booking->save();
        return redirect()->route('host.BookingDetail', $this->booking->id)->with('OkToast', __('messages.Booking accepted'));

    }

    public function decline(){
        $this->booking->status = BookingStatus::CANCELED->value;
        $this->booking->save();

        return redirect()->route('host.BookingDetail', $this->booking->id)->with('OkToast', __('messages.Booking Declined'));
    }

public function mount(Booking $Booking){

    $this->booking = $Booking;
    $this->listing = $Booking->listing;
    $this->guest = $Booking->guest;
    $this->status = $Booking->status;
    $this->price = $Booking->total_price;
    $this->special_requests = $Booking->special_requests;


    $this->month = Carbon::parse($Booking->check_out_date)->subMonth()->month;


    $this->events = [
        [
      "event_date"=>$Booking->check_in_date,
      "event_title"=> " النزول",
      "event_theme"=> 'green'
        ]
        ,
        [
      "event_date"=>$Booking->check_out_date,
      "event_title"=> " المغادرة",
      "event_theme"=> 'yellow'
        ]



    ];
}


}


?>
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('messages.booking detail') }}
    </h2>
</x-slot>


<div x-data class="py-12 flex gap-1 w-full ">
    <x-toast />


    <div class="w-1/2 mx-auto sm:px-6 lg:px-8 space-y-6 ">
        @if ($booking->status != 'canceled')

        <div class="p-4 sm:p-8 flex gap-2 bg-white justify-evenly dark:bg-gray-800 shadow sm:rounded-lg">
            @if ($booking->status == 'pending')

            <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded"
                wire:click="accept()">
                قبول الطلب
            </button>
            @endif

            <button wire:click="decline()" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">

                @if ($booking->status == 'active')
                الغاء
                @else
                رفض
                @endif

            </button>
        </div>
        @endif



        <div class="p-4 sm:p-8 flex gap-2 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <img class="w-1/2 rounded-md" src="{{ asset('listings/'.$listing->media[0]->path) }}" alt="">
            <div>
                <p class="mt-1 flex gap-2 max-w-2xl m-5 py-3 text-sm text-gray-500 dark:text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8.25 21v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21m0 0h4.5V3.545M12.75 21h7.5V10.75M2.25 21h1.5m18 0h-18M2.25 9l4.5-1.636M18.75 3l-1.5.545m0 6.205 3 1m1.5.5-1.5-.5M6.75 7.364V3h-3v18m3-13.636 10.5-3.819" />
                    </svg>
                    {{ $listing->title }}
                </p>
                <p class="mt-1 flex gap-2 max-w-2xl m-5 py-3 flex text-sm text-gray-500 dark:text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                    </svg>
                    {{ $listing->address }}
                </p>
                <p class="mt-1 flex gap-2 max-w-2xl m-5 py-3 flex text-sm text-gray-500 dark:text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 6.75V15m6-6v8.25m.503 3.498 4.875-2.437c.381-.19.622-.58.622-1.006V4.82c0-.836-.88-1.38-1.628-1.006l-3.869 1.934c-.317.159-.69.159-1.006 0L9.503 3.252a1.125 1.125 0 0 0-1.006 0L3.622 5.689C3.24 5.88 3 6.27 3 6.695V19.18c0 .836.88 1.38 1.628 1.006l3.869-1.934c.317-.159.69-.159 1.006 0l4.994 2.497c.317.158.69.158 1.006 0Z" />
                    </svg>
                    {{ __('messages.'.$listing->city) }}
                </p>

                <a href="{{ route('host.EditListing', $listing->id) }}"
                    class="mt-1 flex gap-2 max-w-2xl hover:bg-slate-600 rounded-md m-5 py-3 flex text-sm text-gray-500 dark:text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                    </svg>
                    عرض التفاصيل
                </a>
            </div>
        </div>

        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div>
                <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white">
                    تفاصيل الحجز</h3>

                <p class="mt-1 flex gap-2 max-w-2xl m-5 py-3 text-sm text-gray-500 dark:text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>

                    {{ $guest->name }}
                </p>
                <p class="mt-1 flex gap-2 max-w-2xl m-5 py-3 text-sm text-gray-500 dark:text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                    </svg>
                    {{ $status }}
                    <x-booking-status-card :status="$status" />

                </p>

                <div class="mt-1 flex gap-2 m-5 py-3 w-full text-gray-500 dark:text-gray-400">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
                        </svg>
                    </span>
                    <p>
                        {{ $special_requests }}
                    </p>
                </div>

                <p class="mt-1 flex gap-2 max-w-2xl m-5 py-3 text-sm text-gray-500 dark:text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                    </svg>
                    {{ $price }} <span class="text-xs">{{ __('messages.EGP') }}</span>
                </p>
            </div>
        </div>
    </div>
    <livewire:calendar :$width :$events :$month />
</div>