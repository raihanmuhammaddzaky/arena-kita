<div class="{{ $config['bg'] }} border rounded-2xl p-6 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
    <div class="flex items-center gap-3">
        <div class="w-10 h-10 rounded-full {{ $config['icon_bg'] }} flex items-center justify-center shrink-0 shadow-sm">
            <x-ui.icon :name="$config['icon']" filled="true" />
        </div>
        <div>
            <h3 class="font-headline-md {{ $config['title_color'] }} text-[18px]">{{ $config['title'] }}</h3>
            <p class="font-body-md text-on-surface-variant text-sm">{{ $config['description'] }}</p>
        </div>
    </div>
    
    @if($config['show_deadline'])
        <div class="bg-surface-container-lowest border border-[#f59e0b]/30 px-4 py-2 rounded-lg text-center sm:text-right min-w-[140px]">
            <p class="font-label-md text-on-surface-variant text-[11px] uppercase tracking-wider mb-1">Batas Waktu</p>
            <p class="font-headline-md text-[#b45309] text-[16px] font-mono">{{ $booking->deadline }}</p>
        </div>
    @endif
</div>