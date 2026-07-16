@extends('layouts.admin')

@section('title', 'ArenaKita Admin - Venues')

@section('content')
    <div class="max-w-container-max mx-auto space-y-stack-lg">
        <!-- Page Header & Actions -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h1 class="font-headline-lg-mobile md:font-headline-lg text-headline-lg-mobile md:text-headline-lg text-primary tracking-tight">Master Data: Venues</h1>
                <p class="text-on-surface-variant mt-2 max-w-2xl">Manage your facility's courts and spaces. Control availability, pricing, and maintenance schedules to ensure a premium experience.</p>
            </div>
            <div class="flex shrink-0">
                <a href="{{ route('admin.venues.create') }}" class="flex items-center justify-center space-x-2 bg-secondary-container text-on-secondary-container px-6 py-3 rounded-xl font-label-md text-label-md shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all duration-200">
                    <span class="material-symbols-outlined text-[20px]">add</span>
                    <span>Add New Venue</span>
                </a>
            </div>
        </div>

        <!-- Flash Messages -->
        @if(session('success'))
            <div class="bg-secondary-container text-on-secondary-container px-4 py-3 rounded-xl flex items-center gap-2">
                <span class="material-symbols-outlined">check_circle</span>
                {{ session('success') }}
            </div>
        @endif

        <!-- Filters & Controls -->
        <form method="GET" action="{{ route('admin.venues.index') }}" class="flex flex-wrap items-center gap-3 pb-4 border-b border-surface-container-highest">
            <div class="flex-1 max-w-md relative group">
                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant group-focus-within:text-secondary transition-colors">search</span>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search venues by name..." class="w-full bg-surface-container-low border-none rounded-xl py-2.5 pl-10 pr-4 text-on-surface font-body-md focus:ring-2 focus:ring-secondary-container transition-all shadow-sm hover:shadow-md">
            </div>
            <div class="flex items-center space-x-2">
                <select name="status" class="bg-surface-container-low border-none rounded-lg text-on-surface font-body-md text-body-md focus:ring-2 focus:ring-secondary-container cursor-pointer py-2 pl-3 pr-8" onchange="this.form.submit()">
                    <option value="">All Status</option>
                    <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
            <div class="ml-auto flex items-center space-x-2">
                <span class="text-sm text-on-surface-variant mr-2">Sort by:</span>
                <select name="sort" class="bg-surface-container-low border-none rounded-lg text-on-surface font-body-md text-body-md focus:ring-2 focus:ring-secondary-container cursor-pointer py-2 pl-3 pr-8" onchange="this.form.submit()">
                    <option value="name_asc" {{ request('sort') === 'name_asc' ? 'selected' : '' }}>Name (A-Z)</option>
                    <option value="price_desc" {{ request('sort') === 'price_desc' ? 'selected' : '' }}>Price (High to Low)</option>
                    <option value="price_asc" {{ request('sort') === 'price_asc' ? 'selected' : '' }}>Price (Low to High)</option>
                </select>
            </div>
        </form>

        <!-- Venue Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
            @forelse($venues as $venue)
                <div class="bg-surface-container-lowest rounded-xl shadow-md overflow-hidden group hover:shadow-lg transition-all duration-200">
                    <!-- Image -->
                    <div class="aspect-video relative overflow-hidden bg-surface-container">
                        @if($venue->mainImage)
                            <img src="{{ asset('storage/' . $venue->mainImage->image_path) }}" alt="{{ $venue->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-on-surface-variant">
                                <span class="material-symbols-outlined text-5xl">stadium</span>
                            </div>
                        @endif
                        <div class="absolute top-3 right-3">
                            <x-admin.badge 
                                :color="$venue->is_active ? 'success' : 'error'" 
                                :text="$venue->is_active ? 'Aktif' : 'Nonaktif'" 
                            />
                        </div>
                    </div>
                    <!-- Info -->
                    <div class="p-5">
                        <h3 class="font-headline-md text-[18px] text-primary mb-1 truncate">{{ $venue->name }}</h3>
                        <p class="text-sm text-on-surface-variant mb-3 truncate">{{ $venue->address }}</p>
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-secondary font-label-md text-label-md">Rp {{ number_format($venue->price, 0, ',', '.') }} <span class="text-on-surface-variant font-normal text-xs">/ {{ $venue->time_unit_minutes }} menit</span></span>
                            <span class="text-xs text-on-surface-variant flex items-center gap-1">
                                <span class="material-symbols-outlined text-[16px]">group</span>
                                Max {{ $venue->max_capacity }}
                            </span>
                        </div>
                        <div class="flex items-center gap-2">
                            <a href="{{ route('admin.venues.show', $venue) }}" class="flex-1 text-center py-2 bg-surface-container-high text-primary rounded-lg font-label-md text-label-md hover:bg-surface-variant transition-colors text-sm">Detail</a>
                            <a href="{{ route('admin.venues.edit', $venue) }}" class="flex-1 text-center py-2 bg-secondary-container text-on-secondary-container rounded-lg font-label-md text-label-md hover:shadow-md transition-all text-sm">Edit</a>
                            <form action="{{ route('admin.venues.destroy', $venue) }}" method="POST" onsubmit="return confirm('Nonaktifkan venue ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 text-on-surface-variant hover:text-error hover:bg-error-container rounded-lg transition-colors" title="Nonaktifkan">
                                    <span class="material-symbols-outlined text-[20px]">delete</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-12 text-center text-on-surface-variant">
                    <span class="material-symbols-outlined text-5xl mb-4 block">stadium</span>
                    <p class="text-lg">Belum ada data lapangan.</p>
                    <a href="{{ route('admin.venues.create') }}" class="mt-4 inline-flex items-center gap-2 bg-secondary text-on-secondary px-6 py-3 rounded-xl font-label-md">
                        <span class="material-symbols-outlined">add</span>Tambah Lapangan Pertama
                    </a>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $venues->links() }}
        </div>
    </div>
@endsection
