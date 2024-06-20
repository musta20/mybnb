<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('messages.edit listing') }}
    </h2>
</x-slot>
@vite(['resources/js/add-map.js'])

<div x-data class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <livewire:host.file-manger :$subFiles :$listing wire:model='subFiles' />
            {{--
                 <livewire:profile.update-profile-information-form />
            --}}
        </div>

        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="w-full">
                <livewire:host.listings.update-listing :$listing />
            </div>
        </div>

        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="max-w-xl">
                <livewire:host.listings.delete-listing :$listing />
            </div>
        </div>
    </div>
</div>