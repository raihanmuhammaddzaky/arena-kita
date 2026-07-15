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
            <div class="bg-[#f59e0b]/10 border border-[#f59e0b]/30 rounded-2xl p-6 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-[#f59e0b] flex items-center justify-center text-on-primary shrink-0 shadow-sm">
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">schedule</span>
                    </div>
                    <div>
                        <h3 class="font-headline-md text-[#b45309] text-[18px]">Menunggu Pembayaran</h3>
                        <p class="font-body-md text-on-surface-variant text-sm">Selesaikan pembayaran sebelum batas waktu.</p>
                    </div>
                </div>
                <div class="bg-surface-container-lowest border border-[#f59e0b]/30 px-4 py-2 rounded-lg text-center sm:text-right min-w-[140px]">
                    <p class="font-label-md text-on-surface-variant text-[11px] uppercase tracking-wider mb-1">Batas Waktu</p>
                    <p class="font-headline-md text-[#b45309] text-[16px] font-mono">{{ $booking->deadline }}</p>
                </div>
            </div>

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
                    <form action="#" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="border-2 border-dashed border-outline-variant/50 rounded-xl p-8 flex flex-col items-center justify-center text-center bg-surface hover:bg-surface-container-lowest transition-colors cursor-pointer group mb-6 relative">
                            <input type="file" name="payment_proof" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" accept="image/jpeg,image/png,image/jpg,application/pdf">
                            <div class="w-16 h-16 rounded-full bg-surface-container-low flex items-center justify-center text-on-tertiary-fixed-variant mb-4 group-hover:scale-110 transition-transform">
                                <span class="material-symbols-outlined text-[32px]">cloud_upload</span>
                            </div>
                            <h4 class="font-headline-md text-primary mb-2">Klik atau seret file ke sini</h4>
                            <p class="font-body-md text-on-surface-variant text-sm max-w-xs">Mendukung format JPG, PNG, atau PDF. Ukuran maksimal file 5MB.</p>
                        </div>

                        <div class="flex flex-col sm:flex-row gap-4 justify-end">
                            <button type="button" class="border border-error text-error font-label-md px-6 py-3 rounded-xl hover:bg-error/10 transition-colors">
                                Batalkan Pesanan
                            </button>
                            <button type="submit" class="bg-on-tertiary-fixed-variant text-on-primary font-label-md px-8 py-3 rounded-xl hover:bg-primary transition-colors shadow-sm">
                                Konfirmasi Pembayaran
                            </button>
                        </div>
                    </form>
                </div>
            </div>

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
                <div class="bg-surface-container-low px-6 py-4 border-t border-outline-variant/20 text-center">
                    <p class="font-body-md text-on-surface-variant text-[12px]">Pastikan nominal transfer sesuai hingga 3 digit terakhir.</p>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
