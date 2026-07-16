@props(['title', 'description' => null])

<header class="mb-stack-lg">
    <h1 class="font-headline-lg-mobile md:font-headline-lg text-headline-lg-mobile md:text-headline-lg text-primary mb-2">{{ $title }}</h1>
    @if($description)
    <p class="font-body-lg text-body-lg text-on-surface-variant max-w-2xl">{{ $description }}</p>
    @endif
</header>
