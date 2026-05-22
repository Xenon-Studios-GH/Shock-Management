<x-card padding="p-0">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-[#232A36]">
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-[#94A3B8]">Product ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-[#94A3B8]">Product</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-[#94A3B8]">Size</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-[#94A3B8]">Stock</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-[#94A3B8]">Price</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-[#94A3B8]">Updated</th>
                    <th class="px-6 py-3 text-right text-xs font-medium uppercase tracking-wider text-[#94A3B8]">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-[#232A36]">
                @forelse ($products as $product)
                    @php $first = true; @endphp
                    @forelse ($product->stocks as $stock)
                        <tr class="transition-colors hover:bg-[#1C2333]">
                            @if ($first)
                                <td class="whitespace-nowrap px-6 py-4 font-mono text-xs text-[#94A3B8]" rowspan="{{ max($product->stocks->count(), 1) }}">{{ $product->product_code }}</td>
                                <td class="whitespace-nowrap px-6 py-4 text-[#E6EDF3]" rowspan="{{ max($product->stocks->count(), 1) }}">{{ $product->product_name }}</td>
                                <td class="whitespace-nowrap px-6 py-4">
                                    <span class="rounded-lg bg-[#232A36] px-2 py-0.5 text-xs font-medium text-[#E6EDF3]">{{ $stock->size }}</span>
                                </td>
                                <td class="whitespace-nowrap px-6 py-4 font-medium {{ $stock->quantity > 10 ? 'text-[#22C55E]' : ($stock->quantity > 0 ? 'text-[#F59E0B]' : 'text-[#EF4444]') }}">
                                    {{ $stock->quantity }}
                                </td>
                                <td class="whitespace-nowrap px-6 py-4 text-[#94A3B8]" rowspan="{{ max($product->stocks->count(), 1) }}">৳{{ number_format($product->price, 2) }}</td>
                                <td class="whitespace-nowrap px-6 py-4 text-[#94A3B8]" rowspan="{{ max($product->stocks->count(), 1) }}">{{ $stock->updated_at->diffForHumans() }}</td>
                                <td class="whitespace-nowrap px-6 py-4 text-right" rowspan="{{ max($product->stocks->count(), 1) }}">
                                    <button onclick="showEditModal({{ $product->id }}, '{{ $product->product_name }}', {{ $product->price }})" class="rounded-lg px-3 py-1.5 text-xs font-medium text-[#3B82F6] hover:bg-[#3B82F6]/10">
                                        Edit
                                    </button>
                                </td>
                                @php $first = false; @endphp
                            @else
                                <td class="whitespace-nowrap px-6 py-4 font-mono text-xs text-[#94A3B8]"></td>
                                <td class="whitespace-nowrap px-6 py-4 text-[#E6EDF3]"></td>
                                <td class="whitespace-nowrap px-6 py-4">
                                    <span class="rounded-lg bg-[#232A36] px-2 py-0.5 text-xs font-medium text-[#E6EDF3]">{{ $stock->size }}</span>
                                </td>
                                <td class="whitespace-nowrap px-6 py-4 font-medium {{ $stock->quantity > 10 ? 'text-[#22C55E]' : ($stock->quantity > 0 ? 'text-[#F59E0B]' : 'text-[#EF4444]') }}">
                                    {{ $stock->quantity }}
                                </td>
                                <td class="whitespace-nowrap px-6 py-4 text-[#94A3B8]"></td>
                                <td class="whitespace-nowrap px-6 py-4 text-[#94A3B8]"></td>
                                <td class="whitespace-nowrap px-6 py-4 text-right"></td>
                            @endif
                        </tr>
                    @empty
                        <tr class="transition-colors hover:bg-[#1C2333]">
                            <td class="whitespace-nowrap px-6 py-4 font-mono text-xs text-[#94A3B8]">{{ $product->product_code }}</td>
                            <td class="whitespace-nowrap px-6 py-4 text-[#E6EDF3]">{{ $product->product_name }}</td>
                            <td class="whitespace-nowrap px-6 py-4">—</td>
                            <td class="whitespace-nowrap px-6 py-4 text-[#94A3B8]">0</td>
                            <td class="whitespace-nowrap px-6 py-4 text-[#94A3B8]">৳{{ number_format($product->price, 2) }}</td>
                            <td class="whitespace-nowrap px-6 py-4 text-[#94A3B8]">—</td>
                            <td class="whitespace-nowrap px-6 py-4 text-right">
                                <button onclick="showEditModal({{ $product->id }}, '{{ $product->product_name }}', {{ $product->price }})" class="rounded-lg px-3 py-1.5 text-xs font-medium text-[#3B82F6] hover:bg-[#3B82F6]/10">
                                    Edit
                                </button>
                            </td>
                        </tr>
                    @endforelse
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center text-sm text-[#94A3B8]">No products found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if ($products->hasPages())
        <div class="border-t border-[#232A36] px-6 py-3">
            {{ $products->links() }}
        </div>
    @endif
</x-card>

<!-- Edit Modal -->
<div id="editModal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black/50">
    <x-card class="w-full max-w-md">
        <h3 class="text-lg font-semibold text-[#E6EDF3]">Edit Product</h3>
        <form id="editForm" method="POST" class="mt-4 space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label class="mb-1 block text-sm font-medium text-[#E6EDF3]">Product Name</label>
                <input type="text" name="product_name" id="editName" required
                    class="w-full rounded-xl border border-[#232A36] bg-[#0F1117] px-4 py-2.5 text-sm text-[#E6EDF3] focus:border-[#3B82F6] focus:outline-none focus:ring-1 focus:ring-[#3B82F6]">
            </div>
            <div>
                <label class="mb-1 block text-sm font-medium text-[#E6EDF3]">Price</label>
                <input type="number" step="0.01" name="price" id="editPrice" required
                    class="w-full rounded-xl border border-[#232A36] bg-[#0F1117] px-4 py-2.5 text-sm text-[#E6EDF3] focus:border-[#3B82F6] focus:outline-none focus:ring-1 focus:ring-[#3B82F6]">
            </div>
            <div class="flex items-center gap-3">
                <button type="submit" class="rounded-xl bg-[#3B82F6] px-4 py-2.5 text-sm font-medium text-white hover:bg-[#2563EB]">Save</button>
                <button type="button" onclick="closeEditModal()" class="text-sm text-[#94A3B8] hover:text-[#E6EDF3]">Cancel</button>
            </div>
        </form>
    </x-card>
</div>

<script>
    function showEditModal(id, name, price) {
        document.getElementById('editForm').action = `{{ url('stock/products') }}/${id}`;
        document.getElementById('editName').value = name;
        document.getElementById('editPrice').value = price;
        document.getElementById('editModal').classList.remove('hidden');
    }
    function closeEditModal() {
        document.getElementById('editModal').classList.add('hidden');
    }
</script>
