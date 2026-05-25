<form id="filterForm" method="GET" class="space-y-4">
    <div>
        <label class="mb-1 block text-xs font-medium text-[#94A3B8]">Size</label>
        <select name="size" class="w-full rounded-xl border border-[#232A36] bg-[#0F1117] px-3 py-2 text-sm text-[#E6EDF3] focus:border-[#3B82F6] focus:outline-none">
            <option value="">All Sizes</option>
            @foreach (['S', 'M', 'L', 'XL', 'XXL'] as $size)
                <option value="{{ $size }}">{{ $size }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="mb-1 block text-xs font-medium text-[#94A3B8]">Stock Min</label>
        <input type="number" name="stock_min" min="0" class="w-full rounded-xl border border-[#232A36] bg-[#0F1117] px-3 py-2 text-sm text-[#E6EDF3] focus:border-[#3B82F6] focus:outline-none">
    </div>
    <div>
        <label class="mb-1 block text-xs font-medium text-[#94A3B8]">Stock Max</label>
        <input type="number" name="stock_max" min="0" class="w-full rounded-xl border border-[#232A36] bg-[#0F1117] px-3 py-2 text-sm text-[#E6EDF3] focus:border-[#3B82F6] focus:outline-none">
    </div>
    <div>
        <label class="mb-1 block text-xs font-medium text-[#94A3B8]">Sort</label>
        <select name="sort" class="w-full rounded-xl border border-[#232A36] bg-[#0F1117] px-3 py-2 text-sm text-[#E6EDF3] focus:border-[#3B82F6] focus:outline-none">
            <option value="newest">Newest</option>
            <option value="oldest">Oldest</option>
            <option value="stock_high">Stock: High to Low</option>
            <option value="stock_low">Stock: Low to High</option>
        </select>
    </div>
    <div class="flex gap-2">
        <button type="submit" class="flex-1 rounded-xl bg-[#3B82F6] px-4 py-2 text-sm font-medium text-white hover:bg-[#2563EB]">Apply</button>
        <button type="reset" id="resetFilters" class="flex-1 rounded-xl border border-[#232A36] px-4 py-2 text-sm text-[#94A3B8] hover:bg-[#1C2333]">Reset</button>
    </div>
</form>
