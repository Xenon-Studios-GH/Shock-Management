<x-layouts.app title="Recent Activity">
    <div class="space-y-6" x-data="activityFilter()">
        <!-- Header -->
        <div class="flex flex-wrap items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-[#E6EDF3]">Recent Activity</h1>
                <p class="mt-1 text-sm text-[#94A3B8]">Stock in and out transaction history.</p>
            </div>
        </div>

        <!-- Summary Cards -->
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
            <x-card>
                <p class="text-xs text-[#94A3B8]">Stock In Entries</p>
                <p class="mt-1 text-2xl font-bold text-[#22C55E]">{{ number_format($stockInCount) }}</p>
            </x-card>
            <x-card>
                <p class="text-xs text-[#94A3B8]">Stock Out Entries</p>
                <p class="mt-1 text-2xl font-bold text-[#EF4444]">{{ number_format($stockOutCount) }}</p>
            </x-card>
            <x-card>
                <p class="text-xs text-[#94A3B8]">Today</p>
                <p class="mt-1 text-2xl font-bold text-[#E6EDF3]">{{ number_format($todayCount) }}</p>
            </x-card>
        </div>

        <!-- Filters + Actions Bar -->
        <div class="sticky top-16 z-20 -mx-4 -mt-2 bg-[#0F1117] px-4 pb-4 pt-4 md:-mx-8 md:px-8">
            <div class="flex items-center gap-3">
                <button @click="toggleFilter()" class="inline-flex h-11 items-center gap-1.5 rounded-xl border border-[#232A36] bg-[#161B22] px-4 py-2.5 text-sm text-[#94A3B8] hover:bg-[#1C2333] hover:text-[#E6EDF3]">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                    </svg>
                    <span class="hidden md:inline">Filters</span>
                </button>
                <div class="text-sm text-[#94A3B8]" x-text="resultCount"></div>
            </div>
        </div>

        <div class="flex gap-6">
            <!-- Table -->
            <div class="flex-1 min-w-0" id="activityTableContainer">
                @include('stock-activity._table')
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
                    @include('stock-activity._filter-form')
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
            @include('stock-activity._filter-form')
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
        function activityFilter() {
            return {
                filterOpen: false,
                resultCount: '{{ $transactions->total() }} records',
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
            document.getElementById('activityFilterForm').addEventListener('submit', function(e) {
                e.preventDefault();
                const params = new URLSearchParams(new FormData(this));
                fetch('{{ route('stock.activity') }}?' + params.toString())
                    .then(r => r.text())
                    .then(html => {
                        const parser = new DOMParser();
                        const doc = parser.parseFromString(html, 'text/html');
                        const container = doc.getElementById('activityTableContainer');
                        if (container) {
                            document.getElementById('activityTableContainer').innerHTML = container.innerHTML;
                        }
                    });
            });

            document.getElementById('resetActivityFilters').addEventListener('click', function() {
                document.getElementById('activityFilterForm').reset();
                fetch('{{ route('stock.activity') }}')
                    .then(r => r.text())
                    .then(html => {
                        const parser = new DOMParser();
                        const doc = parser.parseFromString(html, 'text/html');
                        const container = doc.getElementById('activityTableContainer');
                        if (container) {
                            document.getElementById('activityTableContainer').innerHTML = container.innerHTML;
                        }
                    });
            });
        });
    </script>
</x-layouts.app>