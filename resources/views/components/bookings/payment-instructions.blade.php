@props(['booking'])

<x-ui.card padding="">
    <div class="p-5 border-b border-outline-variant/20 flex items-center gap-2">
        <x-ui.icon name="account_balance" class="text-on-surface-variant" />
        <h3 class="font-headline-md text-primary text-[18px]">Metode Pembayaran (Transfer Bank)</h3>
    </div>
    <div class="p-6 flex flex-col sm:flex-row items-center justify-between gap-6">
        <div class="flex items-center gap-4">
            <div class="w-16 h-10 bg-[#005bea] rounded-md flex items-center justify-center text-white font-bold italic tracking-widest text-[20px] shadow-sm">BCA</div>
            <div>
                <p class="font-label-md text-on-surface-variant text-[12px] mb-1">Nomor Rekening</p>
                <p class="font-headline-md text-primary text-[20px] tracking-widest font-mono">123 456 7890</p>
                <p class="font-body-md text-on-surface text-[14px]">a.n PT ArenaKita Olahraga</p>
            </div>
        </div>
        <x-ui.button variant="outline" icon="content_copy" class="w-full sm:w-auto">
            Salin Rekening
        </x-ui.button>
    </div>
</x-ui.card>
