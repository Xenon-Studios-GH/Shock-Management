@props(['active' => 'dashboard'])

<aside class="fixed left-0 top-0 z-40 flex h-screen flex-col border-r border-[#232A36] bg-[#0F1117] transition-all duration-300
              w-64
              -translate-x-full md:translate-x-0 md:w-16 lg:w-64"
       :class="{'translate-x-0': sidebarOpen}">

    <!-- Logo -->
    <div class="flex h-16 shrink-0 items-center gap-3 border-b border-[#232A36] px-4 md:px-3 lg:px-6">
        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-[#3B82F6]">
            <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
            </svg>
        </div>
        <span class="text-lg font-bold text-[#E6EDF3] hidden lg:inline">Dribbling Stock</span>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 space-y-1 overflow-y-auto px-2 py-4 md:px-1 lg:px-3" aria-label="Main navigation">
        <!-- Dashboard -->
        <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')" icon="dashboard">
            Dashboard
        </x-nav-link>

        @if (Auth::user()->role === 'superadmin')
            <div class="my-3 border-t border-[#232A36]"></div>
            <p class="hidden lg:block px-3 pb-1 text-xs font-medium uppercase tracking-wider text-[#94A3B8]">Administration</p>

            <x-nav-link href="{{ route('workers.index') }}" :active="request()->routeIs('workers.*')" icon="users">
                Workers
            </x-nav-link>
            <x-nav-link href="{{ route('login-logs.index') }}" :active="request()->routeIs('login-logs.*')" icon="login">
                Login Logs
            </x-nav-link>
            <x-nav-link href="{{ route('work-logs.index') }}" :active="request()->routeIs('work-logs.*')" icon="activity">
                Work Logs
            </x-nav-link>

            <div class="flex cursor-not-allowed items-center gap-3 rounded-xl px-3 py-2.5 text-sm text-[#94A3B8] opacity-50" title="Coming soon">
                <svg class="h-5 w-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
                <span class="hidden lg:inline">Analytics</span>
            </div>
            <div class="flex cursor-not-allowed items-center gap-3 rounded-xl px-3 py-2.5 text-sm text-[#94A3B8] opacity-50" title="Coming soon">
                <svg class="h-5 w-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                </svg>
                <span class="hidden lg:inline">Suppliers</span>
            </div>
            <div class="flex cursor-not-allowed items-center gap-3 rounded-xl px-3 py-2.5 text-sm text-[#94A3B8] opacity-50" title="Coming soon">
                <svg class="h-5 w-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
                <span class="hidden lg:inline">Warehouses</span>
            </div>

            <div class="my-3 border-t border-[#232A36]"></div>
            <p class="hidden lg:block px-3 pb-1 text-xs font-medium uppercase tracking-wider text-[#94A3B8]">Stock</p>
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

    <!-- User Section -->
    <div class="shrink-0 border-t border-[#232A36] px-3 py-4">
        <div class="hidden lg:block mb-3 px-3">
            <p class="text-sm font-medium text-[#E6EDF3]">{{ Auth::user()->name }}</p>
            <p class="text-xs text-[#94A3B8]">{{ ucfirst(Auth::user()->role) }}</p>
        </div>
        <div class="flex justify-center lg:justify-start">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="flex w-full items-center justify-center lg:justify-start gap-3 rounded-xl px-3 py-2.5 text-sm text-[#94A3B8] transition-colors hover:bg-[#1C2333] hover:text-[#EF4444]" aria-label="Logout">
                    <svg class="h-5 w-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    <span class="hidden lg:inline">Logout</span>
                </button>
            </form>
        </div>
    </div>
</aside>
