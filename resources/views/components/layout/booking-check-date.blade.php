<div  class="  gap-2  items-center">
  <div class="relative   py-2 flex  ">
    <span class="my-auto w-3/6 px-2" >
      النزول :
    </span>


    <input name="start"
    autocomplete="off"
    wire:model.live="start"
    {{-- value="{{$end}}" --}}
     type="date"
     required
     class="bg-gray-50 w-5/6 border  border-gray-300 text-gray-900 text-sm rounded-full
      focus:ring-blue-500 focus:border-blue-500 block  p-2.5
       dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white
        dark:focus:ring-blue-500 dark:focus:border-blue-500"
        placeholder="{{ __('messages.Check Out') }}">

        {{-- <x-input-label for="update_password_current_password" :value="__('Current Password')" />
        <x-text-input wire:model="current_password" id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password" />
      --}}

  </div>


  <div class="relative   py-2 flex   ">
    <span class="my-auto w-3/6 px-2" >
      المغادرة :
    </span>

    <input name="end"
    autocomplete="off"
    required
    wire:model.live="end"
     {{-- value="{{$start}}" --}}
      type="date"
      class="bg-gray-50 border w-5/6 border-gray-300 text-gray-900 text-sm rounded-full focus:ring-blue-500 focus:border-blue-500 block  p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
      placeholder="{{ __('messages.Check In') }}">
  </div>


</div>