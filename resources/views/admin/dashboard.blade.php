@extends('layouts.app')

@section('content')
<div class="bg-surface-container-low min-h-screen">
    <div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-stack-lg">
        
        <!-- Header -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-stack-lg gap-4">
            <div>
                <h1 class="font-display text-display text-primary mb-1">Admin Dashboard</h1>
                <p class="font-body-md text-on-surface-variant">Kelola pemesanan, pengguna, dan fasilitas lapangan Anda hari ini.</p>
            </div>
            <div class="flex gap-3">
                <button class="bg-surface-container-lowest text-primary px-4 py-2 rounded-lg font-label-md border border-outline-variant/30 hover:bg-surface-container transition-colors shadow-sm flex items-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">download</span> Laporan
                </button>
                <button class="bg-secondary text-on-secondary px-4 py-2 rounded-lg font-label-md hover:bg-secondary/90 transition-colors shadow-sm flex items-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">add</span> Lapangan Baru
                </button>
            </div>
        </div>

        <!-- High-Level Analytics -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-gutter mb-stack-lg">
            <div class="bg-surface-container-lowest p-6 rounded-2xl shadow-sm border border-outline-variant/20 flex flex-col gap-2">
                <div class="flex justify-between items-center text-on-surface-variant">
                    <span class="font-label-md">Total Pendapatan</span>
                    <span class="material-symbols-outlined bg-surface-container p-2 rounded-lg">account_balance_wallet</span>
                </div>
                <div class="font-headline-lg text-primary">Rp 4.250k</div>
                <div class="text-sm font-label-md text-secondary flex items-center gap-1">
                    <span class="material-symbols-outlined text-[16px]">trending_up</span> +12% dari minggu lalu
                </div>
            </div>
            
            <div class="bg-surface-container-lowest p-6 rounded-2xl shadow-sm border border-outline-variant/20 flex flex-col gap-2">
                <div class="flex justify-between items-center text-on-surface-variant">
                    <span class="font-label-md">Pesanan Baru</span>
                    <span class="material-symbols-outlined bg-surface-container p-2 rounded-lg">shopping_cart</span>
                </div>
                <div class="font-headline-lg text-primary">24</div>
                <div class="text-sm font-label-md text-[#f59e0b] flex items-center gap-1">
                    <span class="material-symbols-outlined text-[16px]">schedule</span> 5 menunggu validasi
                </div>
            </div>
            
            <div class="bg-surface-container-lowest p-6 rounded-2xl shadow-sm border border-outline-variant/20 flex flex-col gap-2">
                <div class="flex justify-between items-center text-on-surface-variant">
                    <span class="font-label-md">Okupansi Lapangan</span>
                    <span class="material-symbols-outlined bg-surface-container p-2 rounded-lg">analytics</span>
                </div>
                <div class="font-headline-lg text-primary">78%</div>
                <div class="text-sm font-body-md text-on-surface-variant">Rata-rata minggu ini</div>
            </div>
            
            <div class="bg-surface-container-lowest p-6 rounded-2xl shadow-sm border border-outline-variant/20 flex flex-col gap-2">
                <div class="flex justify-between items-center text-on-surface-variant">
                    <span class="font-label-md">Registrasi Baru</span>
                    <span class="material-symbols-outlined bg-surface-container p-2 rounded-lg">group_add</span>
                </div>
                <div class="font-headline-lg text-primary">12</div>
                <div class="text-sm font-label-md text-[#f59e0b] flex items-center gap-1">
                    <span class="material-symbols-outlined text-[16px]">pending_actions</span> 3 butuh persetujuan
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-gutter mb-stack-lg">
            <!-- Booking & Payment Verification -->
            <div class="bg-surface-container-lowest rounded-2xl shadow-sm border border-outline-variant/20 overflow-hidden flex flex-col">
                <div class="p-6 border-b border-outline-variant/30 flex justify-between items-center bg-surface">
                    <h2 class="font-headline-md text-primary">Verifikasi Pembayaran</h2>
                    <a href="#" class="text-secondary font-label-md hover:underline">Lihat Semua</a>
                </div>
                <div class="p-0">
                    <div class="flex flex-col">
                        <!-- Item 1 -->
                        <div class="p-4 border-b border-outline-variant/10 hover:bg-surface-container-low transition-colors flex justify-between items-center">
                            <div class="flex gap-4 items-center">
                                <div class="w-12 h-12 rounded-lg bg-surface-container flex items-center justify-center text-on-surface-variant">
                                    <span class="material-symbols-outlined">receipt_long</span>
                                </div>
                                <div>
                                    <p class="font-label-md text-primary">Budi Santoso</p>
                                    <p class="font-body-md text-sm text-on-surface-variant">Premium Futsal A • 24 Okt, 19:00</p>
                                </div>
                            </div>
                            <div class="flex gap-2">
                                <button class="w-8 h-8 rounded-full bg-error/10 text-error hover:bg-error/20 flex items-center justify-center" title="Tolak">
                                    <span class="material-symbols-outlined text-[18px]">close</span>
                                </button>
                                <button class="w-8 h-8 rounded-full bg-secondary/10 text-secondary hover:bg-secondary/20 flex items-center justify-center" title="Setujui">
                                    <span class="material-symbols-outlined text-[18px]">check</span>
                                </button>
                            </div>
                        </div>
                        <!-- Item 2 -->
                        <div class="p-4 border-b border-outline-variant/10 hover:bg-surface-container-low transition-colors flex justify-between items-center">
                            <div class="flex gap-4 items-center">
                                <div class="w-12 h-12 rounded-lg bg-surface-container flex items-center justify-center text-on-surface-variant">
                                    <span class="material-symbols-outlined">receipt_long</span>
                                </div>
                                <div>
                                    <p class="font-label-md text-primary">Siti Aminah</p>
                                    <p class="font-body-md text-sm text-on-surface-variant">Serenity Tennis • 25 Okt, 08:00</p>
                                </div>
                            </div>
                            <div class="flex gap-2">
                                <button class="w-8 h-8 rounded-full bg-error/10 text-error hover:bg-error/20 flex items-center justify-center" title="Tolak">
                                    <span class="material-symbols-outlined text-[18px]">close</span>
                                </button>
                                <button class="w-8 h-8 rounded-full bg-secondary/10 text-secondary hover:bg-secondary/20 flex items-center justify-center" title="Setujui">
                                    <span class="material-symbols-outlined text-[18px]">check</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- User Approval Management -->
            <div class="bg-surface-container-lowest rounded-2xl shadow-sm border border-outline-variant/20 overflow-hidden flex flex-col">
                <div class="p-6 border-b border-outline-variant/30 flex justify-between items-center bg-surface">
                    <h2 class="font-headline-md text-primary">Persetujuan Akun</h2>
                    <a href="#" class="text-secondary font-label-md hover:underline">Lihat Semua</a>
                </div>
                <div class="p-0">
                    <div class="flex flex-col">
                        <!-- Item 1 -->
                        <div class="p-4 border-b border-outline-variant/10 hover:bg-surface-container-low transition-colors flex justify-between items-center">
                            <div class="flex gap-4 items-center">
                                <div class="w-10 h-10 rounded-full bg-surface-container flex items-center justify-center text-primary font-bold">
                                    A
                                </div>
                                <div>
                                    <p class="font-label-md text-primary">Andi Pratama</p>
                                    <p class="font-body-md text-sm text-on-surface-variant">andi@example.com • Reg: Hari Ini</p>
                                </div>
                            </div>
                            <div class="flex gap-2">
                                <button class="px-3 py-1 bg-surface-container text-on-surface font-label-md rounded-md text-xs hover:bg-surface-dim">Tolak</button>
                                <button class="px-3 py-1 bg-secondary text-on-secondary font-label-md rounded-md text-xs hover:bg-secondary/90">Setujui</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Venue Management -->
        <div class="bg-surface-container-lowest rounded-2xl shadow-sm border border-outline-variant/20 overflow-hidden">
            <div class="p-6 border-b border-outline-variant/30 flex justify-between items-center bg-surface">
                <h2 class="font-headline-md text-primary">Manajemen Lapangan</h2>
                <div class="flex gap-2">
                    <button class="material-symbols-outlined text-on-surface-variant hover:text-primary">filter_list</button>
                    <button class="material-symbols-outlined text-on-surface-variant hover:text-primary">more_vert</button>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left font-body-md text-on-surface">
                    <thead class="bg-surface-container-low text-on-surface-variant font-label-md text-sm">
                        <tr>
                            <th class="p-4 font-semibold">Nama Lapangan</th>
                            <th class="p-4 font-semibold">Tipe</th>
                            <th class="p-4 font-semibold">Harga / Jam</th>
                            <th class="p-4 font-semibold">Status</th>
                            <th class="p-4 font-semibold text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-outline-variant/20">
                        <tr class="hover:bg-surface-container-low/50 transition-colors">
                            <td class="p-4 font-label-md text-primary">Premium Futsal Arena A</td>
                            <td class="p-4 text-on-surface-variant">Futsal</td>
                            <td class="p-4">Rp 150.000</td>
                            <td class="p-4">
                                <span class="px-2 py-1 bg-secondary/10 text-secondary rounded-md text-xs font-bold">Tersedia</span>
                            </td>
                            <td class="p-4 text-right">
                                <button class="text-secondary hover:underline text-sm font-label-md">Edit</button>
                            </td>
                        </tr>
                        <tr class="hover:bg-surface-container-low/50 transition-colors">
                            <td class="p-4 font-label-md text-primary">Serenity Tennis Club</td>
                            <td class="p-4 text-on-surface-variant">Tennis</td>
                            <td class="p-4">Rp 200.000</td>
                            <td class="p-4">
                                <span class="px-2 py-1 bg-[#f59e0b]/10 text-[#f59e0b] rounded-md text-xs font-bold">Maintenance</span>
                            </td>
                            <td class="p-4 text-right">
                                <button class="text-secondary hover:underline text-sm font-label-md">Edit</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
@endsection
