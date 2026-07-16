@props(['booking'])

<x-ui.card padding="">
    <div class="p-5 border-b border-outline-variant/20 flex items-center gap-2">
        <x-ui.icon name="upload_file" class="text-on-surface-variant" />
        <h3 class="font-headline-md text-primary text-[18px]">Unggah Bukti Pembayaran</h3>
    </div>
    <div class="p-6">
        <form action="{{ route('renter.bookings.pay', $booking->booking_code) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="border-2 border-dashed border-outline-variant/50 rounded-xl p-8 flex flex-col items-center justify-center text-center bg-surface hover:bg-surface-container-lowest transition-colors cursor-pointer group mb-6 relative">
                <input type="file" id="payment_proof" name="payment_proof" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" accept="image/jpeg,image/png,image/jpg,application/pdf" required>
                <div class="w-16 h-16 rounded-full bg-surface-container-low flex items-center justify-center text-on-tertiary-fixed-variant mb-4 group-hover:scale-110 transition-transform">
                    <x-ui.icon name="cloud_upload" class="text-[32px]" id="upload-icon" />
                </div>
                <h4 class="font-headline-md text-primary mb-2" id="file-name">Klik atau seret file ke sini</h4>
                <p class="font-body-md text-on-surface-variant text-sm max-w-xs" id="file-info">Mendukung format JPG, PNG, atau PDF. Ukuran maksimal file 5MB.</p>
            </div>
            @error('payment_proof')
                <p class="text-error font-body-md text-[12px] mb-4">{{ $message }}</p>
            @enderror

            <div class="flex flex-col sm:flex-row gap-4 justify-end">
                <x-ui.button type="button" variant="danger-outline" onclick="document.getElementById('cancel-modal').classList.remove('hidden')">
                    Batalkan Pesanan
                </x-ui.button>
                <button type="submit" class="bg-on-tertiary-fixed-variant text-on-primary font-label-md px-8 py-3 rounded-xl hover:bg-primary transition-colors shadow-sm">
                    Konfirmasi Pembayaran
                </button>
            </div>
        </form>
        
        <!-- Hidden form for cancellation -->
        <form id="cancel-form" action="{{ route('renter.bookings.cancel', $booking->booking_code) }}" method="POST" class="hidden">
            @csrf
        </form>
    </div>
</x-ui.card>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // File Upload UI Update
        const fileInput = document.getElementById('payment_proof');
        if (fileInput) {
            fileInput.addEventListener('change', function(e) {
                if (e.target.files.length > 0) {
                    const fileName = e.target.files[0].name;
                    document.getElementById('file-name').textContent = fileName;
                    document.getElementById('file-info').textContent = "File siap diunggah.";
                    document.getElementById('upload-icon').textContent = "check_circle";
                    document.getElementById('upload-icon').classList.replace('text-on-tertiary-fixed-variant', 'text-[#10b981]');
                }
            });
        }
    });
</script>
@endpush
