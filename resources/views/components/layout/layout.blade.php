<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"   dir="{{ in_array(app()->getLocale(), ['ar']) ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ?? config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/main.js'])
</head>
<body class="bg-gray-100 dark:bg-slate-800">
    <x-layout.header />

    {{ $slot }}

    <x-layout.footer />
</body>
</html>