<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login — {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-[#0F1117] text-[#E6EDF3] antialiased">
    <div class="flex min-h-screen items-center justify-center px-4">
        <div class="w-full max-w-sm">
            <div class="mb-8 text-center">
                <div class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-2xl bg-[#3B82F6]">
                    <svg class="h-7 w-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                </div>
                <h1 class="text-2xl font-bold text-[#E6EDF3]">Dribbling Stock</h1>
                <p class="mt-1 text-sm text-[#94A3B8]">Sign in to your account</p>
                <p class="mt-1 text-xs text-[#F59E0B]">Max 5 attempts per minute</p>
            </div>

            <div class="rounded-xl border border-[#232A36] bg-[#161B22] p-6">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="space-y-2">
                        <label for="email" class="text-sm font-medium text-[#E6EDF3]">Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                            class="block w-full rounded-xl border border-[#232A36] bg-[#0F1117] px-4 py-2.5 text-sm text-[#E6EDF3] placeholder-[#94A3B8] transition-colors focus:border-[#3B82F6] focus:outline-none focus:ring-1 focus:ring-[#3B82F6]">
                        @error('email')
                        <p class="text-sm text-[#EF4444]">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mt-4 space-y-2">
                        <label for="password" class="text-sm font-medium text-[#E6EDF3]">Password</label>
                        <input id="password" type="password" name="password" required autocomplete="current-password"
                            class="block w-full rounded-xl border border-[#232A36] bg-[#0F1117] px-4 py-2.5 text-sm text-[#E6EDF3] placeholder-[#94A3B8] transition-colors focus:border-[#3B82F6] focus:outline-none focus:ring-1 focus:ring-[#3B82F6]">
                    </div>

                    <div class="mt-4 flex items-center justify-between">
                        <label class="flex items-center gap-2">
                            <input type="checkbox" name="remember" class="h-4 w-4 rounded border-[#232A36] bg-[#0F1117] text-[#3B82F6] focus:ring-[#3B82F6]">
                            <span class="text-sm text-[#94A3B8]">Remember me</span>
                        </label>
                        <a href="{{ route('password.request') }}" class="text-sm text-[#3B82F6] hover:text-[#2563EB]">Forgot password?</a>
                    </div>

                    @if (session('status'))
                    <p class="mt-4 text-sm text-[#22C55E]">{{ session('status') }}</p>
                    @endif

                    <button type="submit"
                        class="mt-6 w-full rounded-xl bg-[#3B82F6] px-4 py-2.5 text-sm font-medium text-white transition-colors hover:bg-[#2563EB] focus:outline-none focus:ring-2 focus:ring-[#3B82F6] focus:ring-offset-2 focus:ring-offset-[#0F1117]">
                        Sign in
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>