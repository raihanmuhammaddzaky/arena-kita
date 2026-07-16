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

        <div class="bg-surface rounded-2xl shadow-md overflow-hidden relative">
            <div class="overflow-x-auto relative z-10">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-surface-container-highest bg-surface-container-low/50">
                            <th class="py-4 px-6 font-label-md text-label-md text-on-surface-variant">Kode Booking</th>
                            <th class="py-4 px-6 font-label-md text-label-md text-on-surface-variant">Penyewa</th>
                            <th class="py-4 px-6 font-label-md text-label-md text-on-surface-variant">Lapangan</th>
                            <th class="py-4 px-6 font-label-md text-label-md text-on-surface-variant">Total Bayar</th>
                            <th class="py-4 px-6 font-label-md text-label-md text-on-surface-variant">Status</th>
                            <th class="py-4 px-6 font-label-md text-label-md text-on-surface-variant text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-surface-container-highest">
                        @forelse($payments as $payment)
                            <tr class="hover:bg-surface-container-low transition-colors group cursor-pointer" onclick="window.location='{{ route('admin.payments.show', $payment) }}'">
                                <td class="py-4 px-6 font-mono text-sm text-on-surface">{{ $payment->booking->booking_code }}</td>
                                <td class="py-4 px-6 text-sm text-on-surface">{{ $payment->booking->user->name ?? 'N/A' }}</td>
                                <td class="py-4 px-6 text-sm text-on-surface">{{ $payment->booking->venue->name ?? 'N/A' }}</td>
                                <td class="py-4 px-6 text-sm font-medium text-primary">Rp {{ number_format($payment->booking->total_price, 0, ',', '.') }}</td>
                                <td class="py-4 px-6">
                                    <x-admin.badge 
                                        :color="$payment->status === 'verified' ? 'success' : ($payment->status === 'rejected' ? 'error' : 'warning')" 
                                        :text="ucfirst($payment->status)" 
                                    />
                                </td>
                                <td class="py-4 px-6 text-right">
                                    <a href="{{ route('admin.payments.show', $payment) }}" class="inline-flex items-center justify-center w-8 h-8 rounded-full hover:bg-surface-container text-on-surface-variant hover:text-primary transition-colors" title="Detail">
                                        <span class="material-symbols-outlined text-[20px]">visibility</span>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-12 text-center text-on-surface-variant">
                                    <span class="material-symbols-outlined text-5xl mb-4 block">payments</span>
                                    <p class="text-lg">Tidak ada data pembayaran.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        @if($payments->hasPages())
            <div class="mt-4">
                {{ $payments->links() }}
            </div>
        @endif
    </div>
@endsection
