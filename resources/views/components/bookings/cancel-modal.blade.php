<!-- Cancel Confirmation Modal -->
<div id="cancel-modal" class="fixed inset-0 z-[100] hidden">
    <!-- Backdrop -->
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm transition-opacity" onclick="document.getElementById('cancel-modal').classList.add('hidden')"></div>
    
    <!-- Modal Panel -->
    <div class="fixed inset-0 flex items-center justify-center p-4 z-10">
        <div class="bg-surface-container-lowest rounded-3xl max-w-sm w-full p-6 shadow-xl relative overflow-hidden transform transition-all">
            <!-- Icon -->
            <div class="w-16 h-16 bg-error/10 text-error rounded-full flex items-center justify-center mx-auto mb-4">
                <x-ui.icon name="warning" class="text-[32px]" />
            </div>
            
            <h3 class="font-headline-md text-primary text-center mb-2 text-[20px]">Batalkan Pesanan?</h3>
            <p class="font-body-md text-on-surface-variant text-center mb-6">Apakah Anda yakin ingin membatalkan pesanan ini? Tindakan ini tidak dapat diurungkan.</p>
            
            <div class="flex gap-3">
                <x-ui.button type="button" variant="default" class="flex-1" onclick="document.getElementById('cancel-modal').classList.add('hidden')">
                    Kembali
                </x-ui.button>
                <x-ui.button type="button" variant="danger" class="flex-1" onclick="document.getElementById('cancel-form').submit()">
                    Ya, Batalkan
                </x-ui.button>
            </div>
        </div>
    </div>
</div>
