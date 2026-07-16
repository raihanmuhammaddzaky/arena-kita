@props(['name', 'category', 'price', 'image', 'status' => 'active'])

@php
    $isMaintenance = $status === 'maintenance';
    $cardClasses = $isMaintenance 
        ? "group bg-surface-container-lowest rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-all duration-300 flex flex-col relative border border-surface-container-highest opacity-90 grayscale-[0.2]" 
        : "group bg-surface-container-lowest rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-all duration-300 flex flex-col relative border border-transparent hover:border-surface-container-high";
        
    $imageContainerClasses = $isMaintenance ? "h-48 relative overflow-hidden bg-surface-container-highest" : "h-48 relative overflow-hidden bg-surface-container-low";
    $contentClasses = $isMaintenance ? "p-5 flex-1 flex flex-col bg-surface-container-low/50" : "p-5 flex-1 flex flex-col";
    $textTitleClass = $isMaintenance ? "font-headline-md text-[20px] font-bold text-on-surface-variant leading-tight" : "font-headline-md text-[20px] font-bold text-primary leading-tight";
    $textPriceClass = $isMaintenance ? "font-label-md text-label-md text-on-surface-variant" : "font-label-md text-label-md text-primary";
@endphp

<div class="{{ $cardClasses }}">
    <!-- Image Container -->
    <div class="{{ $imageContainerClasses }}">
        <img alt="{{ $name }}" class="w-full h-full object-cover {{ $isMaintenance ? '' : 'group-hover:scale-105 transition-transform duration-500' }}" src="{{ $image }}">
        
        @if($isMaintenance)
            <div class="absolute inset-0 bg-surface-tint/20"></div>
            <div class="absolute top-4 left-4 bg-surface-container-high/90 backdrop-blur-sm text-on-surface-variant px-3 py-1 rounded-full flex items-center shadow-sm border border-outline-variant/30">
                <span class="material-symbols-outlined text-[14px] mr-1">build</span>
                <span class="font-label-md text-[12px] uppercase tracking-wider">Maintenance</span>
            </div>
        @else
            <div class="absolute top-4 left-4 bg-secondary-container/90 backdrop-blur-sm text-on-secondary-container px-3 py-1 rounded-full flex items-center shadow-sm">
                <span class="w-2 h-2 rounded-full bg-secondary-fixed mr-2"></span>
                <span class="font-label-md text-[12px] uppercase tracking-wider">Active</span>
            </div>
        @endif
    </div>
    
    <!-- Card Content -->
    <div class="{{ $contentClasses }}">
        <div class="flex justify-between items-start mb-2">
            <div>
                <h3 class="{{ $textTitleClass }}">{{ $name }}</h3>
                <p class="text-on-surface-variant text-sm mt-1 flex items-center {{ $isMaintenance ? 'opacity-80' : '' }}">
                    <span class="material-symbols-outlined text-[16px] mr-1">category</span> {{ $category }}
                </p>
            </div>
            <div class="text-right {{ $isMaintenance ? 'opacity-80' : '' }}">
                <p class="{{ $textPriceClass }}">{{ $price }}</p>
                <p class="text-on-surface-variant text-xs">/ hour</p>
            </div>
        </div>
        
        <!-- Divider -->
        <div class="h-px w-full {{ $isMaintenance ? 'bg-outline-variant/30' : 'bg-surface-container-low' }} my-4"></div>
        
        <!-- Actions & Toggle -->
        <div class="mt-auto flex items-center justify-between">
            <div class="flex items-center space-x-3 {{ $isMaintenance ? 'opacity-60 pointer-events-none' : '' }}">
                <span class="text-sm text-on-surface-variant">{{ $isMaintenance ? 'Booking Disabled' : 'Available for Booking' }}</span>
                <!-- Custom Toggle Switch -->
                <label class="relative inline-flex items-center {{ $isMaintenance ? 'cursor-not-allowed' : 'cursor-pointer' }}">
                    <input type="checkbox" class="sr-only peer" {{ $isMaintenance ? 'disabled' : 'checked' }}>
                    <div class="w-11 h-6 bg-surface-variant {{ $isMaintenance ? '' : 'peer-focus:outline-none peer-checked:bg-secondary' }} rounded-full peer {{ $isMaintenance ? '' : 'peer-checked:after:translate-x-full peer-checked:after:border-white' }} after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 {{ $isMaintenance ? '' : 'after:transition-all' }}"></div>
                </label>
            </div>
            
            <div class="flex space-x-1">
                <button class="p-2 text-on-surface-variant hover:text-secondary hover:bg-secondary-container/20 rounded-lg transition-colors" title="Edit">
                    <span class="material-symbols-outlined text-[20px]">edit</span>
                </button>
                <button class="p-2 text-on-surface-variant hover:text-error hover:bg-error-container/50 rounded-lg transition-colors" title="Delete">
                    <span class="material-symbols-outlined text-[20px]">delete</span>
                </button>
            </div>
        </div>
    </div>
</div>
