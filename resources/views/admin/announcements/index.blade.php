@extends('layouts.admin')

@section('title', 'ArenaKita Admin - Pengumuman')

@section('content')
    <div class="max-w-container-max mx-auto flex flex-col gap-stack-lg">
        <!-- Page Header & Actions -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <x-admin.page-header 
                title="Pengumuman" 
                subtitle="Kelola informasi dan pengumuman untuk seluruh pengguna platform." 
            />
            <a href="{{ route('admin.announcements.create') }}" class="flex items-center gap-2 bg-secondary text-on-secondary px-5 py-3 rounded-xl font-label-md text-label-md shadow-sm hover:shadow-md transition-all">
                <span class="material-symbols-outlined text-[20px]">add</span>
                Tambah Pengumuman
            </a>
        </div>

        <!-- Flash Messages -->
        @if(session('success'))
            <div class="bg-secondary-container text-on-secondary-container px-4 py-3 rounded-xl flex items-center gap-2">
                <span class="material-symbols-outlined">check_circle</span>
                {{ session('success') }}
            </div>
        @endif

        <!-- Search -->
        <form method="GET" action="{{ route('admin.announcements.index') }}" class="flex items-center gap-3">
            <div class="relative flex-1 max-w-md">
                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant">search</span>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari pengumuman..." class="w-full bg-surface-container-low border-none rounded-xl pl-10 pr-4 py-3 text-sm focus:ring-2 focus:ring-secondary-container text-on-surface transition-all shadow-sm">
            </div>
            <button type="submit" class="bg-surface-container-high text-primary px-4 py-3 rounded-xl font-label-md text-label-md hover:bg-surface-variant transition-all">
                Cari
            </button>
        </form>

        <!-- Announcements Table -->
        <div class="bg-surface rounded-2xl shadow-md overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-surface-container-highest bg-surface-container-low/50">
                            <th class="py-4 px-6 font-label-md text-label-md text-on-surface-variant w-8">#</th>
                            <th class="py-4 px-6 font-label-md text-label-md text-on-surface-variant">Judul</th>
                            <th class="py-4 px-6 font-label-md text-label-md text-on-surface-variant max-w-md">Isi (Preview)</th>
                            <th class="py-4 px-6 font-label-md text-label-md text-on-surface-variant">Tanggal</th>
                            <th class="py-4 px-6 font-label-md text-label-md text-on-surface-variant text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-surface-container-highest">
                        @forelse($announcements as $index => $announcement)
                            <tr class="hover:bg-surface-container-low transition-colors group">
                                <td class="py-4 px-6 text-sm text-on-surface-variant">{{ $announcements->firstItem() + $index }}</td>
                                <td class="py-4 px-6">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-full bg-primary-container flex items-center justify-center shrink-0">
                                            <span class="material-symbols-outlined text-on-primary-container text-[20px]">campaign</span>
                                        </div>
                                        <span class="font-label-md text-label-md text-on-surface">{{ $announcement->title }}</span>
                                    </div>
                                </td>
                                <td class="py-4 px-6 text-sm text-on-surface-variant max-w-md">
                                    <p class="truncate">{{ Str::limit($announcement->content, 80) }}</p>
                                </td>
                                <td class="py-4 px-6 text-sm text-on-surface-variant whitespace-nowrap">{{ $announcement->created_at->format('d M Y, H:i') }}</td>
                                <td class="py-4 px-6 text-right">
                                    <div class="flex items-center justify-end gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                        <a href="{{ route('admin.announcements.edit', $announcement) }}" class="p-2 text-on-surface-variant hover:text-primary hover:bg-surface-container-highest rounded-lg transition-colors" title="Edit">
                                            <span class="material-symbols-outlined text-sm">edit</span>
                                        </a>
                                        <form action="{{ route('admin.announcements.destroy', $announcement) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus pengumuman ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 text-on-surface-variant hover:text-error hover:bg-error-container rounded-lg transition-colors" title="Hapus">
                                                <span class="material-symbols-outlined text-sm">delete</span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-12 text-center text-on-surface-variant">
                                    <span class="material-symbols-outlined text-5xl mb-4 block">campaign</span>
                                    <p class="text-lg">Belum ada pengumuman.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($announcements->hasPages())
                <div class="p-4 border-t border-surface-container-highest bg-surface/50">
                    {{ $announcements->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
