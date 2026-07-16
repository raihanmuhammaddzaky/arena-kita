@props(['title', 'subtitle' => null])

<div class="mb-stack-lg">
    <h2 class="text-headline-lg font-headline-lg text-on-surface mb-2 tracking-tight">{{ $title }}</h2>
    @if($subtitle)
    <p class="text-body-md font-body-md text-on-surface-variant">{{ $subtitle }}</p>
    @endif
</div>
