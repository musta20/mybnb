@props(['start'=>null,'end'=>null,'beds'=>null])



<nav id="responsive-nav"  x-data="{ open: false }" class="bg-white sm:hidden lg:hidden md:hidden   flex-col justify-between border-2
border-gray-200 mx-auto w-4/6 sm:px-4 py-2
dark:border-gray-600
place-content-center
 rounded-2xl dark:bg-gray-700">

    <button @click="open = !open" class=" px-10 mx-auto my-auto flex  place-content-center     gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
        </svg>
        {{ __('messages.Search') }}
    </button>

    <div x-transition class="flex gap-5 flex-col place-content-center" x-show="open">

        <div dir="ltr" id="dateRangePickerId" class="flex gap-2 p-3 place-content-center  items-center">


            <div class="relative w-32">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                    </svg>
                </div>
                <input name="end" autocomplete="off" value="{{ $end }}" type="text" class="bg-gray-50 border w-32 border-gray-300 text-gray-900 text-sm rounded-full
                        focus:ring-blue-500 focus:border-blue-500 block ps-10 p-2.5
                        dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white
                            dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="{{ __('messages.Check Out') }}">

                {{--
                <x-input-label for="update_password_current_password" :value="__('Current Password')" />
                <x-text-input wire:model="current_password" id="update_password_current_password"
                    name="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password" />
                --}}
            </div>


            <div class="relative w-32 ">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                    </svg>
                </div>

                <input name="start" autocomplete="off" value="{{ $start }}" type="text"
                    class="bg-gray-50 border w-32 border-gray-300 text-gray-900 text-sm rounded-full focus:ring-blue-500 focus:border-blue-500 block  ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="{{ __('messages.Check In') }}">
            </div>


        </div>





        <div class="max-w-xs  mx-auto px-2" x-data="{ counter: {{ request('bedrooms') ?? 0 }} }">
            <div class="relative flex items-center max-w-[11rem]">
                <button type="button" @click="counter > 0 ? counter--:''" id="decrement-button"
                    data-input-counter-decrement="bedrooms-input"
                    class="bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 rounded-s-full p-3 h-11 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                    <svg class="w-3 h-3 text-gray-900 dark:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 1h16" />
                    </svg>
                </button>
                <input id="bedrooms-input" type="number" aria-describedby="helper-text-explanation" name="bedrooms"
                    class="bg-gray-50 border-x-0 border-gray-300 h-11 font-medium text-center text-gray-400
         text-sm focus:ring-blue-500 focus:border-blue-500 block w-[3.5rem] text-center pb-6 dark:bg-gray-700 dark:border-gray-600
          dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    x-model="counter" required />
                <div
                    class="absolute bottom-1 start-1/2 -translate-x-1/2 rtl:translate-x-1/2 flex items-center text-xs text-gray-400 space-x-1 rtl:space-x-reverse">
                    <svg class="w-2.5 h-2.5 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 8v10a1 1 0 0 0 1 1h4v-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v5h4a1 1 0 0 0 1-1V8M1 10l9-9 9 9" />
                    </svg>
                    <span>{{ __('messages.guests') }}</span>
                </div>
                <button @click="counter++" type="button" id="increment-button"
                    data-input-counter-increment="bedrooms-input"
                    class="bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 rounded-e-full p-3 h-11 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                    <svg class="w-3 h-3 text-gray-900 dark:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 1v16M1 9h16" />
                    </svg>
                </button>
            </div>
        </div>




        <div x-data="{ open: false }" class="max-w-[700px] px-2  p-5    mx-auto ">
            <div class="flex">


                <select name="city" class="items-center py-2.5  text-sm font-medium text-center text-gray-900 bg-gray-100 border
            border-gray-300 rounded-s-full w-36 hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 dark:bg-gray-700
            dark:hover:bg-gray-600 dark:focus:ring-gray-700 dark:text-white dark:border-gray-600"
                    aria-labelledby="dropdown-button">
                    @php($cites = App\Enums\Cities::cases())
                    @foreach ($cites as $city)
                    <option selected="{{ $city->value == request('city') }}" value="{{ $city->value }}"
                        class="inline-flex w-full px-1 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                        {{
                        __('messages.'.$city->value) }}</option>

                    @endforeach

                </select>

                <div class="relative w-full">
                    <input type="search" name="search" value="{{ request('search') }}" id="search-dropdown" class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-e-full border-s-gray-50 border-s-2 border
            border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-s-gray-700
             dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500"
                        placeholder="المدينة , المنتطقة , المحافظة" required />
                    <button type="submit"
                        class="absolute top-0 end-0 p-3 text-sm font-medium h-full text-white bg-sky-950 rounded-e-full border border-gray-900 hover:bg-sky-900 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                        <span class="sr-only">Search</span>
                    </button>
                </div>
            </div>


        </div>


    </div>







</nav>