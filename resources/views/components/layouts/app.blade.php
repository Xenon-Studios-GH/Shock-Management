@props(['title' => 'Dashboard'])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title }} — {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-[#0F1117] text-[#E6EDF3] antialiased">
    <div class="flex min-h-screen">
        <x-sidebar />
        <main class="ml-64 flex-1">
            <div class="p-8">
                {{ $slot }}
            </div>
        </main>
    </div>
</body>
</html>
