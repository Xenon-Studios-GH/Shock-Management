<x-layouts.app title="Add Worker">
    <div class="mx-auto max-w-2xl">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-[#E6EDF3]">Add Worker</h1>
            <p class="mt-1 text-sm text-[#94A3B8]">Create a new staff account.</p>
        </div>

        <x-card>
            <form method="POST" action="{{ route('workers.store') }}" class="space-y-6">
                @csrf

                <div>
                    <label for="name" class="mb-2 block text-sm font-medium text-[#E6EDF3]">Full Name</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required
                        class="block w-full rounded-xl border border-[#232A36] bg-[#0F1117] px-4 py-2.5 text-sm text-[#E6EDF3] placeholder-[#94A3B8] transition-colors focus:border-[#3B82F6] focus:outline-none focus:ring-1 focus:ring-[#3B82F6]">
                    @error('name') <p class="mt-1 text-sm text-[#EF4444]">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="email" class="mb-2 block text-sm font-medium text-[#E6EDF3]">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required
                        class="block w-full rounded-xl border border-[#232A36] bg-[#0F1117] px-4 py-2.5 text-sm text-[#E6EDF3] placeholder-[#94A3B8] transition-colors focus:border-[#3B82F6] focus:outline-none focus:ring-1 focus:ring-[#3B82F6]">
                    @error('email') <p class="mt-1 text-sm text-[#EF4444]">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="phone" class="mb-2 block text-sm font-medium text-[#E6EDF3]">Phone (optional)</label>
                    <input id="phone" type="text" name="phone" value="{{ old('phone') }}"
                        class="block w-full rounded-xl border border-[#232A36] bg-[#0F1117] px-4 py-2.5 text-sm text-[#E6EDF3] placeholder-[#94A3B8] transition-colors focus:border-[#3B82F6] focus:outline-none focus:ring-1 focus:ring-[#3B82F6]">
                    @error('phone') <p class="mt-1 text-sm text-[#EF4444]">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="password" class="mb-2 block text-sm font-medium text-[#E6EDF3]">Password</label>
                    <div class="flex gap-2">
                        <input id="password" type="text" name="password" value="{{ old('password', 'Drib@' . rand(1000, 9999)) }}" required
                            class="block w-full rounded-xl border border-[#232A36] bg-[#0F1117] px-4 py-2.5 text-sm text-[#E6EDF3] placeholder-[#94A3B8] transition-colors focus:border-[#3B82F6] focus:outline-none focus:ring-1 focus:ring-[#3B82F6]">
                        <button type="button" onclick="document.getElementById('password').value = 'Drib@' + Math.floor(1000 + Math.random() * 9000)" class="rounded-xl border border-[#232A36] bg-[#0F1117] px-3 text-sm text-[#94A3B8] hover:bg-[#1C2333] hover:text-[#E6EDF3]">
                            Generate
                        </button>
                    </div>
                    @error('password') <p class="mt-1 text-sm text-[#EF4444]">{{ $message }}</p> @enderror
                </div>

                <div class="flex items-center gap-3">
                    <button type="submit" class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#3B82F6] px-4 py-2.5 text-sm font-medium text-white transition-colors hover:bg-[#2563EB] focus:outline-none focus:ring-2 focus:ring-[#3B82F6] focus:ring-offset-2 focus:ring-offset-[#0F1117]">
                        Create Worker
                    </button>
                    <a href="{{ route('workers.index') }}" class="text-sm text-[#94A3B8] hover:text-[#E6EDF3]">Cancel</a>
                </div>
            </form>
        </x-card>
    </div>
</x-layouts.app>
