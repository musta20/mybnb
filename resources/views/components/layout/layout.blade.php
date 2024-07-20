<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    dir="{{ in_array(app()->getLocale(), ['ar']) ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="icon" href={{ Vite::asset('resources/image/logo.svg') }}
    type="image/svg+xml">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&family=IBM+Plex+Sans+Arabic:wght@100;200;300;400;500;600;700&family=Lateef:wght@200;300;400;500;600;700;800&family=Noto+Naskh+Arabic:wght@400..700&family=Readex+Pro:wght@160..700&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap"
        rel="stylesheet">
        <script>

            const process = { env: {} };
            process.env.GOOGLE_MAPS_API_KEY = '{{ config('app.GOOGLE_MAPS_KEY') }}';
            process.env.MAP_ID = '{{ config('app.MAP_ID') }}';
            const mainUrl = '{{ url('/') }}';
        </script>
        <script>
            (g=>{var h,a,k,p="The Google Maps JavaScript API",c="google",l="importLibrary",q="__ib__",m=document,b=window;b=b[c]||(b[c]={});var d=b.maps||(b.maps={}),r=new Set,e=new URLSearchParams,u=()=>h||(h=new Promise(async(f,n)=>{await (a=m.createElement("script"));e.set("libraries",[...r]+"");for(k in g)e.set(k.replace(/[A-Z]/g,t=>"_"+t[0].toLowerCase()),g[k]);e.set("callback",c+".maps."+q);a.src=`https://maps.${c}apis.com/maps/api/js?`+e;d[q]=f;a.onerror=()=>h=n(Error(p+" could not load."));a.nonce=m.querySelector("script[nonce]")?.nonce||"";m.head.append(a)}));d[l]?console.warn(p+" only loads once. Ignoring:",g):d[l]=(f,...n)=>r.add(f)&&u().then(()=>d[l](f,...n))})({
              key: process.env.GOOGLE_MAPS_API_KEY ,
              v: "weekly",
              // Use the 'v' parameter to indicate the version to use (weekly, beta, alpha, etc.).
              // Add other bootstrap parameters as needed, using camel case.
            });
          </script>
    <title>{{ $title ?? config('app.name', 'Laravel') }}</title>

    @vite(['resources/css/app.css', 'resources/js/main.js'])
</head>

<body class="bg-gray-50 text-slate-600 font-Rubik dark:bg-slate-800 dark:text-slate-500 ">
    <div class="bg-slate-50 dark:bg-slate-800 py-3">
        <x-layout.header />
    </div>

    <x-toast />

    {{ $slot }}

    <x-layout.footer />
</body>

</html>