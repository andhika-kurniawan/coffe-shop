<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Coffee Shop') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;900&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-background text-primary min-h-screen">
    <div id="app" x-data="{ cartOpen: false }" @cart-open.window="cartOpen = true" @cart-close.window="cartOpen = false">
        <x-navbar />

        <main class="pb-24">
            {{ $slot }}
        </main>

        <x-cart-drawer />

        <x-bottom-sheet />
    </div>
</body>
</html>