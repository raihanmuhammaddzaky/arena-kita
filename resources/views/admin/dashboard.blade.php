@extends('layouts.admin')

@section('title', 'ArenaKita Admin - Dashboard')

@section('content')

    <!-- Header Section -->
    <x-admin.page-header 
        title="Dashboard Overview" 
        subtitle="Welcome back. Here is the latest summary of venue activity." 
    />

    <!-- Stats Cards Row (Bento/Card Grid) -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-stack-lg">
        
        <x-admin.stat-card 
            title="Pendaftar Baru" 
            value="24" 
            icon="person_add" 
            color="secondary"
            trend="up"
            trendText="+12% minggu ini"
        />

        <x-admin.stat-card 
            title="Booking Perlu Verifikasi" 
            value="12" 
            icon="payments" 
            color="error"
            badge="Butuh Tindakan"
        />

        <x-admin.stat-card 
            title="Total Lapangan Aktif" 
            value="8" 
            icon="stadium" 
            color="primary"
            subtext="Dari total 10 lapangan"
        />

    </div>

    <!-- Secondary Section: Recent Activity / Table -->
    <x-admin.table-card title="Recent Booking Verifications">
        <x-slot:action>
            <a href="#" class="text-label-md font-label-md text-on-primary bg-on-primary/10 hover:bg-on-primary/20 px-4 py-2 rounded-lg transition-colors border border-on-primary/20">
                View All
            </a>
        </x-slot:action>

        <x-slot:head>
            <th class="px-6 py-4 font-semibold">User</th>
            <th class="px-6 py-4 font-semibold">Venue</th>
            <th class="px-6 py-4 font-semibold">Date & Time</th>
            <th class="px-6 py-4 font-semibold">Amount</th>
            <th class="px-6 py-4 font-semibold text-right">Action</th>
        </x-slot:head>

        <!-- Row 1 -->
        <tr class="border-b border-outline-variant/10 hover:bg-surface-container-low transition-colors">
            <td class="px-6 py-4">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-inverse-primary flex items-center justify-center text-on-surface font-label-md text-xs">AJ</div>
                    <span class="font-medium text-on-surface">Ahmad Fathan</span>
                </div>
            </td>
            <td class="px-6 py-4 text-on-surface-variant">Gelora Bung Karno - Court A</td>
            <td class="px-6 py-4 text-on-surface-variant">Oct 24, 18:00 - 20:00</td>
            <td class="px-6 py-4 text-on-surface font-medium">Rp 450.000</td>
            <td class="px-6 py-4 text-right">
                <button class="bg-secondary text-on-secondary hover:bg-on-secondary-container px-4 py-2 rounded-lg text-label-md font-label-md shadow-sm transition-all duration-200">
                    Verifikasi Sekarang
                </button>
            </td>
        </tr>

        <!-- Row 2 -->
        <tr class="border-b border-outline-variant/10 hover:bg-surface-container-low transition-colors">
            <td class="px-6 py-4">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-surface-dim flex items-center justify-center text-on-surface font-label-md text-xs">BD</div>
                    <span class="font-medium text-on-surface">Budi Santoso</span>
                </div>
            </td>
            <td class="px-6 py-4 text-on-surface-variant">Arena Sport - Futsal 1</td>
            <td class="px-6 py-4 text-on-surface-variant">Oct 25, 08:00 - 10:00</td>
            <td class="px-6 py-4 text-on-surface font-medium">Rp 200.000</td>
            <td class="px-6 py-4 text-right">
                <button class="bg-secondary text-on-secondary hover:bg-on-secondary-container px-4 py-2 rounded-lg text-label-md font-label-md shadow-sm transition-all duration-200">
                    Verifikasi Sekarang
                </button>
            </td>
        </tr>

        <!-- Row 3 -->
        <tr class="hover:bg-surface-container-low transition-colors">
            <td class="px-6 py-4">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-primary-fixed flex items-center justify-center text-on-surface font-label-md text-xs">CW</div>
                    <span class="font-medium text-on-surface">Citra Wulandari</span>
                </div>
            </td>
            <td class="px-6 py-4 text-on-surface-variant">GOR Bulutangkis Senayan</td>
            <td class="px-6 py-4 text-on-surface-variant">Oct 25, 19:00 - 21:00</td>
            <td class="px-6 py-4 text-on-surface font-medium">Rp 150.000</td>
            <td class="px-6 py-4 text-right">
                <x-admin.badge color="success" icon="check_circle" text="Verified" />
            </td>
        </tr>
    </x-admin.table-card>

@endsection
