<x-layouts.app title="Workers">
    <div class="space-y-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-[#E6EDF3]">Workers</h1>
                <p class="mt-1 text-sm text-[#94A3B8]">Manage staff accounts.</p>
            </div>
            <a href="{{ route('workers.create') }}" class="inline-flex items-center gap-2 rounded-xl bg-[#3B82F6] px-4 py-2.5 text-sm font-medium text-white transition-colors hover:bg-[#2563EB]">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
                Add Worker
            </a>
        </div>

        @if (session('success'))
            <div class="rounded-xl border border-[#22C55E]/30 bg-[#22C55E]/10 px-4 py-3 text-sm text-[#22C55E]">
                {{ session('success') }}
            </div>
        @endif

        @if (session('created_password'))
            <div class="rounded-xl border border-[#3B82F6]/30 bg-[#3B82F6]/10 p-4">
                <div class="flex items-start justify-between">
                    <div>
                        <h3 class="text-sm font-medium text-[#3B82F6]">Worker Created Successfully</h3>
                        <p class="mt-1 text-sm text-[#94A3B8]">Password: <code class="rounded bg-[#0F1117] px-2 py-0.5 font-mono text-[#E6EDF3]">{{ session('created_password') }}</code></p>
                        <p class="mt-1 text-xs text-[#94A3B8]">Share these credentials with the worker securely.</p>
                    </div>
                    <button onclick="navigator.clipboard.writeText('{{ session('created_password') }}')" class="rounded-lg bg-[#3B82F6]/20 px-3 py-1.5 text-xs font-medium text-[#3B82F6] hover:bg-[#3B82F6]/30">
                        Copy
                    </button>
                </div>
            </div>
        @endif

        <x-card padding="p-0">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-[#232A36]">
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-[#94A3B8]">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-[#94A3B8]">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-[#94A3B8]">Phone</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-[#94A3B8]">Status</th>
                            <th class="px-6 py-3 text-right text-xs font-medium uppercase tracking-wider text-[#94A3B8]">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#232A36]">
                        @forelse ($workers as $worker)
                            <tr class="transition-colors hover:bg-[#1C2333]">
                                <td class="whitespace-nowrap px-6 py-4 text-[#E6EDF3]">{{ $worker->name }}</td>
                                <td class="whitespace-nowrap px-6 py-4 text-[#94A3B8]">{{ $worker->email }}</td>
                                <td class="whitespace-nowrap px-6 py-4 text-[#94A3B8]">{{ $worker->phone ?? '—' }}</td>
                                <td class="whitespace-nowrap px-6 py-4">
                                    <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium {{ $worker->status ? 'bg-[#22C55E]/10 text-[#22C55E]' : 'bg-[#EF4444]/10 text-[#EF4444]' }}">
                                        {{ $worker->status ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td class="whitespace-nowrap px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('workers.edit', $worker) }}" class="rounded-lg px-3 py-1.5 text-xs font-medium text-[#3B82F6] hover:bg-[#3B82F6]/10">
                                            Edit
                                        </a>
                                        <form method="POST" action="{{ route('workers.toggle-status', $worker) }}" class="inline">
                                            @csrf
                                            <button type="submit" class="rounded-lg px-3 py-1.5 text-xs font-medium text-[#F59E0B] hover:bg-[#F59E0B]/10">
                                                {{ $worker->status ? 'Deactivate' : 'Activate' }}
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-sm text-[#94A3B8]">
                                    No workers found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if ($workers->hasPages())
                <div class="border-t border-[#232A36] px-6 py-3">
                    {{ $workers->links() }}
                </div>
            @endif
        </x-card>
    </div>
</x-layouts.app>
