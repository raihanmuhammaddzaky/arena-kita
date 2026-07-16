@extends('layouts.admin')

@section('title', 'ArenaKita Admin - Tambah Lapangan')

@section('content')
    <div class="max-w-[container-max] mx-auto">
        <!-- Breadcrumbs & Header -->
        <div class="mb-stack-lg">
            <nav class="flex items-center gap-2 text-on-surface-variant font-body-md mb-2">
                <a class="hover:text-primary transition-colors" href="#">Venues</a>
                <span class="material-symbols-outlined text-sm">chevron_right</span>
                <span class="text-primary font-medium">Tambah Lapangan</span>
            </nav>
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <h2 class="font-headline-lg text-headline-lg-mobile md:text-headline-lg text-primary">Tambah Lapangan Baru</h2>
                    <p class="font-body-md text-body-md text-on-surface-variant mt-1">Masukkan informasi detail untuk menambahkan lapangan baru ke dalam sistem.</p>
                </div>
                <div class="flex items-center gap-3">
                    <button class="px-4 py-2 rounded-lg text-on-surface-variant border border-outline-variant hover:bg-surface-container-high transition-colors font-label-md text-label-md flex items-center gap-2">
                        Batal
                    </button>
                    <button class="px-4 py-2 rounded-lg bg-secondary text-on-secondary hover:bg-[#005236] transition-colors shadow-sm font-label-md text-label-md">
                        Simpan Lapangan
                    </button>
                </div>
            </div>
        </div>

        <!-- Bento Layout for Content -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-gutter">
            
            <!-- Left Column: Forms -->
            <div class="lg:col-span-2 flex flex-col gap-gutter">
                
                <!-- Basic Information Card -->
                <div class="bg-surface-container-lowest rounded-xl shadow-sm p-6">
                    <h3 class="font-headline-md text-headline-md text-primary mb-6 flex items-center gap-2">
                        <span class="material-symbols-outlined text-secondary">info</span>
                        Informasi Dasar
                    </h3>
                    
                    <div class="space-y-5">
                        <div>
                            <label class="block font-label-md text-label-md text-on-surface-variant mb-1">Nama Lapangan</label>
                            <input class="w-full bg-surface-container-low border-0 text-on-surface rounded-lg px-4 py-3 focus:ring-2 focus:ring-secondary focus:bg-surface-container-lowest transition-all" placeholder="Misal: Lapangan Badminton VIP 1" type="text" value="">
                        </div>
                        <div>
                            <label class="block font-label-md text-label-md text-on-surface-variant mb-1">Ubah Status Lapangan</label>
                            <select class="w-full bg-surface-container-low border-0 text-on-surface rounded-lg px-4 py-3 focus:ring-2 focus:ring-secondary focus:bg-surface-container-lowest transition-all appearance-none cursor-pointer">
                                <option selected value="Aktif">Aktif</option>
                                <option value="Maintenance">Maintenance</option>
                                <option value="Ditutup">Ditutup</option>
                            </select>
                        </div>
                        <div>
                            <label class="block font-label-md text-label-md text-on-surface-variant mb-1">Deskripsi</label>
                            <textarea class="w-full bg-surface-container-low border-0 text-on-surface rounded-lg px-4 py-3 focus:ring-2 focus:ring-secondary focus:bg-surface-container-lowest transition-all" placeholder="Jelaskan fasilitas dan fitur lapangan..." rows="4"></textarea>
                        </div>
                    </div>
                </div>

                <!-- Pricing & Capacity Card -->
                <div class="bg-surface-container-lowest rounded-xl shadow-sm p-6">
                    <h3 class="font-headline-md text-headline-md text-primary mb-6 flex items-center gap-2">
                        <span class="material-symbols-outlined text-secondary">sell</span>
                        Harga & Kapasitas
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block font-label-md text-label-md text-on-surface-variant mb-1">Harga per Sesi (Rp)</label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant font-body-md">Rp</span>
                                <input class="w-full bg-surface-container-low border-0 text-on-surface rounded-lg pl-12 pr-4 py-3 focus:ring-2 focus:ring-secondary focus:bg-surface-container-lowest transition-all" placeholder="0" type="number" value="">
                            </div>
                        </div>
                        <div>
                            <label class="block font-label-md text-label-md text-on-surface-variant mb-1">Kapasitas Maksimal</label>
                            <div class="relative">
                                <input class="w-full bg-surface-container-low border-0 text-on-surface rounded-lg pl-4 pr-16 py-3 focus:ring-2 focus:ring-secondary focus:bg-surface-container-lowest transition-all" placeholder="0" type="number" value="">
                                <span class="absolute right-4 top-1/2 -translate-y-1/2 text-on-surface-variant font-body-md">Orang</span>
                            </div>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block font-label-md text-label-md text-on-surface-variant mb-1">Durasi Sewa Standar</label>
                            <select class="w-full bg-surface-container-low border-0 text-on-surface rounded-lg px-4 py-3 focus:ring-2 focus:ring-secondary focus:bg-surface-container-lowest transition-all appearance-none cursor-pointer">
                                <option selected value="1">1 Jam</option>
                                <option value="1.5">1.5 Jam</option>
                                <option value="2">2 Jam</option>
                                <option value="2.5">2.5 Jam</option>
                                <option value="3">3 Jam</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Media -->
            <div class="flex flex-col gap-gutter">
                <div class="bg-surface-container-lowest rounded-xl shadow-sm p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="font-headline-md text-headline-md text-primary flex items-center gap-2">
                            <span class="material-symbols-outlined text-secondary">image</span>
                            Media Lapangan
                        </h3>
                    </div>

                    <!-- Cover Image Placeholder -->
                    <div class="mb-5 relative group">
                        <label class="block font-label-md text-label-md text-on-surface-variant mb-2">Foto Utama</label>
                        <div class="aspect-video rounded-lg overflow-hidden relative bg-surface-container-low border-2 border-dashed border-outline-variant hover:border-secondary transition-colors flex flex-col items-center justify-center cursor-pointer">
                            <span class="material-symbols-outlined text-4xl text-secondary mb-2">add_a_photo</span>
                            <p class="font-label-md text-label-md text-primary">Add Main Photo</p>
                            <p class="text-sm text-on-surface-variant mt-1">PNG, JPG up to 5MB</p>
                        </div>
                    </div>

                    <!-- Gallery Placeholders -->
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <label class="block font-label-md text-label-md text-on-surface-variant">Galeri</label>
                            <span class="text-xs text-on-surface-variant">0/3 Foto</span>
                        </div>
                        <div class="grid grid-cols-3 gap-3">
                            <button class="aspect-square rounded-lg border-2 border-dashed border-outline-variant hover:border-secondary hover:bg-secondary/5 transition-colors flex flex-col items-center justify-center text-on-surface-variant hover:text-secondary gap-1">
                                <span class="material-symbols-outlined">add</span>
                            </button>
                            <button class="aspect-square rounded-lg border-2 border-dashed border-outline-variant hover:border-secondary hover:bg-secondary/5 transition-colors flex flex-col items-center justify-center text-on-surface-variant hover:text-secondary gap-1">
                                <span class="material-symbols-outlined">add</span>
                            </button>
                            <button class="aspect-square rounded-lg border-2 border-dashed border-outline-variant hover:border-secondary hover:bg-secondary/5 transition-colors flex flex-col items-center justify-center text-on-surface-variant hover:text-secondary gap-1">
                                <span class="material-symbols-outlined">add</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="mt-stack-lg border-t border-outline-variant/30 pt-6 flex justify-start">
            <button class="text-on-surface-variant hover:text-primary transition-colors font-label-md text-label-md flex items-center gap-2">
                <span class="material-symbols-outlined">arrow_back</span>
                Kembali ke Daftar Lapangan
            </button>
        </div>
    </div>
@endsection
