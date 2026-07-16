<span {{ $attributes->merge(['class' => $classes()]) }} {!! $style() ? 'style="'.$style().'"' : '' !!}>
    {{ $name ?? $slot }}
</span>