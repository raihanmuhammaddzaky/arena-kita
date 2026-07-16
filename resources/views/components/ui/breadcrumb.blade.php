<nav class="flex text-on-surface-variant mb-stack-md font-label-md overflow-x-auto hide-scrollbar pb-2 md:pb-0" aria-label="Breadcrumb">
    <ol class="inline-flex items-center space-x-1 md:space-x-2 whitespace-nowrap">
        @foreach($links as $index => $link)
            @if($loop->first)
                <li class="inline-flex items-center">
                    <a href="{{ $link['url'] }}" class="inline-flex items-center hover:text-primary transition-colors py-1 px-2 -ml-2 rounded-lg hover:bg-surface-container-low">
                        <x-ui.icon name="home" class="text-[18px] mr-1.5" />
                        {{ $link['label'] }}
                    </a>
                </li>
            @elseif(!$loop->last)
                <li>
                    <div class="flex items-center">
                        <x-ui.icon name="chevron_right" class="text-[16px] mx-1 opacity-40" />
                        <a href="{{ $link['url'] }}" class="hover:text-primary transition-colors py-1 px-2 rounded-lg hover:bg-surface-container-low">{{ $link['label'] }}</a>
                    </div>
                </li>
            @else
                <li aria-current="page">
                    <div class="flex items-center">
                        <x-ui.icon name="chevron_right" class="text-[16px] mx-1 opacity-40" />
                        <span class="text-primary font-bold py-1 px-2 bg-primary/5 rounded-lg border border-primary/10">{{ $link['label'] }}</span>
                    </div>
                </li>
            @endif
        @endforeach
    </ol>
</nav>
