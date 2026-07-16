@extends('layouts.admin')

@section('title', 'ArenaKita Admin - Edit Pengumuman')

@section('content')
    <div class="max-w-2xl mx-auto flex flex-col gap-stack-lg">
        <!-- Breadcrumbs & Header -->
        <div>
            <nav class="flex items-center gap-2 text-on-surface-variant font-body-md mb-2">
                <a class="hover:text-primary transition-colors" href="{{ route('admin.announcements.index') }}">Pengumuman</a>
                <span class="material-symbols-outlined text-sm">chevron_right</span>
                <span class="text-primary font-medium">Edit Pengumuman</span>
            </nav>
            <h2 class="font-headline-lg text-headline-lg-mobile md:text-headline-lg text-primary">Edit Pengumuman</h2>
            <p class="font-body-md text-body-md text-on-surface-variant mt-1">Perbarui isi pengumuman berikut.</p>
        </div>

        <!-- Validation Errors -->
        @if($errors->any())
            <div class="bg-error-container text-on-error-container px-4 py-3 rounded-xl">
                <ul class="list-disc list-inside text-sm">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(session('success'))
            <div class="bg-secondary-container text-on-secondary-container px-4 py-3 rounded-xl flex items-center gap-2">
                <span class="material-symbols-outlined">check_circle</span>
                {{ session('success') }}
            </div>
        @endif

        <!-- Form -->
        <form method="POST" action="{{ route('admin.announcements.update', $announcement) }}" class="bg-surface-container-lowest rounded-xl shadow-md p-6 flex flex-col gap-5">
            @csrf
            @method('PUT')

            <div>
                <label for="title" class="block font-label-md text-label-md text-on-surface-variant mb-1">Judul Pengumuman</label>
                <input id="title" name="title" value="{{ old('title', $announcement->title) }}" class="w-full bg-surface-container-low border-0 text-on-surface rounded-lg px-4 py-3 focus:ring-2 focus:ring-secondary focus:bg-surface-container-lowest transition-all" type="text" required>
            </div>

            <div>
                <label for="content" class="block font-label-md text-label-md text-on-surface-variant mb-1">Isi Pengumuman</label>
                <textarea id="content" name="content" rows="8" class="w-full bg-surface-container-low border-0 text-on-surface rounded-lg px-4 py-3 focus:ring-2 focus:ring-secondary focus:bg-surface-container-lowest transition-all" required>{{ old('content', $announcement->content) }}</textarea>
            </div>

            <div class="flex items-center justify-between pt-4 border-t border-outline-variant/30">
                <p class="text-xs text-on-surface-variant">Terakhir diubah: {{ $announcement->updated_at->format('d M Y, H:i') }}</p>
                <div class="flex items-center gap-3">
                    <a href="{{ route('admin.announcements.index') }}" class="px-4 py-2 rounded-lg text-on-surface-variant border border-outline-variant hover:bg-surface-container-high transition-colors font-label-md text-label-md">
                        Batal
                    </a>
                    <button type="submit" class="px-6 py-2 rounded-lg bg-secondary text-on-secondary hover:bg-[#005236] transition-colors shadow-sm font-label-md text-label-md flex items-center gap-2">
                        <span class="material-symbols-outlined text-[20px]">save</span>
                        Simpan Perubahan
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
