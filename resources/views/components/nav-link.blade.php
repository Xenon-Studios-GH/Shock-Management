@props(['active' => false, 'href' => '#', 'icon' => 'link'])

@php
$classes = $active
    ? 'flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium text-[#E6EDF3] bg-[#1C2333] transition-colors'
    : 'flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium text-[#94A3B8] hover:bg-[#1C2333] hover:text-[#E6EDF3] transition-colors';
@endphp

<a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
    @if ($icon === 'dashboard')
        <svg class="h-5 w-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
        </svg>
    @elseif ($icon === 'stock')
        <svg class="h-5 w-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
        </svg>
    @elseif ($icon === 'stockin')
        <svg class="h-5 w-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
        </svg>
    @elseif ($icon === 'stockout')
        <svg class="h-5 w-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4m12 0l-4-4m4 4l-4 4"/>
        </svg>
    @endif
    {{ $slot }}
</a>
