
<div class=" w-5/6 gap-10 bg-slate-50 dark:bg-slate-700 dark:border-slate-600 p-5 border rounded-lg mx-auto">
    <x-toast />
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
        @case('PENDING')
        <span class="bg-yellow-100 my-auto text-yellow-800 text-xs font-medium me-2 px-2.5 py-0.5 
                rounded dark:bg-gray-700 dark:text-yellow-300 border border-yellow-300">
            {{__('messages.'.$item->status)}}</span>
        @break
        @case('ACTIVE')
        <span class="bg-green-100 my-auto text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700
                 dark:text-green-400 border border-green-400">
            {{__('messages.'.$item->status)}}</span>

        </span>
        @case('REJECTED')
        <span class="bg-red-100 my-auto text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded
                 dark:bg-gray-700 dark:text-red-400 border border-red-400">
            {{__('messages.'.$item->status)}}</span>

        </span>

        @break

        @case('CANCELED')
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
            @if ($item->status != 'CANCELED')
            <button
                x-on:click.prevent="$dispatch('open-modal', 'confirm-booking-cancelation'); $wire.bookingId = '{{$item->id}}';"
                class="bg-red-600 m-5 hover:bg-red-700 text-slate-100 font-bold py-2 px-4 rounded-full">
                الغاء الحجز
            </button>
            @endif

        </div>
    </div>
    @endforeach
    <span dir="ltr" class="w-3/4 mx-auto">
        {{$bookings->links()}}
    </span>
    <x-modal name="confirm-booking-cancelation" :show="$errors->isNotEmpty()" focusable>
        <form wire:submit="cancleBooking" class="p-6">

            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Are you sure you want to delete your account?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please
                enter your password to confirm you would like to permanently delete your account.') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

                <x-text-input wire:model="password" id="password" name="password" type="password"
                    class="mt-1 block w-3/4" placeholder="{{ __('Password') }}" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button class="ms-3">
                    {{ __('Delete Account') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</div>