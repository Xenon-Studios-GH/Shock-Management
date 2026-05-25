<form id="activityFilterForm" method="GET" class="space-y-4">
    <div>
        <label class="mb-1 block text-xs font-medium text-[#94A3B8]">Type</label>
        <select name="type" class="w-full rounded-xl border border-[#232A36] bg-[#0F1117] px-3 py-2 text-sm text-[#E6EDF3] focus:border-[#3B82F6] focus:outline-none">
            <option value="">All Types</option>
            <option value="in">Stock In</option>
            <option value="out">Stock Out</option>
        </select>
    </div>
    <div>
        <label class="mb-1 block text-xs font-medium text-[#94A3B8]">Product</label>
        <select name="product_id" class="w-full rounded-xl border border-[#232A36] bg-[#0F1117] px-3 py-2 text-sm text-[#E6EDF3] focus:border-[#3B82F6] focus:outline-none">
            <option value="">All Products</option>
            @foreach ($products as $product)
            <option value="{{ $product->id }}">{{ $product->product_code }} — {{ $product->product_name }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="mb-1 block text-xs font-medium text-[#94A3B8]">From Date</label>
        <input type="date" name="date_from" class="w-full rounded-xl border border-[#232A36] bg-[#0F1117] px-3 py-2 text-sm text-[#E6EDF3] focus:border-[#3B82F6] focus:outline-none">
    </div>
    <div>
        <label class="mb-1 block text-xs font-medium text-[#94A3B8]">To Date</label>
        <input type="date" name="date_to" class="w-full rounded-xl border border-[#232A36] bg-[#0F1117] px-3 py-2 text-sm text-[#E6EDF3] focus:border-[#3B82F6] focus:outline-none">
    </div>
    <div class="flex gap-2">
        <button type="submit" class="flex-1 rounded-xl bg-[#3B82F6] px-4 py-2 text-sm font-medium text-white hover:bg-[#2563EB]">Apply</button>
        <button type="reset" id="resetActivityFilters" class="flex-1 rounded-xl border border-[#232A36] px-4 py-2 text-sm text-[#94A3B8] hover:bg-[#1C2333]">Reset</button>
    </div>
</form>