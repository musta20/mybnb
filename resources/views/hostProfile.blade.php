<x-layout.layout>

    <div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">

                <div class="text-center flex flex-col">
                    
                    @if($user->profile_picture)

                    <img class="inline-block h-24 w-24 mx-auto rounded-full object-cover" src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}">

                    @else
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" 
                    class="mx-auto w-14 h-14">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                      </svg>
                      

                    @endif
                    <h1 class="text-2xl font-bold mt-2">{{$user->name  }}</h1>
                </div>
                <hr class="my-5">

                <div class="space-y-4">
                    <x-listings :$listings />

                </div>
                {{$listings->links()}}
            </div>
        </div>


    </div>
</x-layout.layout>