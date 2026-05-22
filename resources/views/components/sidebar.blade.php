@props(['active' => 'dashboard'])

<aside class="fixed left-0 top-0 z-40 h-screen w-64 border-r border-[#232A36] bg-[#0F1117]">
    <div class="flex h-16 items-center gap-3 border-b border-[#232A36] px-6">
        <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-[#3B82F6]">
            <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
            </svg>
        </div>
        <span class="text-lg font-bold text-[#E6EDF3]">Dribbling Stock</span>
    </div>

    <nav class="space-y-1 px-3 py-4">
        <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')" icon="dashboard">
            Dashboard
        </x-nav-link>

        @if (Auth::user()->role === 'superadmin')
            <div class="my-3 border-t border-[#232A36]"></div>
            <p class="px-3 pb-1 text-xs font-medium uppercase tracking-wider text-[#94A3B8]">Administration</p>

            <x-nav-link href="{{ route('workers.index') }}" :active="request()->routeIs('workers.*')" icon="users">
                Workers
            </x-nav-link>
            <x-nav-link href="{{ route('login-logs.index') }}" :active="request()->routeIs('login-logs.*')" icon="login">
                Login Logs
            </x-nav-link>
            <x-nav-link href="{{ route('work-logs.index') }}" :active="request()->routeIs('work-logs.*')" icon="activity">
                Work Logs
            </x-nav-link>

            <div class="my-3 border-t border-[#232A36]"></div>
            <p class="px-3 pb-1 text-xs font-medium uppercase tracking-wider text-[#94A3B8]">Stock</p>
        @endif

        <x-nav-link href="{{ route('stock.management') }}" :active="request()->routeIs('stock.management')" icon="stock">
            Stock Management
        </x-nav-link>
        <x-nav-link href="{{ route('stock.in') }}" :active="request()->routeIs('stock.in')" icon="stockin">
            Stock In
        </x-nav-link>
        <x-nav-link href="{{ route('stock.out') }}" :active="request()->routeIs('stock.out')" icon="stockout">
            Stock Out
        </x-nav-link>
    </nav>

    <div class="absolute bottom-0 left-0 right-0 border-t border-[#232A36] px-3 py-4">
        <div class="mb-3 px-3">
            <p class="text-sm font-medium text-[#E6EDF3]">{{ Auth::user()->name }}</p>
            <p class="text-xs text-[#94A3B8]">{{ ucfirst(Auth::user()->role) }}</p>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="flex w-full items-center gap-3 rounded-xl px-3 py-2.5 text-sm text-[#94A3B8] transition-colors hover:bg-[#1C2333] hover:text-[#EF4444]">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                </svg>
                Logout
            </button>
        </form>
    </div>
</aside>
