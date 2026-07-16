@extends('layouts.admin')

@section('title', 'ArenaKita Admin - Tambah Lapangan')

@section('content')
    <div class="max-w-container-max mx-auto">
        <!-- Breadcrumbs & Header -->
        <div class="mb-stack-lg">
            <nav class="flex items-center gap-2 text-on-surface-variant font-body-md mb-2">
                <a class="hover:text-primary transition-colors" href="{{ route('admin.venues.index') }}">Venues</a>
                <span class="material-symbols-outlined text-sm">chevron_right</span>
                <span class="text-primary font-medium">Tambah Lapangan</span>
            </nav>
            <h2 class="font-headline-lg text-headline-lg-mobile md:text-headline-lg text-primary">Tambah Lapangan Baru</h2>
            <p class="font-body-md text-body-md text-on-surface-variant mt-1">Masukkan informasi detail untuk menambahkan lapangan baru ke dalam sistem.</p>
        </div>

        <!-- Validation Errors -->
        @if($errors->any())
            <div class="bg-error-container text-on-error-container px-4 py-3 rounded-xl mb-6">
                <ul class="list-disc list-inside text-sm">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.venues.store') }}" enctype="multipart/form-data">
            @csrf

            <!-- Action Buttons Top -->
            <div class="flex items-center justify-end gap-3 mb-6">
                <a href="{{ route('admin.venues.index') }}" class="px-4 py-2 rounded-lg text-on-surface-variant border border-outline-variant hover:bg-surface-container-high transition-colors font-label-md text-label-md flex items-center gap-2">
                    Batal
                </a>
                <button type="submit" class="px-4 py-2 rounded-lg bg-secondary text-on-secondary hover:bg-[#005236] transition-colors shadow-sm font-label-md text-label-md">
                    Simpan Lapangan
                </button>
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
                                <label for="name" class="block font-label-md text-label-md text-on-surface-variant mb-1">Nama Lapangan</label>
                                <input id="name" name="name" value="{{ old('name') }}" class="w-full bg-surface-container-low border-0 text-on-surface rounded-lg px-4 py-3 focus:ring-2 focus:ring-secondary focus:bg-surface-container-lowest transition-all" placeholder="Misal: Lapangan Badminton VIP 1" type="text" required>
                            </div>
                            <div>
                                <label for="address" class="block font-label-md text-label-md text-on-surface-variant mb-1">Alamat</label>
                                <input id="address" name="address" value="{{ old('address') }}" class="w-full bg-surface-container-low border-0 text-on-surface rounded-lg px-4 py-3 focus:ring-2 focus:ring-secondary focus:bg-surface-container-lowest transition-all" placeholder="Alamat lengkap lapangan" type="text" required>
                            </div>

                            <div>
                                <label for="description" class="block font-label-md text-label-md text-on-surface-variant mb-1">Deskripsi</label>
                                <textarea id="description" name="description" class="w-full bg-surface-container-low border-0 text-on-surface rounded-lg px-4 py-3 focus:ring-2 focus:ring-secondary focus:bg-surface-container-lowest transition-all" placeholder="Jelaskan fasilitas dan fitur lapangan..." rows="4">{{ old('description') }}</textarea>
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
                                <label for="price" class="block font-label-md text-label-md text-on-surface-variant mb-1">Harga per Jam (Rp)</label>
                                <div class="relative">
                                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant font-body-md">Rp</span>
                                    <input id="price" name="price" value="{{ old('price') }}" class="w-full bg-surface-container-low border-0 text-on-surface rounded-lg pl-12 pr-4 py-3 focus:ring-2 focus:ring-secondary focus:bg-surface-container-lowest transition-all" placeholder="0" type="number" min="0" required>
                                </div>
                            </div>
                            <div>
                                <label for="max_capacity" class="block font-label-md text-label-md text-on-surface-variant mb-1">Kapasitas Maksimal</label>
                                <div class="relative">
                                    <input id="max_capacity" name="max_capacity" value="{{ old('max_capacity') }}" class="w-full bg-surface-container-low border-0 text-on-surface rounded-lg pl-4 pr-16 py-3 focus:ring-2 focus:ring-secondary focus:bg-surface-container-lowest transition-all" placeholder="0" type="number" min="1" required>
                                    <span class="absolute right-4 top-1/2 -translate-y-1/2 text-on-surface-variant font-body-md">Orang</span>
                                </div>
                            </div>
                            <!-- Hidden input for standard 1 hour duration -->
                            <input type="hidden" name="time_unit_minutes" value="60">
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

                        <!-- Cover Image -->
                        <div class="mb-5">
                            <label for="main_image" class="block font-label-md text-label-md text-on-surface-variant mb-2">Foto Utama *</label>
                            <div class="relative">
                                <input type="file" name="main_image" id="main_image" accept="image/jpeg,image/png,image/webp" class="w-full text-sm text-on-surface-variant file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-secondary-container file:text-on-secondary-container hover:file:bg-secondary-container/80 cursor-pointer" required>
                            </div>
                            <p class="text-xs text-on-surface-variant mt-1">JPG, PNG, WebP. Max 5MB.</p>
                        </div>

                        <!-- Gallery -->
                        <div class="space-y-4">
                            <div class="flex items-center justify-between mb-2">
                                <label class="block font-label-md text-label-md text-on-surface-variant">Galeri Lapangan (Opsional)</label>
                            </div>
                            
                            @for($i = 1; $i <= 4; $i++)
                                <div>
                                    <label class="block text-sm text-on-surface-variant mb-1">Foto Tambahan {{ $i }}</label>
                                    <input type="file" name="gallery_images[]" accept="image/jpeg,image/png,image/webp" class="w-full text-sm text-on-surface-variant file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-surface-container-high file:text-on-surface hover:file:bg-surface-variant cursor-pointer">
                                </div>
                            @endfor
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="mt-stack-lg border-t border-outline-variant/30 pt-6 flex justify-start">
                <a href="{{ route('admin.venues.index') }}" class="text-on-surface-variant hover:text-primary transition-colors font-label-md text-label-md flex items-center gap-2">
                    <span class="material-symbols-outlined">arrow_back</span>
                    Kembali ke Daftar Lapangan
                </a>
            </div>
        </form>
    </div>
@endsection
