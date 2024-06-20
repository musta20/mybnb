@switch($status)
@case('pending')
<span class="bg-yellow-100 my-auto text-yellow-800 text-xs font-medium me-2 px-2.5 py-0.5
        rounded dark:bg-gray-700 dark:text-yellow-300 border border-yellow-300">
    {{ __('messages.'.$status) }}</span>
@break
@case('active')
<span class="bg-green-100 my-auto text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700
         dark:text-green-400 border border-green-400">
    {{ __('messages.'.$status) }}</span>

</span>
@break

@case('canceled')
<span class="bg-red-100 my-auto text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded
         dark:bg-gray-700 dark:text-red-400 border border-red-400">
    {{ __('messages.'.$status) }}</span>

</span>

@break

@case('CANCELED')
<span class="bg-red-100 my-auto text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded
         dark:bg-gray-700 dark:text-red-400 border border-red-400">
    {{ __('messages.'.$status) }}</span>

</span>

@break
@default

@endswitch
