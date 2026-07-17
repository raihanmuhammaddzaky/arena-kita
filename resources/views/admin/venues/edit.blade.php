@extends('layouts.admin')

@section('title', 'ArenaKita Admin - Edit Lapangan')

@section('content')
    <div class="max-w-container-max mx-auto">
        <!-- Breadcrumbs & Header -->
        <div class="mb-stack-lg">
            <nav class="flex items-center gap-2 text-on-surface-variant font-body-md mb-2">
                <a class="hover:text-primary transition-colors" href="{{ route('admin.venues.index') }}">Venues</a>
                <span class="material-symbols-outlined text-sm">chevron_right</span>
                <span class="text-primary font-medium">Edit: {{ $venue->name }}</span>
            </nav>
            <h2 class="font-headline-lg text-headline-lg-mobile md:text-headline-lg text-primary">Edit Lapangan</h2>
            <p class="font-body-md text-body-md text-on-surface-variant mt-1">Perbarui informasi lapangan berikut.</p>
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

        @if(session('success'))
            <div class="bg-secondary-container text-on-secondary-container px-4 py-3 rounded-xl mb-6 flex items-center gap-2">
                <span class="material-symbols-outlined">check_circle</span>
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.venues.update', $venue) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Action Buttons Top -->
            <div class="flex items-center justify-end gap-3 mb-6">
                <a href="{{ route('admin.venues.show', $venue) }}" class="px-4 py-2 rounded-lg text-on-surface-variant border border-outline-variant hover:bg-surface-container-high transition-colors font-label-md text-label-md flex items-center gap-2">
                    Batal
                </a>
                <button type="submit" class="px-4 py-2 rounded-lg bg-secondary text-on-secondary hover:bg-[#005236] transition-colors shadow-sm font-label-md text-label-md">
                    Simpan Perubahan
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
                                <input id="name" name="name" value="{{ old('name', $venue->name) }}" class="w-full bg-surface-container-low border-0 text-on-surface rounded-lg px-4 py-3 focus:ring-2 focus:ring-secondary focus:bg-surface-container-lowest transition-all" type="text" required>
                            </div>
                            <div>
                                <label for="address" class="block font-label-md text-label-md text-on-surface-variant mb-1">Alamat</label>
                                <input id="address" name="address" value="{{ old('address', $venue->address) }}" class="w-full bg-surface-container-low border-0 text-on-surface rounded-lg px-4 py-3 focus:ring-2 focus:ring-secondary focus:bg-surface-container-lowest transition-all" type="text" required>
                            </div>

                            <div>
                                <label for="description" class="block font-label-md text-label-md text-on-surface-variant mb-1">Deskripsi</label>
                                <textarea id="description" name="description" class="w-full bg-surface-container-low border-0 text-on-surface rounded-lg px-4 py-3 focus:ring-2 focus:ring-secondary focus:bg-surface-container-lowest transition-all" rows="4">{{ old('description', $venue->description) }}</textarea>
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
                                    <input id="price" name="price" value="{{ old('price', $venue->price) }}" class="w-full bg-surface-container-low border-0 text-on-surface rounded-lg pl-12 pr-4 py-3 focus:ring-2 focus:ring-secondary focus:bg-surface-container-lowest transition-all" type="number" min="0" required>
                                </div>
                            </div>
                            <div>
                                <label for="max_capacity" class="block font-label-md text-label-md text-on-surface-variant mb-1">Kapasitas Maksimal</label>
                                <div class="relative">
                                    <input id="max_capacity" name="max_capacity" value="{{ old('max_capacity', $venue->max_capacity) }}" class="w-full bg-surface-container-low border-0 text-on-surface rounded-lg pl-4 pr-16 py-3 focus:ring-2 focus:ring-secondary focus:bg-surface-container-lowest transition-all" type="number" min="1" required>
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
                        <h3 class="font-headline-md text-headline-md text-primary flex items-center gap-2 mb-6">
                            <span class="material-symbols-outlined text-secondary">image</span>
                            Media Lapangan
                        </h3>

                        <!-- Current Main Image -->
                        <div class="mb-5">
                            <label class="block font-label-md text-label-md text-on-surface-variant mb-2">Foto Utama Saat Ini</label>
                            @if($venue->mainImage)
                                <div class="aspect-video rounded-lg overflow-hidden mb-2 bg-surface-container">
                                    <img src="{{ $venue->mainImage->image_url }}" alt="{{ $venue->name }}" class="w-full h-full object-cover">
                                </div>
                            @else
                                <div class="aspect-video rounded-lg bg-surface-container-low flex items-center justify-center mb-2">
                                    <span class="text-on-surface-variant">Belum ada foto utama</span>
                                </div>
                            @endif
                            <label for="main_image" class="block text-sm text-on-surface-variant mb-1">Ganti Foto Utama (opsional)</label>
                            <input type="file" name="main_image" id="main_image" accept="image/jpeg,image/png,image/webp" class="w-full text-sm text-on-surface-variant file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-secondary-container file:text-on-secondary-container hover:file:bg-secondary-container/80 cursor-pointer">
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
