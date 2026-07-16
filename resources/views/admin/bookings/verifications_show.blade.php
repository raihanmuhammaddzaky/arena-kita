@extends('layouts.admin')

@section('title', 'Detail Payment Verification - ' . $payment->booking->booking_code)

@section('content')
    <div class="max-w-container-max mx-auto flex flex-col gap-stack-lg relative z-10">
        <!-- Page Header -->
        <header class="flex items-center gap-4 border-b border-surface-variant pb-6">
            <a href="{{ route('admin.payments.index') }}" class="w-10 h-10 rounded-full flex items-center justify-center bg-surface-container hover:bg-surface-container-high transition-colors text-on-surface">
                <span class="material-symbols-outlined">arrow_back</span>
            </a>
            <div>
                <h1 class="font-headline-sm text-headline-sm text-primary">Detail Pembayaran</h1>
                <p class="text-sm text-on-surface-variant">Kode Booking: <span class="font-mono text-on-surface">{{ $payment->booking->booking_code }}</span></p>
            </div>
        </header>

        <!-- Flash Messages -->
        @if(session('success'))
            <div class="bg-secondary-container text-on-secondary-container px-4 py-3 rounded-xl flex items-center gap-2">
                <span class="material-symbols-outlined">check_circle</span>
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="bg-error-container text-on-error-container px-4 py-3 rounded-xl flex items-center gap-2">
                <span class="material-symbols-outlined">error</span>
                {{ session('error') }}
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Bukti Pembayaran -->
            <div class="bg-surface rounded-2xl shadow-sm border border-surface-variant overflow-hidden flex flex-col">
                <div class="p-4 border-b border-surface-variant bg-surface-container-lowest">
                    <h2 class="font-label-lg text-label-lg text-on-surface">Bukti Pembayaran</h2>
                </div>
                <div class="flex-1 p-6 flex justify-center items-center bg-surface-container-low min-h-[400px]">
                    <a href="{{ $payment->proof_image_url }}" target="_blank" class="block w-full h-full cursor-zoom-in" title="Klik untuk perbesar">
                        <img src="{{ $payment->proof_image_url }}" alt="Bukti Pembayaran" class="max-w-full max-h-[500px] object-contain mx-auto rounded-lg shadow-sm border border-surface-variant transition-transform hover:scale-[1.02]">
                    </a>
                </div>
            </div>

            <!-- Detail Pesanan -->
            <div class="flex flex-col gap-6">
                <div class="bg-surface rounded-2xl shadow-sm border border-surface-variant overflow-hidden">
                    <div class="p-4 border-b border-surface-variant bg-surface-container-lowest flex justify-between items-center">
                        <h2 class="font-label-lg text-label-lg text-on-surface">Detail Booking</h2>
                        <x-admin.badge 
                            :color="$payment->status === 'verified' ? 'success' : ($payment->status === 'rejected' ? 'error' : 'warning')" 
                            :text="ucfirst($payment->status)" 
                        />
                    </div>
                    <div class="p-6">
                        <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-4 gap-y-6">
                            <div>
                                <dt class="text-sm font-medium text-on-surface-variant mb-1">Penyewa</dt>
                                <dd class="text-base text-on-surface">{{ $payment->booking->user->name ?? 'N/A' }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-on-surface-variant mb-1">Kontak (Email)</dt>
                                <dd class="text-base text-on-surface">{{ $payment->booking->user->email ?? '-' }}</dd>
                            </div>
                            <div class="sm:col-span-2">
                                <dt class="text-sm font-medium text-on-surface-variant mb-1">Lapangan</dt>
                                <dd class="text-base text-on-surface">{{ $payment->booking->venue->name ?? 'N/A' }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-on-surface-variant mb-1">Tanggal & Waktu</dt>
                                <dd class="text-base text-on-surface">
                                    {{ $payment->booking->booking_date->format('d M Y') }}<br>
                                    <span class="text-sm">{{ \Carbon\Carbon::parse($payment->booking->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($payment->booking->end_time)->format('H:i') }}</span>
                                </dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-on-surface-variant mb-1">Dikirim Pada</dt>
                                <dd class="text-base text-on-surface">
                                    {{ $payment->created_at->format('d M Y, H:i') }} WIB
                                </dd>
                            </div>
                            <div class="sm:col-span-2 pt-4 border-t border-surface-variant">
                                <dt class="text-sm font-medium text-on-surface-variant mb-1">Total Bayar</dt>
                                <dd class="text-3xl font-bold text-primary">Rp {{ number_format($payment->booking->total_price, 0, ',', '.') }}</dd>
                            </div>
                        </dl>
                    </div>
                </div>

                @if($payment->status === 'pending')
                    <div class="bg-surface rounded-2xl shadow-sm border border-surface-variant p-6 flex flex-col sm:flex-row gap-4">
                        <form action="{{ route('admin.payments.verify', $payment) }}" method="POST" class="flex-1">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="w-full bg-secondary text-on-secondary font-label-lg text-label-lg py-3 px-6 rounded-xl hover:shadow-md transition-all flex items-center justify-center gap-2">
                                <span class="material-symbols-outlined">check_circle</span>
                                Verifikasi (Setuju)
                            </button>
                        </form>
                        
                        <form action="{{ route('admin.payments.reject', $payment) }}" method="POST" class="flex-1" onsubmit="return confirm('Apakah Anda yakin ingin menolak bukti pembayaran ini?');">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="w-full bg-error-container text-on-error-container font-label-lg text-label-lg py-3 px-6 rounded-xl hover:shadow-md transition-all flex items-center justify-center gap-2 border border-error/20">
                                <span class="material-symbols-outlined">cancel</span>
                                Tolak Pembayaran
                            </button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
