<x-layouts.app title="Dashboard">
    <div class="space-y-8">
        <div>
            <h1 class="text-2xl font-bold text-[#E6EDF3]">Dashboard</h1>
            <p class="mt-1 text-sm text-[#94A3B8]">Welcome back, {{ Auth::user()->name }}</p>
        </div>

        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
            <x-card>
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-[#94A3B8]">Total Stock</p>
                        <p class="mt-1 text-2xl font-bold text-[#E6EDF3]">—</p>
                    </div>
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#3B82F6]/10">
                        <svg class="h-5 w-5 text-[#3B82F6]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                    </div>
                </div>
            </x-card>

            <x-card>
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-[#94A3B8]">Stock In Today</p>
                        <p class="mt-1 text-2xl font-bold text-[#E6EDF3]">—</p>
                    </div>
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#22C55E]/10">
                        <svg class="h-5 w-5 text-[#22C55E]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                        </svg>
                    </div>
                </div>
            </x-card>

            <x-card>
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-[#94A3B8]">Stock Out Today</p>
                        <p class="mt-1 text-2xl font-bold text-[#E6EDF3]">—</p>
                    </div>
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#EF4444]/10">
                        <svg class="h-5 w-5 text-[#EF4444]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4m12 0l-4-4m4 4l-4 4"/>
                        </svg>
                    </div>
                </div>
            </x-card>

            <x-card>
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-[#94A3B8]">Transactions</p>
                        <p class="mt-1 text-2xl font-bold text-[#E6EDF3]">—</p>
                    </div>
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#94A3B8]/10">
                        <svg class="h-5 w-5 text-[#94A3B8]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </div>
                </div>
            </x-card>
        </div>

        <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
            <x-card>
                <h3 class="text-lg font-semibold text-[#E6EDF3]">Recent Activity</h3>
                <p class="mt-4 text-sm text-[#94A3B8]">No recent activity to display.</p>
            </x-card>

            <x-card>
                <h3 class="text-lg font-semibold text-[#E6EDF3]">Quick Overview</h3>
                <p class="mt-4 text-sm text-[#94A3B8]">Stock overview will be available in the next phase.</p>
            </x-card>
        </div>
    </div>
</x-layouts.app>
