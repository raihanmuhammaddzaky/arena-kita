@props(['title', 'value', 'icon', 'color' => 'primary', 'trend' => null, 'trendText' => null, 'subtext' => null, 'badge' => null])

@php
    $iconBgColor = 'bg-surface-container-low';
    $iconTextColor = 'text-primary';
    
    if ($color === 'secondary') {
        $iconTextColor = 'text-secondary';
    } elseif ($color === 'error') {
        $iconBgColor = 'bg-error-container';
        $iconTextColor = 'text-error';
    }
@endphp

<div class="bg-surface-container-lowest rounded-2xl p-6 shadow-sm border border-outline-variant/20 relative overflow-hidden group hover:shadow-md transition-shadow duration-300 flex flex-col justify-between h-40">
    <div class="flex justify-between items-start">
        <div>
            <p class="text-label-md font-label-md text-on-surface-variant mb-1">{{ $title }}</p>
            <h3 class="text-display font-display text-on-surface">{{ $value }}</h3>
        </div>
        <div class="w-12 h-12 rounded-full {{ $iconBgColor }} flex items-center justify-center {{ $iconTextColor }}">
            <span class="material-symbols-outlined text-[28px]" style="font-variation-settings: 'FILL' 1;">{{ $icon }}</span>
        </div>
    </div>
    
    <div class="flex items-center mt-4">
        @if($trend)
            <div class="flex items-center gap-2 text-label-md font-label-md {{ $trend === 'up' ? 'text-secondary' : 'text-error' }}">
                <span class="material-symbols-outlined text-[16px]">{{ $trend === 'up' ? 'trending_up' : 'trending_down' }}</span>
                <span>{{ $trendText }}</span>
            </div>
        @elseif($badge)
            <span class="bg-error-container text-error px-3 py-1 rounded-full text-label-md font-label-md text-xs">{{ $badge }}</span>
        @elseif($subtext)
            <span class="text-label-md font-label-md text-on-surface-variant">{{ $subtext }}</span>
        @endif
    </div>
</div>
