<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- FullCalendar v6+ CDN CSS -->
        <link href="https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.11/main.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@6.1.11/main.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/@fullcalendar/timegrid@6.1.11/main.min.css" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gradient-to-br from-gradient1 via-gradient2 to-gradient3 min-h-screen">
        <div class="min-h-screen flex flex-col items-center justify-start glass shadow-2xl pt-0 pb-8 px-2 sm:px-0 rounded-3xl">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="glass shadow rounded-xl mt-8">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="w-full max-w-7xl mx-auto px-2 sm:px-6 lg:px-8 mt-6">
                {{ $slot }}
            </main>
        </div>
        @stack('scripts')
    </body>
</html>
