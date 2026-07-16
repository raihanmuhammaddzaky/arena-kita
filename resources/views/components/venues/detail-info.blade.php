@props(['venue'])

<div class="lg:col-span-2 flex flex-col gap-stack-md">
    <div>
        <div class="flex flex-wrap items-center gap-3 mb-3">
            <x-ui.badge variant="secondary">Tersedia</x-ui.badge>
            <x-ui.badge variant="default" icon="sports_soccer">Futsal</x-ui.badge>
        </div>
        <h1 class="font-display text-display text-primary mb-2">{{ $venue->name }}</h1>
        <p class="font-body-lg text-on-surface-variant flex items-center gap-2">
            <x-ui.icon name="location_on" class="text-[20px]" />
            {{ $venue->address }}
        </p>
    </div>

    <div class="border-t border-outline-variant/20 pt-stack-md">
        <h3 class="font-headline-md text-primary mb-4">Fasilitas Lapangan</h3>
        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
            <div class="flex items-center gap-2 text-on-surface">
                <x-ui.icon name="ac_unit" class="text-on-tertiary-fixed-variant" />
                <span class="font-body-md">AC / Ventilasi</span>
            </div>
            <div class="flex items-center gap-2 text-on-surface">
                <x-ui.icon name="lightbulb" class="text-on-tertiary-fixed-variant" />
                <span class="font-body-md">Premium Lighting</span>
            </div>
            <div class="flex items-center gap-2 text-on-surface">
                <x-ui.icon name="wc" class="text-on-tertiary-fixed-variant" />
                <span class="font-body-md">Toilet Bersih</span>
            </div>
            <div class="flex items-center gap-2 text-on-surface">
                <x-ui.icon name="local_parking" class="text-on-tertiary-fixed-variant" />
                <span class="font-body-md">Parkir Luas</span>
            </div>
            <div class="flex items-center gap-2 text-on-surface">
                <x-ui.icon name="mosque" class="text-on-tertiary-fixed-variant" />
                <span class="font-body-md">Mushola</span>
            </div>
        </div>
    </div>

    <div class="border-t border-outline-variant/20 pt-stack-md">
        <h3 class="font-headline-md text-primary mb-4">Deskripsi Lapangan</h3>
        <x-ui.card padding="p-6" class="font-body-md text-on-surface-variant leading-relaxed">
            {{ $venue->description ?? 'Tidak ada deskripsi.' }}
        </x-ui.card>
    </div>

    <div class="border-t border-outline-variant/20 pt-stack-md">
        <h3 class="font-headline-md text-primary mb-4">Lokasi</h3>
        <x-ui.card padding="p-6" class="flex items-start gap-4">
            <div class="w-12 h-12 rounded-full bg-secondary-container/50 text-on-secondary-container flex items-center justify-center shrink-0">
                <x-ui.icon name="location_on" class="text-[24px]" />
            </div>
            <div>
                <h4 class="font-label-md text-primary mb-1">Alamat Lengkap</h4>
                <p class="font-body-md text-on-surface-variant leading-relaxed">
                    {{ $venue->address ?? 'Alamat belum tersedia.' }}
                </p>
            </div>
        </x-ui.card>
    </div>
</div>
