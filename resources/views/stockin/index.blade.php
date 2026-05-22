<x-layouts.app title="Stock In">
    <div class="mx-auto max-w-2xl" x-data="stockInApp()">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-[#E6EDF3]">Stock In</h1>
            <p class="mt-1 text-sm text-[#94A3B8]">Add inventory to the system.</p>
        </div>

        <!-- Step 1: Form -->
        <x-card x-show="!showConfirmation" x-transition>
            <form @submit.prevent="submitPreview" class="space-y-6">
                <div>
                    <label class="mb-2 block text-sm font-medium text-[#E6EDF3]">Product</label>
                    <select x-model="product_id" name="product_id" required
                        class="w-full rounded-xl border border-[#232A36] bg-[#0F1117] px-4 py-2.5 text-sm text-[#E6EDF3] focus:border-[#3B82F6] focus:outline-none">
                        <option value="">Select product...</option>
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}">{{ $product->product_code }} — {{ $product->product_name }}</option>
                        @endforeach
                        <option value="new">+ New Product</option>
                    </select>
                </div>

                <div x-show="product_id === 'new'" x-transition>
                    <div class="space-y-4 rounded-xl border border-[#232A36] bg-[#0F1117] p-4">
                        <div>
                            <label class="mb-1 block text-sm font-medium text-[#E6EDF3]">Product Name</label>
                            <input type="text" x-model="product_name" required
                                class="w-full rounded-xl border border-[#232A36] bg-[#161B22] px-4 py-2.5 text-sm text-[#E6EDF3] focus:border-[#3B82F6] focus:outline-none">
                        </div>
                        <div>
                            <label class="mb-1 block text-sm font-medium text-[#E6EDF3]">Price (৳)</label>
                            <input type="number" step="0.01" x-model="price" required
                                class="w-full rounded-xl border border-[#232A36] bg-[#161B22] px-4 py-2.5 text-sm text-[#E6EDF3] focus:border-[#3B82F6] focus:outline-none">
                        </div>
                    </div>
                </div>

                <div>
                    <label class="mb-2 block text-sm font-medium text-[#E6EDF3]">Size</label>
                    <div class="flex gap-2">
                        @foreach (['S', 'M', 'L', 'XL', 'XXL'] as $s)
                            <label class="flex-1 cursor-pointer">
                                <input type="radio" x-model="size" name="size" value="{{ $s }}" class="peer sr-only">
                                <div class="rounded-xl border border-[#232A36] bg-[#0F1117] px-4 py-3 text-center text-sm text-[#94A3B8] transition-colors peer-checked:border-[#3B82F6] peer-checked:bg-[#3B82F6]/10 peer-checked:text-[#3B82F6]">
                                    {{ $s }}
                                </div>
                            </label>
                        @endforeach
                    </div>
                </div>

                <div>
                    <label class="mb-2 block text-sm font-medium text-[#E6EDF3]">Quantity to Add</label>
                    <input type="number" x-model="quantity" min="1" required
                        class="w-full rounded-xl border border-[#232A36] bg-[#0F1117] px-4 py-2.5 text-sm text-[#E6EDF3] focus:border-[#3B82F6] focus:outline-none">
                </div>

                <button type="submit" class="w-full rounded-xl bg-[#22C55E] px-4 py-2.5 text-sm font-medium text-white hover:bg-[#16A34A]"
                    x-bind:disabled="!product_id || !size || !quantity">
                    Preview Stock In
                </button>
            </form>
        </x-card>

        <!-- Step 2: Confirmation Card -->
        <div x-show="showConfirmation" x-transition>
            <x-card>
                <div class="text-center">
                    <div class="mx-auto mb-4 flex h-12 w-12 items-center justify-center rounded-full bg-[#22C55E]/10">
                        <svg class="h-6 w-6 text-[#22C55E]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-[#E6EDF3]">Confirm Stock In</h3>
                </div>

                <div class="mt-6 space-y-3 rounded-xl bg-[#0F1117] p-4">
                    <div class="flex justify-between text-sm">
                        <span class="text-[#94A3B8]">Product</span>
                        <span class="text-[#E6EDF3]" x-text="confirmation.product_name"></span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-[#94A3B8]">Size</span>
                        <span class="text-[#E6EDF3]" x-text="confirmation.size"></span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-[#94A3B8]">Current Stock</span>
                        <span class="text-[#E6EDF3]" x-text="confirmation.current_stock"></span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-[#94A3B8]">Adding</span>
                        <span class="text-[#22C55E]" x-text="'+' + confirmation.change"></span>
                    </div>
                    <div class="border-t border-[#232A36] pt-3 flex justify-between text-sm font-medium">
                        <span class="text-[#94A3B8]">New Stock</span>
                        <span class="text-[#E6EDF3]" x-text="confirmation.new_stock"></span>
                    </div>
                </div>

                <div class="mt-4 text-center">
                    <p class="text-sm text-[#94A3B8]">Auto-confirming in <span class="font-medium text-[#E6EDF3]" x-text="countdown"></span> seconds</p>
                    <div class="mt-2 h-1.5 w-full overflow-hidden rounded-full bg-[#232A36]">
                        <div class="h-full bg-[#22C55E] transition-all duration-1000 ease-linear" x-bind:style="'width: ' + (countdown / 5 * 100) + '%'"></div>
                    </div>
                </div>

                <div class="mt-6 flex gap-3">
                    <button @click="confirmStockIn()" class="flex-1 rounded-xl bg-[#22C55E] px-4 py-2.5 text-sm font-medium text-white hover:bg-[#16A34A]">
                        Confirm
                    </button>
                    <button @click="cancelAction()" class="flex-1 rounded-xl border border-[#232A36] px-4 py-2.5 text-sm font-medium text-[#94A3B8] hover:bg-[#1C2333]">
                        Discard
                    </button>
                </div>
            </x-card>
        </div>

        <!-- Success Message -->
        <div x-show="showSuccess" x-transition x-init="setTimeout(() => window.location.reload(), 2000)">
            <x-card>
                <div class="py-8 text-center">
                    <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-[#22C55E]/10">
                        <svg class="h-8 w-8 text-[#22C55E]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-[#E6EDF3]">Stock Added Successfully</h3>
                    <p class="mt-1 text-sm text-[#94A3B8]">Redirecting to stock management...</p>
                </div>
            </x-card>
        </div>

        <!-- Error -->
        <div x-show="error" x-transition class="mt-4">
            <div class="rounded-xl border border-[#EF4444]/30 bg-[#EF4444]/10 px-4 py-3 text-sm text-[#EF4444]" x-text="error"></div>
        </div>
    </div>

    <script>
        function stockInApp() {
            return {
                product_id: '',
                product_name: '',
                price: '',
                size: '',
                quantity: '',
                showConfirmation: false,
                showSuccess: false,
                error: '',
                countdown: 5,
                confirmation: {},
                timer: null,

                submitPreview() {
                    this.error = '';
                    fetch('{{ route('stock.in.preview') }}', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                        body: JSON.stringify({
                            product_id: this.product_id,
                            product_name: this.product_name,
                            price: this.price,
                            size: this.size,
                            quantity: this.quantity,
                        })
                    })
                    .then(r => r.json())
                    .then(data => {
                        if (data.success === false) {
                            this.error = data.message;
                            return;
                        }
                        this.confirmation = data;
                        this.showConfirmation = true;
                        this.countdown = 5;
                        this.timer = setInterval(() => {
                            this.countdown--;
                            if (this.countdown <= 0) this.cancelAction();
                        }, 1000);
                    })
                    .catch(e => this.error = 'An error occurred.');
                },

                confirmStockIn() {
                    clearInterval(this.timer);
                    fetch('{{ route('stock.in.confirm') }}', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                        body: JSON.stringify({
                            product_id: this.confirmation.product_id,
                            size: this.confirmation.size,
                            quantity: this.confirmation.quantity || Math.abs(this.confirmation.change),
                        })
                    })
                    .then(r => r.json())
                    .then(data => {
                        if (data.success) {
                            this.showConfirmation = false;
                            this.showSuccess = true;
                        } else {
                            this.error = data.message;
                            this.showConfirmation = false;
                        }
                    });
                },

                cancelAction() {
                    clearInterval(this.timer);
                    this.showConfirmation = false;
                    this.countdown = 5;
                }
            }
        }
    </script>
</x-layouts.app>
