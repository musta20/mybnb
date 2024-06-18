<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    dir="{{ in_array(app()->getLocale(), ['ar']) ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/datepicker.min.js"></script> --}}

    
    <link rel="icon" href={{Vite::asset('resources/image/logo.svg')}}
    type="image/svg+xml"> 

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&family=IBM+Plex+Sans+Arabic:wght@100;200;300;400;500;600;700&family=Lateef:wght@200;300;400;500;600;700;800&family=Noto+Naskh+Arabic:wght@400..700&family=Readex+Pro:wght@160..700&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap"
        rel="stylesheet">

       <!-- Scripts -->
       {{-- <script  defer
       loading='async'
       src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_MAP_API_KEY')}}&callback=initMap&libraries=places"
       ></script> --}}

    <title>{{ $title ?? config('app.name', 'Laravel') }}</title>
    <script>
        
        const process = { env: {} };
        process.env.GOOGLE_MAPS_API_KEY = '{{config('app.GOOGLE_MAPS_KEY') }}';

    </script>
    @vite(['resources/css/app.css', 'resources/js/main.js','resources/js/map.js'])
</head>

<body class="bg-gray-100 text-slate-600 font-Rubik dark:bg-slate-800 dark:text-slate-500 ">
    <div class="bg-slate-100 dark:bg-slate-800 py-3">
        <x-layout.header />
    </div>

    <x-toast />

    {{ $slot }}

    <x-layout.footer />
</body>

</html>