@extends('layouts.admin')

@section('title', 'ArenaKita Admin - Tambah Pengumuman')

@section('content')
    <div class="max-w-2xl mx-auto flex flex-col gap-stack-lg">
        <!-- Breadcrumbs & Header -->
        <div>
            <nav class="flex items-center gap-2 text-on-surface-variant font-body-md mb-2">
                <a class="hover:text-primary transition-colors" href="{{ route('admin.announcements.index') }}">Pengumuman</a>
                <span class="material-symbols-outlined text-sm">chevron_right</span>
                <span class="text-primary font-medium">Tambah Pengumuman</span>
            </nav>
            <h2 class="font-headline-lg text-headline-lg-mobile md:text-headline-lg text-primary">Tambah Pengumuman Baru</h2>
            <p class="font-body-md text-body-md text-on-surface-variant mt-1">Buat pengumuman yang akan terlihat oleh seluruh pengguna.</p>
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

        <!-- Form -->
        <form method="POST" action="{{ route('admin.announcements.store') }}" class="bg-surface-container-lowest rounded-xl shadow-md p-6 flex flex-col gap-5">
            @csrf

            <div>
                <label for="title" class="block font-label-md text-label-md text-on-surface-variant mb-1">Judul Pengumuman</label>
                <input id="title" name="title" value="{{ old('title') }}" class="w-full bg-surface-container-low border-0 text-on-surface rounded-lg px-4 py-3 focus:ring-2 focus:ring-secondary focus:bg-surface-container-lowest transition-all" placeholder="Misal: Jadwal Pemeliharaan Lapangan" type="text" required>
            </div>

            <div>
                <label for="content" class="block font-label-md text-label-md text-on-surface-variant mb-1">Isi Pengumuman</label>
                <textarea id="content" name="content" rows="8" class="w-full bg-surface-container-low border-0 text-on-surface rounded-lg px-4 py-3 focus:ring-2 focus:ring-secondary focus:bg-surface-container-lowest transition-all" placeholder="Tulis isi pengumuman secara detail..." required>{{ old('content') }}</textarea>
            </div>

            <div class="flex items-center justify-end gap-3 pt-4 border-t border-outline-variant/30">
                <a href="{{ route('admin.announcements.index') }}" class="px-4 py-2 rounded-lg text-on-surface-variant border border-outline-variant hover:bg-surface-container-high transition-colors font-label-md text-label-md">
                    Batal
                </a>
                <button type="submit" class="px-6 py-2 rounded-lg bg-secondary text-on-secondary hover:bg-[#005236] transition-colors shadow-sm font-label-md text-label-md flex items-center gap-2">
                    <span class="material-symbols-outlined text-[20px]">save</span>
                    Simpan Pengumuman
                </button>
            </div>
        </form>
    </div>
@endsection
