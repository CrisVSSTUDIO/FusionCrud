<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#712cf9">
    <link rel="icon" href="{{ asset('assets\icon\logo_icon_tab.png') }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/js/app.js', 'resources/css/app.scss'])


</head>

<body>
    <div id="app">
        <main class="py-4">
            <x-alert-success/>
            <x-alert-error/>

            @yield('content')
            <x-dark-toggle />
        </main>
    </div>
</body>

</html>
