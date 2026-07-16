@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes()]) }}>
        @if($icon && $iconPosition === 'left')
            <x-ui.icon :name="$icon" class="text-[18px]" />
        @endif
        
        {{ $slot }}
        
        @if($icon && $iconPosition === 'right')
            <x-ui.icon :name="$icon" class="text-[18px]" />
        @endif
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $classes()]) }}>
        @if($icon && $iconPosition === 'left')
            <x-ui.icon :name="$icon" class="text-[18px]" />
        @endif
        
        {{ $slot }}
        
        @if($icon && $iconPosition === 'right')
            <x-ui.icon :name="$icon" class="text-[18px]" />
        @endif
    </button>
@endif