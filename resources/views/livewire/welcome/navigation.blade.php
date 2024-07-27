<nav x-data="{ UserdropdownOpen: false,dropdownOpen: false , open: false ,darkMode: localStorage.theme === 'dark' ? true:false }"
class=" border bg-white  dark:bg-slate-600 dark:border-slate-500 rounded-full h-12 flex  justify-between">
    @auth

    <div class="relative !min-w-90 p-1 "@click.outside="dropdownOpen = false">
        <a class="flex items-center gap-2" href="#" @click.prevent="dropdownOpen = ! dropdownOpen">
            @if (auth()->user()->profile_picture)
                <img  src="{{ asset('listings/'.auth()->user()->profile_picture) }}" alt="{{ auth()->user()->name }}"
                class="w-9  h-9 rounded-full object-cover">

            @else
            <div class="flex justify-center justify-items-center p-1 uppercase font-bold text-lg
            text-center w-10 h-9 rounded-full bg-yellow-200
             border-3 text-slate-700">
                <p>{{ substr(auth()->user()->name,0*2,1*2) }}</p>
            </div>
            @endif
        </a>

        <!-- Dropdown Start -->
        <div x-cloak x-show="dropdownOpen"
            class="absolute z-10 ltr:-right-25 mt-2 flex w-40 flex-col rounded-sm border border-stroke bg-white shadow-default">
            <ul class="flex  flex-col border-b border-stroke px-5 py-7.5">
                <li>
                    <a href="{{ route('profile') }}"
                        class="flex items-center py-4 gap-3.5  text-xs font-medium duration-300 ease-in-out hover:text-primary ">
                        <svg class="fill-current" width="22" height="22" viewBox="0 0 22 22" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M11 9.62499C8.42188 9.62499 6.35938 7.59687 6.35938 5.12187C6.35938 2.64687 8.42188 0.618744 11 0.618744C13.5781 0.618744 15.6406 2.64687 15.6406 5.12187C15.6406 7.59687 13.5781 9.62499 11 9.62499ZM11 2.16562C9.28125 2.16562 7.90625 3.50624 7.90625 5.12187C7.90625 6.73749 9.28125 8.07812 11 8.07812C12.7188 8.07812 14.0938 6.73749 14.0938 5.12187C14.0938 3.50624 12.7188 2.16562 11 2.16562Z"
                                fill="" />
                            <path
                                d="M17.7719 21.4156H4.2281C3.5406 21.4156 2.9906 20.8656 2.9906 20.1781V17.0844C2.9906 13.7156 5.7406 10.9656 9.10935 10.9656H12.925C16.2937 10.9656 19.0437 13.7156 19.0437 17.0844V20.1781C19.0094 20.8312 18.4594 21.4156 17.7719 21.4156ZM4.53748 19.8687H17.4969V17.0844C17.4969 14.575 15.4344 12.5125 12.925 12.5125H9.07498C6.5656 12.5125 4.5031 14.575 4.5031 17.0844V19.8687H4.53748Z"
                                fill="" />
                        </svg>
                        {{ __('messages.Profile') }}
                    </a>
                </li>
                <li>
                    <a href="{{ route('bookingdetail') }}"
                        class="flex items-center py-4 gap-3.5 text-xs font-medium duration-300 ease-in-out hover:text-primary ">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0 1 18 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3 1.5 1.5 3-3.75" />
                          </svg>


                        {{ __('messages.bookings') }}
                    </a>
                </li>

                @if (auth()->user()->type == App\Enums\HostType::HOST->value)

                <li>
                    <a href="{{ route('profile') }}"
                        class="flex items-center py-4 gap-3.5 text-xs font-medium duration-300 ease-in-out hover:text-primary ">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-9.75 0h9.75" />
                          </svg>

                        {{ __('messages.Profile') }}
                    </a>
                </li>

                @endif



            </ul>
            <button
                class="flex items-center gap-3 py-4 px-3  text-sm font-medium duration-300 ease-in-out hover:text-primary ">
                <svg class="fill-current" width="22" height="22" viewBox="0 0 22 22" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M15.5375 0.618744H11.6531C10.7594 0.618744 10.0031 1.37499 10.0031 2.26874V4.64062C10.0031 5.05312 10.3469 5.39687 10.7594 5.39687C11.1719 5.39687 11.55 5.05312 11.55 4.64062V2.23437C11.55 2.16562 11.5844 2.13124 11.6531 2.13124H15.5375C16.3625 2.13124 17.0156 2.78437 17.0156 3.60937V18.3562C17.0156 19.1812 16.3625 19.8344 15.5375 19.8344H11.6531C11.5844 19.8344 11.55 19.8 11.55 19.7312V17.3594C11.55 16.9469 11.2062 16.6031 10.7594 16.6031C10.3125 16.6031 10.0031 16.9469 10.0031 17.3594V19.7312C10.0031 20.625 10.7594 21.3812 11.6531 21.3812H15.5375C17.2219 21.3812 18.5625 20.0062 18.5625 18.3562V3.64374C18.5625 1.95937 17.1875 0.618744 15.5375 0.618744Z"
                        fill="" />
                    <path
                        d="M6.05001 11.7563H12.2031C12.6156 11.7563 12.9594 11.4125 12.9594 11C12.9594 10.5875 12.6156 10.2438 12.2031 10.2438H6.08439L8.21564 8.07813C8.52501 7.76875 8.52501 7.2875 8.21564 6.97812C7.90626 6.66875 7.42501 6.66875 7.11564 6.97812L3.67814 10.4844C3.36876 10.7938 3.36876 11.275 3.67814 11.5844L7.11564 15.0906C7.25314 15.2281 7.45939 15.3312 7.66564 15.3312C7.87189 15.3312 8.04376 15.2625 8.21564 15.125C8.52501 14.8156 8.52501 14.3344 8.21564 14.025L6.05001 11.7563Z"
                        fill="" />
                </svg>
                <form method="GET" class="w-70"
                action="{{ route('logout') }}"
                >
                    @csrf
                    <a onclick="event.preventDefault();
                                  this.closest('form').submit();">
                        {{ __('messages.Log Out') }}
                    </a>
                </form>
            </button>
        </div>
        <!-- Dropdown End -->
    </div>



    @else
        <button @click="UserdropdownOpen = ! UserdropdownOpen">

            <svg xmlns="http://www.w3.org/2000/svg"
             viewBox="0 0 24 24"
             class="w-10 h-10 hover:text-slate-400 dark:text-slate-300"
             fill="currentColor">
                <path fill-rule="evenodd"
                    d="M18.685 19.097A9.723 9.723 0 0 0 21.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 0 0 3.065 7.097A9.716 9.716 0 0 0 12 21.75a9.716 9.716 0 0 0 6.685-2.653Zm-12.54-1.285A7.486 7.486 0 0 1 12 15a7.486 7.486 0 0 1 5.855 2.812A8.224 8.224 0 0 1 12 20.25a8.224 8.224 0 0 1-5.855-2.438ZM15.75 9a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z"
                    clip-rule="evenodd" />
            </svg>

        </button>

        <div x-show="UserdropdownOpen"
            class="absolute ltr:-right-25 mt-11 dark:bg-slate-800  flex w-44 flex-col rounded-md border border-stroke bg-white shadow-default">


            <ul class="flex py-4  flex-col border-b border-stroke py-7.5">
                <li class="mb-4">
                    <a href="{{ route('login') }}"
                        class="flex gap-2 rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none
                         focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                         <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                            <path fill-rule="evenodd" d="M7.5 3.75A1.5 1.5 0 0 0 6 5.25v13.5a1.5 1.5 0 0 0 1.5 1.5h6a1.5 1.5 0 0 0 1.5-1.5V15a.75.75 0 0 1 1.5 0v3.75a3 3 0 0 1-3 3h-6a3 3 0 0 1-3-3V5.25a3 3 0 0 1 3-3h6a3 3 0 0 1 3 3V9A.75.75 0 0 1 15 9V5.25a1.5 1.5 0 0 0-1.5-1.5h-6Zm5.03 4.72a.75.75 0 0 1 0 1.06l-1.72 1.72h10.94a.75.75 0 0 1 0 1.5H10.81l1.72 1.72a.75.75 0 1 1-1.06 1.06l-3-3a.75.75 0 0 1 0-1.06l3-3a.75.75 0 0 1 1.06 0Z" clip-rule="evenodd" />
                          </svg>

                        {{ __('messages.Log In') }}
                    </a>
                </li>

                <li class=" ">
                    @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                        class="flex gap-2  rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70
                         focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                         <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                            <path d="M5.25 6.375a4.125 4.125 0 1 1 8.25 0 4.125 4.125 0 0 1-8.25 0ZM2.25 19.125a7.125 7.125 0 0 1 14.25 0v.003l-.001.119a.75.75 0 0 1-.363.63 13.067 13.067 0 0 1-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 0 1-.364-.63l-.001-.122ZM18.75 7.5a.75.75 0 0 0-1.5 0v2.25H15a.75.75 0 0 0 0 1.5h2.25v2.25a.75.75 0 0 0 1.5 0v-2.25H21a.75.75 0 0 0 0-1.5h-2.25V7.5Z" />
                          </svg>

                        {{ __('messages.Register') }}

                    </a>
                    @endif
                </li>
            </ul>
        </div>



    @endauth
    <script>
          function setTheme(theme) {
            console.log(theme);
    localStorage.theme = theme;
    if(theme === 'dark') {
    document.documentElement.classList.add('dark')
    } else {
    document.documentElement.classList.remove('dark')
    }
  };
        </script>
    <div
        class="flex px-2 items-center justify-end  pr-4">
        <label class="inline-flex items-center cursor-pointer">
            <input type="checkbox" x-model="darkMode"

            {{-- set the checkbox checked if the current theme is darkmode --}}



                @change="$event.target.checked ?   setTheme('dark') : setTheme('light') "

                value="" class="sr-only peer">
            <div
                class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-sky-900 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-sky-900">
            </div>
        </label>
    </div>
    <x-wishlist />
</nav>