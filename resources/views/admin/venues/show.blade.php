@extends('layouts.admin')

@section('title', 'ArenaKita Admin - Detail Lapangan')

@section('content')
    <div class="max-w-container-max mx-auto w-full flex flex-col gap-stack-lg pb-24 md:pb-margin-desktop">
        <!-- Breadcrumbs & Header Actions -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div class="flex flex-col gap-2">
                <div class="flex items-center gap-2 text-sm text-on-surface-variant font-label-md">
                    <a href="#" class="hover:text-primary transition-colors">Venues</a>
                    <span class="material-symbols-outlined text-[16px]">chevron_right</span>
                    <span class="text-on-surface">Detail Lapangan</span>
                </div>
                <div class="flex items-center gap-4">
                    <h2 class="font-headline-lg-mobile md:font-headline-lg text-headline-lg-mobile md:text-headline-lg text-primary">Detail Lapangan Badminton Premium 1</h2>
                    <span class="px-3 py-1 bg-secondary-container text-on-secondary-container font-label-md text-label-md rounded-full shadow-sm">Aktif</span>
                </div>
            </div>
            <div class="flex items-center gap-3"></div>
        </div>

        <!-- Tab Navigation -->
        <div class="border-b border-outline-variant">
            <nav class="-mb-px flex gap-8" aria-label="Tabs" x-data="{ tab: 'informasi' }">
                <button @click="tab = 'informasi'" :class="tab === 'informasi' ? 'border-secondary text-secondary' : 'border-transparent text-on-surface-variant hover:text-on-surface hover:border-outline-variant'" class="whitespace-nowrap py-4 px-1 border-b-2 font-label-md text-label-md transition-colors">
                    Informasi Umum
                </button>
                <button @click="tab = 'riwayat'" :class="tab === 'riwayat' ? 'border-secondary text-secondary' : 'border-transparent text-on-surface-variant hover:text-on-surface hover:border-outline-variant'" class="whitespace-nowrap py-4 px-1 border-b-2 font-label-md text-label-md transition-colors">
                    Riwayat Penyewaan
                </button>
            </nav>
        </div>

        <div x-data="{ tab: 'informasi' }">
            <!-- Tab Content 1: Informasi Umum -->
            <div x-show="tab === 'informasi'" class="flex justify-end mt-1 mb-2">
                <button class="px-6 py-2 bg-secondary text-on-secondary rounded-lg font-label-md text-label-md hover:bg-on-secondary-fixed transition-colors shadow-sm flex items-center gap-2">
                    <span class="material-symbols-outlined text-[20px]">save</span>Simpan Perubahan
                </button>
            </div>
            
            <div x-show="tab === 'informasi'" class="grid grid-cols-1 lg:grid-cols-12 gap-gutter">
                <!-- Left Column: Details -->
                <div class="lg:col-span-7 flex flex-col gap-6">
                    <!-- Card: Informasi Dasar -->
                    <div class="bg-surface-container-lowest rounded-xl shadow-md p-6 flex flex-col gap-4">
                        <h3 class="font-headline-md text-[20px] leading-[28px] text-primary">Informasi Dasar</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="flex flex-col gap-1">
                                <label class="font-label-md text-label-md text-on-surface-variant">Nama Lapangan</label>
                                <input type="text" value="Lapangan Badminton Premium 1" class="w-full bg-surface-bright border border-outline-variant rounded-lg px-4 py-2 font-body-md text-on-surface focus:ring-2 focus:ring-secondary focus:border-transparent outline-none">
                            </div>
                            <div class="flex flex-col gap-1">
                                <label class="font-label-md text-label-md text-on-surface-variant">Status</label>
                                <select class="w-full bg-surface-bright border border-outline-variant rounded-lg px-4 py-2 font-body-md text-on-surface focus:ring-2 focus:ring-secondary focus:border-transparent outline-none">
                                    <option value="aktif" selected>Aktif</option>
                                    <option value="nonaktif">Non-Aktif</option>
                                    <option value="perbaikan">Dalam Perbaikan</option>
                                </select>
                            </div>
                            <div class="col-span-1 md:col-span-2 flex flex-col gap-1">
                                <label class="font-label-md text-label-md text-on-surface-variant">Deskripsi</label>
                                <textarea rows="4" class="w-full bg-surface-bright border border-outline-variant rounded-lg px-4 py-2 font-body-md text-on-surface focus:ring-2 focus:ring-secondary focus:border-transparent outline-none">Lapangan badminton indoor berstandar BWF dengan lantai karpet vinyl kualitas premium. Dilengkapi pencahayaan LED terang dan sirkulasi udara yang baik. Cocok untuk latihan profesional maupun pertandingan.</textarea>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Card: Harga & Kapasitas -->
                    <div class="bg-surface-container-lowest rounded-xl shadow-md p-6 flex flex-col gap-4">
                        <h3 class="font-headline-md text-[20px] leading-[28px] text-primary">Harga & Kapasitas</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="flex flex-col gap-1">
                                <label class="font-label-md text-label-md text-on-surface-variant">Harga per Sesi (Rp)</label>
                                <input type="number" value="150000" class="w-full bg-surface-bright border border-outline-variant rounded-lg px-4 py-2 font-body-md text-on-surface focus:ring-2 focus:ring-secondary focus:border-transparent outline-none">
                            </div>
                            <div class="flex flex-col gap-1">
                                <label class="font-label-md text-label-md text-on-surface-variant">Kapasitas Maksimal (Orang)</label>
                                <input type="number" value="8" class="w-full bg-surface-bright border border-outline-variant rounded-lg px-4 py-2 font-body-md text-on-surface focus:ring-2 focus:ring-secondary focus:border-transparent outline-none">
                            </div>
                            <div class="flex flex-col gap-1">
                                <label class="font-label-md text-label-md text-on-surface-variant">Durasi Sewa Standar (Menit)</label>
                                <input type="number" value="60" class="w-full bg-surface-bright border border-outline-variant rounded-lg px-4 py-2 font-body-md text-on-surface focus:ring-2 focus:ring-secondary focus:border-transparent outline-none">
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Right Column: Media -->
                <div class="lg:col-span-5 flex flex-col gap-6">
                    <div class="bg-surface-container-lowest rounded-xl shadow-md p-6 flex flex-col gap-4">
                        <div class="flex justify-between items-center">
                            <h3 class="font-headline-md text-[20px] leading-[28px] text-primary">Media Lapangan</h3>
                            <span class="font-label-md text-label-md text-on-surface-variant">4/4 Foto</span>
                        </div>
                        
                        <!-- Main Photo Preview -->
                        <div class="aspect-[4/3] rounded-lg overflow-hidden relative group">
                            <img class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCKhq4GlF4-e_ZI9i5DQ-wx7LqS2Af4KVquO-dn5LWtiARMFBJOkNUA_1xHVbzy16umGtP9psNlu1ewPDLpJuVT6OOIrZ37i0B8SOgH9jK2JML66Mxo99cfBzy5C3IldNoDLBUOLvzu3xWt1qw_W8qqWQZZ8TSCrgpVqhaCaCTcqVTIb1PcJokis6peXp-2dSNEN4XvBNiLRi0pc-65uoo7MeNgWIyARhInVJVnoggbYm1dFAlICGD2hw">
                            <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center gap-4">
                                <button class="p-2 bg-surface rounded-full text-primary hover:bg-surface-variant transition-colors shadow-sm">
                                    <span class="material-symbols-outlined">edit</span>
                                </button>
                                <button class="p-2 bg-surface rounded-full text-error hover:bg-error-container transition-colors shadow-sm">
                                    <span class="material-symbols-outlined">delete</span>
                                </button>
                            </div>
                            <span class="absolute top-2 left-2 px-2 py-1 bg-surface/80 backdrop-blur-sm text-primary font-label-md text-[12px] rounded-md">Utama</span>
                        </div>
                        
                        <!-- Gallery Grid -->
                        <div class="grid grid-cols-4 gap-2 mt-2">
                            <div class="aspect-square rounded-md overflow-hidden relative cursor-pointer ring-2 ring-secondary">
                                <img class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCigXYJAYmw0ahihZ1y_i-7_7yROefCwBWtD3cDsW8j6apNzz393f7JM8c1ybuu8pS76gERtVch2Z3ypIxn17ahpyDNli_-oBYO3qMzflQzTfdE-1jMZ1VG5fuuNw6D-DoUTIaVTv85bssFHD3jAFhNDIRajnzsx-1ANz2FVBy5V_zmWSnnFcQEdjclIFtS5p0M6GyJ-qmHp-e7GC_6YVLgB7EEyAYkzO1UVbrUY8F7eXQi_8ZJM2dqPQ">
                            </div>
                            <div class="aspect-square rounded-md overflow-hidden relative cursor-pointer hover:opacity-80 transition-opacity">
                                <img class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAopYlaHzISLHK6pxJc_kJivBmkWDm7Cycp4lZvXrPO20gb02vlXh0sfkT9jFKYgEkV0dy1ZcCN3xG--6ZZ9nIgcFe0YuIMI8r8OXPU7GT_fnry-JZat_zODEKsaP6AxNNXQsF8V6wnbET44aL0YMiNmkorZIJ4KP8utQ3tkdi6Vl3IhclnJLQQxbomr-N4r_DRI5C-U78cOi4lHq1558V1RX5XdwoIO-bqDfQK7Tc0SRzE7kjyikY5Og">
                            </div>
                            <div class="aspect-square rounded-md overflow-hidden relative cursor-pointer hover:opacity-80 transition-opacity">
                                <img class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAbMLki-VvI6EeEhuz1z5wSPqod6ceknbQQ57d77MpaTTiC2hlzkCE-FPE2RT6OULNqaLcDQjvYXNgE9B8j6KwqTMS2sSM5I7zTBDtj-jWojDuwvOKvCzPz5FVUOwzG0Z4Czw5FXyPA_oCHZNnOatvKdkujMSgecrynG7PAv9iakAcLDvU-Fy_YBqjacWdJoliEbIzFmZRF4DRO1Cq7_EYY9LSGKsCFUIMwxIG4AwnjCQjpC5z2P6gZSA">
                            </div>
                            <div class="aspect-square rounded-md overflow-hidden relative flex items-center justify-center bg-surface-container-high hover:bg-surface-variant transition-colors cursor-pointer border border-dashed border-outline-variant">
                                <div class="flex flex-col items-center text-on-surface-variant">
                                    <span class="material-symbols-outlined">add_photo_alternate</span>
                                    <span class="font-label-md text-[10px]">Tambah</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tab Content 2: Riwayat Penyewaan -->
            <div x-show="tab === 'riwayat'" style="display: none;" class="flex-col gap-6">
                <div class="bg-surface-container-lowest rounded-xl shadow-md overflow-hidden">
                    <!-- Filters -->
                    <div class="p-4 border-b border-outline-variant flex flex-col md:flex-row justify-between gap-4 bg-surface-container-low">
                        <div class="relative max-w-sm w-full">
                            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant">search</span>
                            <input class="w-full pl-10 pr-4 py-2 bg-surface-bright border border-outline-variant rounded-lg font-body-md text-on-surface focus:ring-2 focus:ring-secondary focus:border-transparent outline-none" placeholder="Cari ID atau Nama Penyewa..." type="text">
                        </div>
                        <div class="flex items-center gap-2">
                            <input class="px-4 py-2 bg-surface-bright border border-outline-variant rounded-lg font-body-md text-on-surface focus:ring-2 focus:ring-secondary focus:border-transparent outline-none" type="date">
                            <button class="px-4 py-2 bg-surface border border-outline-variant text-on-surface rounded-lg font-label-md text-label-md hover:bg-surface-variant transition-colors shadow-sm flex items-center gap-2">
                                <span class="material-symbols-outlined text-[18px]">filter_list</span>
                                Filter
                            </button>
                        </div>
                    </div>
                    
                    <!-- Table -->
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-surface-container-low text-on-surface-variant font-label-md text-label-md border-b border-outline-variant">
                                    <th class="p-4 font-semibold">ID Booking</th>
                                    <th class="p-4 font-semibold">Nama Penyewa</th>
                                    <th class="p-4 font-semibold">Tanggal</th>
                                    <th class="p-4 font-semibold">Jam</th>
                                    <th class="p-4 font-semibold">Status</th>
                                    <th class="p-4 font-semibold text-right">Total Bayar</th>
                                </tr>
                            </thead>
                            <tbody class="font-body-md text-on-surface">
                                <tr class="border-b border-outline-variant hover:bg-surface-container-lowest/50 transition-colors">
                                    <td class="p-4 font-medium">#BK-9021</td>
                                    <td class="p-4">Budi Santoso</td>
                                    <td class="p-4">12 Nov 2023</td>
                                    <td class="p-4">18:00 - 20:00</td>
                                    <td class="p-4"><x-admin.badge color="success" text="Selesai" /></td>
                                    <td class="p-4 text-right">Rp 300.000</td>
                                </tr>
                                <tr class="border-b border-outline-variant hover:bg-surface-container-lowest/50 transition-colors">
                                    <td class="p-4 font-medium">#BK-9044</td>
                                    <td class="p-4">Andi Wijaya</td>
                                    <td class="p-4">13 Nov 2023</td>
                                    <td class="p-4">19:00 - 21:00</td>
                                    <td class="p-4"><x-admin.badge color="warning" text="Dipesan" /></td>
                                    <td class="p-4 text-right">Rp 300.000</td>
                                </tr>
                                <tr class="border-b border-outline-variant hover:bg-surface-container-lowest/50 transition-colors">
                                    <td class="p-4 font-medium">#BK-9055</td>
                                    <td class="p-4">Citra Lestari</td>
                                    <td class="p-4">14 Nov 2023</td>
                                    <td class="p-4">16:00 - 18:00</td>
                                    <td class="p-4"><x-admin.badge color="error" text="Dibatalkan" /></td>
                                    <td class="p-4 text-right text-on-surface-variant line-through">Rp 300.000</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Pagination -->
                    <div class="p-4 border-t border-outline-variant flex justify-between items-center bg-surface-container-low">
                        <span class="font-body-md text-sm text-on-surface-variant">Menampilkan 1-3 dari 45 data</span>
                        <div class="flex gap-1">
                            <button class="p-1 rounded text-on-surface-variant hover:bg-surface-variant transition-colors disabled:opacity-50"><span class="material-symbols-outlined">chevron_left</span></button>
                            <button class="px-3 py-1 rounded bg-secondary text-on-secondary font-label-md text-sm">1</button>
                            <button class="px-3 py-1 rounded text-on-surface-variant hover:bg-surface-variant transition-colors font-label-md text-sm">2</button>
                            <button class="px-3 py-1 rounded text-on-surface-variant hover:bg-surface-variant transition-colors font-label-md text-sm">3</button>
                            <button class="p-1 rounded text-on-surface-variant hover:bg-surface-variant transition-colors"><span class="material-symbols-outlined">chevron_right</span></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
