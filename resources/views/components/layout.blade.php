<!DOCTYPE html>
<html class="scroll-pt-12 scroll-smooth" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <link rel="icon" type="image/png" href="/favicon-96x96.png" sizes="96x96" />
        <link rel="icon" type="image/svg+xml" href="/favicon.svg" />
        <link rel="shortcut icon" href="/favicon.ico" />
        <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png" />
        <meta name="apple-mobile-web-app-title" content="CarterStevens" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <link rel="manifest" href="/site.webmanifest" />
        <title>Carter Stevens | PHP Developer</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
            href="https://fonts.googleapis.com/css2?family=Azeret+Mono:ital,wght@0,100..900;1,100..900&family=Gloria+Hallelujah&display=swap"
            rel="stylesheet"
        />

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
    </head>

    <body
        class="bg-darkPurple {{ $class ?? '' }} relative flex min-h-screen overflow-x-hidden px-6 text-slate-400 lg:px-8"
    >
        <div
            id="spotlight-container"
            class="cursor-spotlight before:pointer-events-none before:fixed before:inset-0 before:content-[''] max-md:hidden"
        ></div>
        {{ $slot }}
    </body>
</html>