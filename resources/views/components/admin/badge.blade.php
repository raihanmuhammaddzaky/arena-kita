@props(['color' => 'primary', 'icon' => null, 'text'])

@php
    $classes = "px-3 py-1 rounded-full text-label-md font-label-md text-xs inline-flex items-center gap-1 justify-center ";
    
    switch ($color) {
        case 'success':
        case 'secondary':
            $classes .= "bg-secondary-container text-on-secondary-container";
            break;
        case 'error':
        case 'danger':
            $classes .= "bg-error-container text-error";
            break;
        case 'warning':
            $classes .= "bg-surface-variant text-on-surface-variant";
            break;
        case 'primary':
        default:
            $classes .= "bg-primary-container text-on-primary-container";
            break;
    }
@endphp

<span class="{{ $classes }}">
    @if($icon)
        <span class="material-symbols-outlined text-[16px]">{{ $icon }}</span>
    @endif
    {{ $text }}
</span>
