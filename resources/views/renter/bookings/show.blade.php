@extends('layouts.app')

@section('content')
<div class="flex-grow w-full max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-stack-md relative z-10">
    
    <!-- Back Link -->
    <a href="{{ route('renter.bookings.index') }}" class="inline-flex items-center text-on-surface-variant hover:text-primary font-label-md transition-colors mb-stack-sm">
        <span class="material-symbols-outlined mr-2">arrow_back</span>
        Kembali ke Riwayat
    </a>

    <!-- Header -->
    <header class="mb-stack-lg flex flex-col md:flex-row justify-between items-start md:items-end gap-4">
        <div>
            <h1 class="font-headline-lg-mobile md:font-headline-lg text-headline-lg-mobile md:text-headline-lg text-primary mb-2">Detail Pesanan</h1>
            <p class="font-body-lg text-on-surface-variant flex items-center gap-2">
                ID Pesanan: <span class="font-bold font-mono">{{ $booking->booking_code }}</span>
                <button class="text-on-tertiary-fixed-variant hover:text-primary transition-colors" title="Salin ID">
                    <span class="material-symbols-outlined text-[18px]">content_copy</span>
                </button>
            </p>
        </div>
    </header>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-gutter items-start">
        
        <!-- Left Column: Order Details & Upload -->
        <div class="lg:col-span-2 flex flex-col gap-stack-md">
            
            <!-- Status Banner -->
            @if($booking->status == 'Pending')
                <div class="bg-[#f59e0b]/10 border border-[#f59e0b]/30 rounded-2xl p-6 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-[#f59e0b] flex items-center justify-center text-on-primary shrink-0 shadow-sm">
                            <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">schedule</span>
                        </div>
                        <div>
                            <h3 class="font-headline-md text-[#b45309] text-[18px]">Pending</h3>
                            <p class="font-body-md text-on-surface-variant text-sm">Selesaikan pembayaran sebelum batas waktu.</p>
                        </div>
                    </div>
                    <div class="bg-surface-container-lowest border border-[#f59e0b]/30 px-4 py-2 rounded-lg text-center sm:text-right min-w-[140px]">
                        <p class="font-label-md text-on-surface-variant text-[11px] uppercase tracking-wider mb-1">Batas Waktu</p>
                        <p class="font-headline-md text-[#b45309] text-[16px] font-mono">{{ $booking->deadline }}</p>
                    </div>
                </div>
            @elseif($booking->status == 'Confirmed')
                <div class="bg-tertiary-fixed border border-tertiary-fixed-dim/30 rounded-2xl p-6 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-on-tertiary-fixed-variant flex items-center justify-center text-primary shrink-0 shadow-sm">
                            <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                        </div>
                        <div>
                            <h3 class="font-headline-md text-on-tertiary-fixed-variant text-[18px]">Confirmed</h3>
                            <p class="font-body-md text-on-tertiary-fixed text-sm">Lapangan telah berhasil disewa dan siap digunakan.</p>
                        </div>
                    </div>
                </div>
            @elseif($booking->status == 'Waiting Verification')
                <div class="bg-secondary-container border border-secondary/30 rounded-2xl p-6 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-secondary flex items-center justify-center text-on-secondary shrink-0 shadow-sm">
                            <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">hourglass_top</span>
                        </div>
                        <div>
                            <h3 class="font-headline-md text-on-secondary-container text-[18px]">Menunggu Konfirmasi</h3>
                            <p class="font-body-md text-on-secondary-container/80 text-sm">Bukti pembayaran telah kami terima dan sedang ditinjau oleh Admin.</p>
                        </div>
                    </div>
                </div>
            @else
                <div class="bg-surface-variant/30 border border-outline-variant/30 rounded-2xl p-6 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-on-surface-variant flex items-center justify-center text-surface shrink-0 shadow-sm">
                            <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">cancel</span>
                        </div>
                        <div>
                            <h3 class="font-headline-md text-on-surface-variant text-[18px]">Cancelled</h3>
                            <p class="font-body-md text-on-surface-variant text-sm">Pesanan ini telah dibatalkan atau melewati batas waktu pembayaran.</p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Venue Details Card -->
            <div class="bg-surface-container-lowest rounded-2xl border border-outline-variant/30 shadow-sm overflow-hidden">
                <div class="p-5 border-b border-outline-variant/20 flex items-center gap-2">
                    <span class="material-symbols-outlined text-on-surface-variant">store</span>
                    <h3 class="font-headline-md text-primary text-[18px]">Informasi Lapangan</h3>
                </div>
                <div class="p-6 flex flex-col sm:flex-row gap-6">
                    <div class="w-full sm:w-32 h-32 rounded-xl overflow-hidden shrink-0 border border-outline-variant/20 shadow-sm">
                        <img src="{{ $booking->venue_image }}" alt="{{ $booking->venue_name }}" class="w-full h-full object-cover">
                    </div>
                    <div class="flex-grow flex flex-col justify-center">
                        <h4 class="font-headline-md text-primary text-[20px] mb-1">{{ $booking->venue_name }}</h4>
                        <p class="font-body-md text-on-surface-variant flex items-center gap-1 mb-4">
                            <span class="material-symbols-outlined text-[16px]">location_on</span> {{ $booking->venue_address }}
                        </p>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="font-label-md text-on-surface-variant text-[12px] mb-1">Tanggal</p>
                                <p class="font-body-md text-on-surface font-semibold flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[16px] text-on-tertiary-fixed-variant">calendar_today</span> {{ $booking->date }}
                                </p>
                            </div>
                            <div>
                                <p class="font-label-md text-on-surface-variant text-[12px] mb-1">Waktu</p>
                                <p class="font-body-md text-on-surface font-semibold flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[16px] text-on-tertiary-fixed-variant">schedule</span> {{ $booking->time }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if($booking->status == 'Pending')
                <!-- Payment Method Card -->
                <div class="bg-surface-container-lowest rounded-2xl border border-outline-variant/30 shadow-sm overflow-hidden">
                    <div class="p-5 border-b border-outline-variant/20 flex items-center gap-2">
                        <span class="material-symbols-outlined text-on-surface-variant">account_balance</span>
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
                        <button class="bg-surface-container-low border border-outline-variant/50 text-primary font-label-md px-6 py-3 rounded-xl hover:bg-surface-container transition-colors flex items-center gap-2 shadow-sm w-full sm:w-auto justify-center">
                            <span class="material-symbols-outlined text-[18px]">content_copy</span> Salin Rekening
                        </button>
                    </div>
                </div>

                <!-- Upload Proof Card -->
                <div class="bg-surface-container-lowest rounded-2xl border border-outline-variant/30 shadow-sm overflow-hidden">
                    <div class="p-5 border-b border-outline-variant/20 flex items-center gap-2">
                        <span class="material-symbols-outlined text-on-surface-variant">upload_file</span>
                        <h3 class="font-headline-md text-primary text-[18px]">Unggah Bukti Pembayaran</h3>
                    </div>
                    <div class="p-6">
                        <form action="{{ route('renter.bookings.pay', $booking->booking_code) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="border-2 border-dashed border-outline-variant/50 rounded-xl p-8 flex flex-col items-center justify-center text-center bg-surface hover:bg-surface-container-lowest transition-colors cursor-pointer group mb-6 relative">
                                <input type="file" id="payment_proof" name="payment_proof" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" accept="image/jpeg,image/png,image/jpg,application/pdf" required>
                                <div class="w-16 h-16 rounded-full bg-surface-container-low flex items-center justify-center text-on-tertiary-fixed-variant mb-4 group-hover:scale-110 transition-transform">
                                    <span class="material-symbols-outlined text-[32px]" id="upload-icon">cloud_upload</span>
                                </div>
                                <h4 class="font-headline-md text-primary mb-2" id="file-name">Klik atau seret file ke sini</h4>
                                <p class="font-body-md text-on-surface-variant text-sm max-w-xs" id="file-info">Mendukung format JPG, PNG, atau PDF. Ukuran maksimal file 5MB.</p>
                            </div>
                            @error('payment_proof')
                                <p class="text-error font-body-md text-[12px] mb-4">{{ $message }}</p>
                            @enderror

                            <div class="flex flex-col sm:flex-row gap-4 justify-end">
                                <button type="button" onclick="document.getElementById('cancel-modal').classList.remove('hidden')" class="border border-error text-error font-label-md px-6 py-3 rounded-xl hover:bg-error/10 transition-colors flex items-center justify-center">
                                    Batalkan Pesanan
                                </button>
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
                </div>
            @endif
        </div>

        <!-- Right Column: Sticky Summary -->
        <div class="lg:sticky lg:top-[100px]">
            <div class="bg-surface-container-lowest rounded-2xl border border-outline-variant/30 shadow-md overflow-hidden">
                <div class="bg-primary px-6 py-4 flex items-center gap-2 text-on-primary">
                    <span class="material-symbols-outlined">receipt_long</span>
                    <h3 class="font-headline-md text-[18px]">Rincian Pembayaran</h3>
                </div>
                
                <div class="p-6 flex flex-col gap-4">
                    <div class="flex justify-between items-start pb-4 border-b border-outline-variant/20">
                        <div>
                            <p class="font-body-md text-on-surface">{{ $booking->venue_name }}</p>
                            <p class="font-body-md text-on-surface-variant text-sm">{{ $booking->duration }} Jam x Rp {{ number_format($booking->price_per_hour, 0, ',', '.') }}</p>
                        </div>
                        <p class="font-body-md text-on-surface font-semibold">Rp {{ number_format($booking->subtotal, 0, ',', '.') }}</p>
                    </div>

                    <div class="flex justify-between items-center text-on-surface-variant">
                        <p class="font-body-md">Biaya Layanan</p>
                        <p class="font-body-md">Rp {{ number_format($booking->admin_fee, 0, ',', '.') }}</p>
                    </div>

                    <div class="flex justify-between items-center text-on-surface-variant pb-4 border-b border-outline-variant/20">
                        <p class="font-body-md">Pajak (11%)</p>
                        <p class="font-body-md">Rp {{ number_format($booking->tax, 0, ',', '.') }}</p>
                    </div>

                    <div class="flex justify-between items-center pt-2">
                        <p class="font-label-md text-on-surface">Total Pembayaran</p>
                        <p class="font-headline-md text-primary text-[24px]">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</p>
                    </div>
                </div>
                @if($booking->status == 'Pending')
                <div class="bg-surface-container-low px-6 py-4 border-t border-outline-variant/20 text-center">
                    <p class="font-body-md text-on-surface-variant text-[12px]">Pastikan nominal transfer sesuai hingga 3 digit terakhir.</p>
                </div>
                @endif
            </div>
        </div>

    </div>
</div>

<!-- Cancel Confirmation Modal -->
<div id="cancel-modal" class="fixed inset-0 z-[100] hidden">
    <!-- Backdrop -->
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm transition-opacity" onclick="document.getElementById('cancel-modal').classList.add('hidden')"></div>
    
    <!-- Modal Panel -->
    <div class="fixed inset-0 flex items-center justify-center p-4 z-10">
        <div class="bg-surface-container-lowest rounded-3xl max-w-sm w-full p-6 shadow-xl relative overflow-hidden transform transition-all">
            <!-- Icon -->
            <div class="w-16 h-16 bg-error/10 text-error rounded-full flex items-center justify-center mx-auto mb-4">
                <span class="material-symbols-outlined text-[32px]">warning</span>
            </div>
            
            <h3 class="font-headline-md text-primary text-center mb-2 text-[20px]">Batalkan Pesanan?</h3>
            <p class="font-body-md text-on-surface-variant text-center mb-6">Apakah Anda yakin ingin membatalkan pesanan ini? Tindakan ini tidak dapat diurungkan.</p>
            
            <div class="flex gap-3">
                <button type="button" onclick="document.getElementById('cancel-modal').classList.add('hidden')" class="flex-1 bg-surface-container-low text-on-surface font-label-md py-3 rounded-xl hover:bg-surface-container transition-colors border border-outline-variant/30">
                    Kembali
                </button>
                <button type="button" onclick="document.getElementById('cancel-form').submit()" class="flex-1 bg-[#ef4444] text-white font-label-md py-3 rounded-xl hover:bg-[#dc2626] transition-colors shadow-sm">
                    Ya, Batalkan
                </button>
            </div>
        </div>
    </div>
</div>
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
@endsection
