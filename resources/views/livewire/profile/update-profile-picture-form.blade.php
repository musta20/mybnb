<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use Livewire\Volt\Component;
use Livewire\WithFileUploads;

new class extends Component
{
    use WithFileUploads;

    public $profile_picture;
    
    public function uploadProfilePicture()
    {
        $validatedData = $this->validate([

            'profile_picture' => 'required|image|max:1024',

        ]);

        
        $fileName = $this->profile_picture->store();
   
        

        $user = Auth::user();

        $user->profile_picture =$fileName;

        $user->save();

        // addMedia($validatedData['profile_picture'])
        //     ->toMediaCollection('profile_picture');
    }

}; ?>

<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('update profuile picture') }}
        </h2>


    </header>



    <form wire:submit="uploadProfilePicture" enctype="multipart/form-data" class="mt-6 space-y-6">
        <span>
        @if (auth()->user()->profile_picture)
            <img src="{{ asset('listings/'.auth()->user()->profile_picture) }}"   class="w-24 h-24 rounded-full object-cover">
        @endif

        </span>
        <div>
            <x-input-label for="update_profile_picture" />
            <x-text-input wire:model="profile_picture" id="profile_picture" name="profile_picture" type="file"
                class="mt-1 block w-full" />
            <x-input-error :messages="$errors->get('profile_picture')" class="mt-2" />
        </div>


        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('upload') }}</x-primary-button>

            <x-action-message class="me-3" on="password-updated">
                {{ __('Saved.') }}
            </x-action-message>
        </div>
    </form>
</section>