@extends('layouts.admin')

@section('title', 'ArenaKita Admin - Dashboard')

@section('content')

    <!-- Header Section -->
    <x-admin.page-header 
        title="Dashboard Overview" 
        subtitle="Welcome back. Here is the latest summary of venue activity." 
    />

    <!-- Flash Messages -->
    @if(session('success'))
        <div class="bg-secondary-container text-on-secondary-container px-4 py-3 rounded-xl mb-6 flex items-center gap-2">
            <span class="material-symbols-outlined">check_circle</span>
            {{ session('success') }}
        </div>
    @endif

    <!-- Stats Cards Row (Bento/Card Grid) -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-stack-lg">
        
        <x-admin.stat-card 
            title="Pendaftar Menunggu" 
            :value="$pendingUsers" 
            icon="person_add" 
            color="secondary"
        />

        <x-admin.stat-card 
            title="Pembayaran Perlu Verifikasi" 
            :value="$pendingPayments" 
            icon="payments" 
            color="error"
            :badge="$pendingPayments > 0 ? 'Butuh Tindakan' : null"
        />

        <x-admin.stat-card 
            title="Total Lapangan Aktif" 
            :value="$activeVenues" 
            icon="stadium" 
            color="primary"
            :subtext="'Dari total ' . $totalVenues . ' lapangan'"
        />

    </div>

    <!-- Secondary Section: Recent Activity / Table -->
    <x-admin.table-card title="Verifikasi Pembayaran Terbaru">
        <x-slot:action>
            <a href="{{ route('admin.payments.index') }}" class="text-label-md font-label-md text-on-primary bg-on-primary/10 hover:bg-on-primary/20 px-4 py-2 rounded-lg transition-colors border border-on-primary/20">
                View All
            </a>
        </x-slot:action>

        <x-slot:head>
            <th class="px-6 py-4 font-semibold">User</th>
            <th class="px-6 py-4 font-semibold">Venue</th>
            <th class="px-6 py-4 font-semibold">Tanggal & Waktu</th>
            <th class="px-6 py-4 font-semibold">Jumlah</th>
            <th class="px-6 py-4 font-semibold text-right">Status</th>
        </x-slot:head>

        @forelse($recentPayments as $payment)
            <tr class="border-b border-outline-variant/10 hover:bg-surface-container-low transition-colors">
                <td class="px-6 py-4">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full bg-inverse-primary flex items-center justify-center text-on-surface font-label-md text-xs">
                            {{ strtoupper(substr($payment->booking->user->name ?? 'N/A', 0, 2)) }}
                        </div>
                        <span class="font-medium text-on-surface">{{ $payment->booking->user->name ?? 'N/A' }}</span>
                    </div>
                </td>
                <td class="px-6 py-4 text-on-surface-variant">{{ $payment->booking->venue->name ?? 'N/A' }}</td>
                <td class="px-6 py-4 text-on-surface-variant">
                    {{ $payment->booking->booking_date->format('M d, Y') }}, 
                    {{ \Carbon\Carbon::parse($payment->booking->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($payment->booking->end_time)->format('H:i') }}
                </td>
                <td class="px-6 py-4 text-on-surface font-medium">Rp {{ number_format($payment->booking->total_price, 0, ',', '.') }}</td>
                <td class="px-6 py-4 text-right">
                    @if($payment->status === 'pending')
                        <x-admin.badge color="warning" text="Pending" />
                    @elseif($payment->status === 'verified')
                        <x-admin.badge color="success" icon="check_circle" text="Verified" />
                    @else
                        <x-admin.badge color="error" text="Rejected" />
                    @endif
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="px-6 py-8 text-center text-on-surface-variant">Belum ada data pembayaran.</td>
            </tr>
        @endforelse
    </x-admin.table-card>

@endsection
