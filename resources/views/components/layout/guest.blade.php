@props(['beds'=>null])
<div class="mx-auto place-self-center  px-2 " x-data="{ counter: {{ request('bedrooms') ?? 0 }} }" >
    <div class="  flex   ">
        <button type="button" @click="counter > 0 ? counter--:''" id="decrement-button" data-input-counter-decrement="bedrooms-input"
        class="bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 rounded-s-full p-3 h-11 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
            <svg class="w-3 h-3 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h16"/>
            </svg>
        </button>
        <div class="flex  flex-col place-items-center gap-1">
        <input  id="bedrooms-input"


        type="number" aria-describedby="helper-text-explanation"
        name="bedrooms"
         class="bg-gray-50 border-x-0 w-full border-gray-300 h-11 font-medium text-center text-gray-400
         text-sm focus:ring-blue-500 focus:border-blue-500 block   pb-6 dark:bg-gray-700 dark:border-gray-600
          dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
         x-model="counter" required />
         <div class="absolute   text-gray-400 text-xs  py-6 flex gap-1 ">
            <svg class="w-2.5 h-2.5  text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8v10a1 1 0 0 0 1 1h4v-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v5h4a1 1 0 0 0 1-1V8M1 10l9-9 9 9"/>
            </svg>
            <span  >{{ __('messages.guests') }}</span>
         </div>
        </div>
        <button  @click="counter++"  type="button" id="increment-button" data-input-counter-increment="bedrooms-input" class="bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 rounded-e-full p-3 h-11 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
            <svg class="w-3 h-3 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
            </svg>
        </button>
    </div>
</div>
