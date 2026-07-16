<span {{ $attributes->merge(['class' => $classes()]) }}>
    @if($icon)
        <x-ui.icon :name="$icon" class="text-[14px]" />
    @endif
    {{ $slot }}
</span>