<div x-data="{ open: false }"
class="max-w-[700px] px-2 mx-auto ">
    <div class="flex">


            <select
            name="city"

            class="items-center py-2.5  text-sm font-medium text-center text-gray-900 bg-gray-100 border
            border-gray-300 rounded-s-full w-36 hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 dark:bg-gray-700
            dark:hover:bg-gray-600 dark:focus:ring-gray-700 dark:text-white dark:border-gray-600"aria-labelledby="dropdown-button">
                @php($cites = App\Enums\Cities::cases())
                @foreach ($cites as $city)
                    <option
                    selected="{{ $city->value == request('city') }}"
                    value="{{ $city->value }}"
                        class="inline-flex w-full px-1 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{
                        __('messages.'.$city->value) }}</option>

                @endforeach

            </select>

            <div class="relative w-full">
            <input type="search"
            name="search"
            value="{{ request('search') }}"
             id="search-dropdown" class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-e-full border-s-gray-50 border-s-2 border
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