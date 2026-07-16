@props(['title', 'action' => null])

<div class="bg-surface-container-lowest rounded-2xl shadow-sm border border-outline-variant/20 overflow-hidden">
    <!-- Section Header -->
    <div class="bg-primary text-on-primary px-6 py-5 flex justify-between items-center">
        <h3 class="text-headline-md font-headline-md">{{ $title }}</h3>
        @if($action)
            {{ $action }}
        @endif
    </div>
    
    <!-- Table Canvas -->
    <div class="w-full overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b border-outline-variant/20 bg-surface-container-lowest text-label-md font-label-md text-on-surface-variant">
                    {{ $head }}
                </tr>
            </thead>
            <tbody class="text-body-md font-body-md bg-surface-container-lowest">
                {{ $slot }}
            </tbody>
        </table>
    </div>
</div>
