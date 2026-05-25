<x-layouts.app title="Stock Management">
    <div class="space-y-6" x-data="stockFilter()">
        <!-- Summary Cards -->
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-3">
            <x-card>
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-[#94A3B8]">Stock In (30 days)</p>
                        <p class="mt-1 text-2xl font-bold text-[#22C55E]">+{{ number_format($stockIn30d) }}</p>
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
                        <p class="text-sm text-[#94A3B8]">Stock Out (30 days)</p>
                        <p class="mt-1 text-2xl font-bold text-[#EF4444]">-{{ number_format($stockOut30d) }}</p>
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
                        <p class="text-sm text-[#94A3B8]">Total Inventory</p>
                        <p class="mt-1 text-2xl font-bold text-[#E6EDF3]">{{ number_format($totalInventory) }}</p>
                    </div>
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#3B82F6]/10">
                        <svg class="h-5 w-5 text-[#3B82F6]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                    </div>
                </div>
            </x-card>
        </div>

        <!-- Search + Actions Bar (sticky below top bar) -->
        <div class="sticky top-16 z-20 -mx-4 -mt-2 bg-[#0F1117] px-4 pb-4 pt-4 md:-mx-8 md:px-8">
            <div class="flex items-center gap-3">
                <div class="relative flex-1">
                    <svg class="pointer-events-none absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-[#94A3B8]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <input type="text" id="stockSearch" placeholder="Search product or code..." autocomplete="off"
                        class="w-full rounded-xl border border-[#232A36] bg-[#161B22] pl-10 pr-4 py-2.5 text-sm text-[#E6EDF3] placeholder-[#94A3B8] transition-colors focus:border-[#3B82F6] focus:outline-none focus:ring-1 focus:ring-[#3B82F6]">
                </div>
                <button @click="toggleFilter()" class="flex h-11 w-11 items-center justify-center rounded-xl border border-[#232A36] bg-[#161B22] text-[#94A3B8] hover:bg-[#1C2333] hover:text-[#E6EDF3]" aria-label="Toggle filters">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                    </svg>
                </button>
                <a href="{{ route('stock.in') }}" class="inline-flex h-11 items-center gap-1.5 rounded-xl bg-[#22C55E] px-4 py-2.5 text-sm font-medium text-white hover:bg-[#16A34A]">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                    <span class="hidden md:inline">Stock In</span>
                </a>
                <a href="{{ route('stock.out') }}" class="inline-flex h-11 items-center gap-1.5 rounded-xl bg-[#EF4444] px-4 py-2.5 text-sm font-medium text-white hover:bg-[#DC2626]">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4m12 0l-4-4m4 4l-4 4"/></svg>
                    <span class="hidden md:inline">Stock Out</span>
                </a>
            </div>
        </div>

        <div class="flex gap-6">
            <!-- Inventory Table -->
            <div class="flex-1 min-w-0" id="stockTableContainer">
                @include('stock-management._table')
            </div>

            <!-- Desktop Filter Sidebar -->
            <div x-show="filterOpen" x-cloak class="hidden md:block w-80 shrink-0">
                <x-card>
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-sm font-semibold text-[#E6EDF3]">Filters</h3>
                        <button @click="toggleFilter()" class="text-[#94A3B8] hover:text-[#E6EDF3]" aria-label="Close filters">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                    @include('stock-management._filter-form')
                </x-card>
            </div>
        </div>

        <!-- Mobile Filter Bottom Sheet -->
        <div x-show="filterOpen" x-cloak
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="translate-y-full"
             x-transition:enter-end="translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="translate-y-0"
             x-transition:leave-end="translate-y-full"
             class="fixed inset-x-0 bottom-0 z-50 max-h-[85vh] overflow-y-auto rounded-t-2xl border border-[#232A36] bg-[#161B22] p-6 shadow-xl md:hidden">
            <div class="mx-auto mb-4 h-1.5 w-10 rounded-full bg-[#232A36]"></div>
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-sm font-semibold text-[#E6EDF3]">Filters</h3>
                <button @click="toggleFilter()" class="text-[#94A3B8] hover:text-[#E6EDF3]" aria-label="Close filters">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            @include('stock-management._filter-form')
        </div>

        <!-- Mobile Filter Backdrop -->
        <div x-show="filterOpen" x-cloak
             x-transition:enter="transition-opacity duration-300"
             x-transition:leave="transition-opacity duration-200"
             class="fixed inset-0 z-40 bg-black/50 md:hidden"
             @click="toggleFilter()"
             aria-hidden="true"></div>
    </div>

    <script>
        function stockFilter() {
            return {
                filterOpen: false,
                toggleFilter() {
                    this.filterOpen = !this.filterOpen;
                    if (this.filterOpen) {
                        document.body.style.overflow = 'hidden';
                    } else {
                        document.body.style.overflow = '';
                    }
                }
            }
        }

        document.addEventListener('alpine:init', () => {
            let searchTimer;
            document.getElementById('stockSearch').addEventListener('input', function() {
                clearTimeout(searchTimer);
                searchTimer = setTimeout(() => {
                    fetch(`{{ route('stock.search') }}?q=${encodeURIComponent(this.value)}`)
                        .then(r => r.json())
                        .then(data => document.getElementById('stockTableContainer').innerHTML = data.html);
                }, 300);
            });

            document.getElementById('filterForm').addEventListener('submit', function(e) {
                e.preventDefault();
                const params = new URLSearchParams(new FormData(this));
                fetch(`{{ route('stock.filter') }}?${params}`)
                    .then(r => r.json())
                    .then(data => document.getElementById('stockTableContainer').innerHTML = data.html);
            });

            document.getElementById('resetFilters').addEventListener('click', () => {
                document.getElementById('filterForm').reset();
                fetch(`{{ route('stock.filter') }}`)
                    .then(r => r.json())
                    .then(data => document.getElementById('stockTableContainer').innerHTML = data.html);
            });
        });
    </script>
</x-layouts.app>
