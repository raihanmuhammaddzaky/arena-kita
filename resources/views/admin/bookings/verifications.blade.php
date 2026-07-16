@extends('layouts.admin')

@section('title', 'ArenaKita Admin - Payment Verifications')

@section('content')
    <div class="max-w-container-max mx-auto flex flex-col gap-stack-lg relative z-10">
        
        <!-- Page Header -->
        <header class="flex flex-col md:flex-row justify-between items-start md:items-end border-b border-surface-variant pb-6 gap-4">
            <x-admin.page-header 
                title="Payment Verifications" 
                subtitle="Review and validate user transfer proofs to finalize bookings." 
            />
            <div class="flex items-center gap-4">
                <form method="GET" action="{{ route('admin.payments.index') }}" class="flex items-center gap-2">
                    <select name="status" class="bg-surface-container border-none rounded-xl px-4 py-2 text-sm focus:ring-2 focus:ring-secondary-container" onchange="this.form.submit()">
                        <option value="pending" {{ ($statusFilter ?? 'pending') === 'pending' ? 'selected' : '' }}>Pending Only</option>
                        <option value="all" {{ ($statusFilter ?? '') === 'all' ? 'selected' : '' }}>All</option>
                        <option value="verified" {{ ($statusFilter ?? '') === 'verified' ? 'selected' : '' }}>Verified</option>
                        <option value="rejected" {{ ($statusFilter ?? '') === 'rejected' ? 'selected' : '' }}>Rejected</option>
                    </select>
                </form>
            </div>
        </header>

        <!-- Flash Messages -->
        @if(session('success'))
            <div class="bg-secondary-container text-on-secondary-container px-4 py-3 rounded-xl flex items-center gap-2">
                <span class="material-symbols-outlined">check_circle</span>
                {{ session('success') }}
            </div>
        @endif

        <!-- Verification Queue Grid -->
        <section class="grid grid-cols-1 xl:grid-cols-2 gap-stack-md">
            @forelse($payments as $payment)
                <div class="bg-surface-container-lowest rounded-xl shadow-md p-6 flex flex-col sm:flex-row gap-6 transition-all duration-200 hover:shadow-lg relative overflow-hidden group">
                    <!-- Subtle accent bar -->
                    <div class="absolute left-0 top-0 bottom-0 w-1 {{ $payment->status === 'verified' ? 'bg-secondary' : ($payment->status === 'rejected' ? 'bg-error' : 'bg-secondary-container') }} rounded-l-xl"></div>
                    
                    <!-- Thumbnail -->
                    <div class="w-full sm:w-40 h-48 sm:h-auto bg-surface-container rounded-lg overflow-hidden shrink-0 relative cursor-pointer group-hover:ring-2 ring-secondary-container transition-all">
                        <img class="w-full h-full object-cover" src="{{ asset('storage/' . $payment->proof_image) }}" alt="Bukti Pembayaran">
                        <div class="absolute inset-0 bg-primary/10 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                            <span class="material-symbols-outlined text-on-primary" style="font-variation-settings: 'FILL' 1;">zoom_in</span>
                        </div>
                    </div>
                    
                    <!-- Details & Actions -->
                    <div class="flex-1 flex flex-col justify-between">
                        <div>
                            <div class="flex justify-between items-start mb-2">
                                <span class="bg-surface-container-high text-on-surface font-label-md text-label-md px-2 py-1 rounded font-mono text-sm">{{ $payment->booking->booking_code }}</span>
                                <x-admin.badge 
                                    :color="$payment->status === 'verified' ? 'success' : ($payment->status === 'rejected' ? 'error' : 'warning')" 
                                    :text="ucfirst($payment->status)" 
                                />
                            </div>
                            <h3 class="font-headline-md text-headline-md text-primary mb-1">Rp {{ number_format($payment->booking->total_price, 0, ',', '.') }}</h3>
                            <p class="font-body-md text-body-md text-on-surface-variant mb-1">
                                <strong class="text-on-surface">{{ $payment->booking->user->name ?? 'N/A' }}</strong> • {{ $payment->booking->venue->name ?? 'N/A' }}
                            </p>
                            <p class="text-sm text-on-surface-variant">
                                {{ $payment->booking->booking_date->format('d M Y') }}, 
                                {{ \Carbon\Carbon::parse($payment->booking->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($payment->booking->end_time)->format('H:i') }}
                            </p>
                            <p class="text-xs text-on-surface-variant mt-1">Uploaded {{ $payment->created_at->diffForHumans() }}</p>
                        </div>
                        
                        @if($payment->status === 'pending')
                            <div class="flex items-center gap-3 mt-4">
                                <form action="{{ route('admin.payments.verify', $payment) }}" method="POST" class="flex-1">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="w-full bg-secondary text-on-secondary font-label-md text-label-md py-3 px-4 rounded-xl shadow-sm hover:shadow-md transition-all flex items-center justify-center gap-2">
                                        <span class="material-symbols-outlined">check_circle</span>
                                        Verify Payment
                                    </button>
                                </form>
                                <form action="{{ route('admin.payments.reject', $payment) }}" method="POST" class="flex-none" onsubmit="return confirm('Yakin ingin menolak pembayaran ini?');">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="border border-outline text-error font-label-md text-label-md py-3 px-4 rounded-xl hover:bg-error-container hover:border-error-container hover:text-on-error-container transition-all flex items-center justify-center gap-2" title="Reject / Invalid">
                                        <span class="material-symbols-outlined">cancel</span>
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            @empty
                <div class="col-span-full py-12 text-center text-on-surface-variant">
                    <span class="material-symbols-outlined text-5xl mb-4 block">payments</span>
                    <p class="text-lg">Tidak ada pembayaran yang perlu diverifikasi.</p>
                </div>
            @endforelse
        </section>

        <!-- Pagination -->
        @if($payments->hasPages())
            <div class="mt-4">
                {{ $payments->links() }}
            </div>
        @endif
    </div>
@endsection
