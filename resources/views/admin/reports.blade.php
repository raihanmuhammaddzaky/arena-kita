@extends('layouts.admin')

@section('title', 'ArenaKita Admin - Reports & Analytics')

@section('content')
    <div class="max-w-container-max mx-auto w-full space-y-stack-lg">
        
        <!-- Page Header Section -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-6">
            <div>
                <p class="font-label-md text-label-md text-secondary uppercase tracking-wider mb-2">Analytics Overview</p>
                <h1 class="font-headline-lg text-headline-lg-mobile md:text-headline-lg text-on-background">Financial Reports & Insights</h1>
                <p class="font-body-md text-body-md text-on-surface-variant mt-2 max-w-2xl">Monitor revenue streams, facility utilization, and booking trends across all ArenaKita venues to optimize operations.</p>
            </div>
            <button class="flex items-center gap-2 bg-secondary hover:bg-on-secondary-fixed-variant text-white px-6 py-3 rounded-xl font-label-md text-label-md transition-all shadow-sm hover:shadow-md">
                <span class="material-symbols-outlined">download</span>
                Download PDF/Excel
            </button>
        </div>

        <!-- Summary Widgets (Bento Grid Style) -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            
            <!-- Widget 1: Revenue -->
            <div class="glass-card bg-surface-container-low rounded-2xl p-6 relative overflow-hidden group shadow-sm">
                <div class="absolute -right-6 -top-6 w-32 h-32 bg-secondary/5 rounded-full blur-2xl group-hover:bg-secondary/10 transition-all"></div>
                <div class="flex justify-between items-start mb-4 relative z-10">
                    <div class="w-12 h-12 rounded-xl bg-surface-container-high flex items-center justify-center text-primary">
                        <span class="material-symbols-outlined">payments</span>
                    </div>
                    <span class="bg-secondary-container text-on-secondary-container px-3 py-1 rounded-full font-label-md text-xs flex items-center gap-1">
                        <span class="material-symbols-outlined text-[14px]">trending_up</span> +12.5%
                    </span>
                </div>
                <p class="font-label-md text-label-md text-on-surface-variant mb-1 relative z-10">Monthly Revenue</p>
                <h3 class="font-headline-lg text-headline-lg text-on-background relative z-10">Rp 142.5M</h3>
                <p class="font-body-md text-sm text-on-surface-variant mt-2 relative z-10">vs Rp 126.3M last month</p>
            </div>

            <!-- Widget 2: Total Bookings -->
            <div class="glass-card bg-surface-container-low rounded-2xl p-6 relative overflow-hidden group shadow-sm">
                <div class="absolute -right-6 -top-6 w-32 h-32 bg-primary/5 rounded-full blur-2xl group-hover:bg-primary/10 transition-all"></div>
                <div class="flex justify-between items-start mb-4 relative z-10">
                    <div class="w-12 h-12 rounded-xl bg-surface-container-high flex items-center justify-center text-primary">
                        <span class="material-symbols-outlined">calendar_month</span>
                    </div>
                    <span class="bg-secondary-container text-on-secondary-container px-3 py-1 rounded-full font-label-md text-xs flex items-center gap-1">
                        <span class="material-symbols-outlined text-[14px]">trending_up</span> +8.2%
                    </span>
                </div>
                <p class="font-label-md text-label-md text-on-surface-variant mb-1 relative z-10">Total Bookings</p>
                <h3 class="font-headline-lg text-headline-lg text-on-background relative z-10">1,248</h3>
                <p class="font-body-md text-sm text-on-surface-variant mt-2 relative z-10">142 peak hour sessions</p>
            </div>

            <!-- Widget 3: Popular Venue -->
            <div class="glass-card bg-surface-container-low rounded-2xl p-6 relative overflow-hidden group shadow-sm">
                <div class="absolute -right-6 -top-6 w-32 h-32 bg-tertiary-fixed-dim/20 rounded-full blur-2xl group-hover:bg-tertiary-fixed-dim/30 transition-all"></div>
                <div class="flex justify-between items-start mb-4 relative z-10">
                    <div class="w-12 h-12 rounded-xl bg-surface-container-high flex items-center justify-center text-primary">
                        <span class="material-symbols-outlined">stadium</span>
                    </div>
                </div>
                <p class="font-label-md text-label-md text-on-surface-variant mb-1 relative z-10">Most Popular Venue</p>
                <h3 class="font-headline-md text-headline-md text-on-background truncate relative z-10">GBK Senayan - Futsal</h3>
                <p class="font-body-md text-sm text-on-surface-variant mt-2 relative z-10">92% Utilization Rate</p>
            </div>

        </div>

        <!-- Charts Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            
            <!-- Revenue Trend Chart Placeholder -->
            <div class="glass-card bg-surface-container-low shadow-sm rounded-2xl p-6 flex flex-col h-[400px]">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="font-headline-md text-lg text-on-background">Revenue Trends (YTD)</h3>
                    <button class="p-2 text-on-surface-variant hover:bg-surface-container rounded-lg transition-colors">
                        <span class="material-symbols-outlined">more_vert</span>
                    </button>
                </div>
                <div class="flex-1 bg-surface-container-lowest rounded-xl flex items-center justify-center relative border border-surface-container-low overflow-hidden">
                    <div class="absolute inset-0 p-8 flex flex-col justify-end">
                        <div class="w-full border-b border-surface-container-high absolute bottom-[20%] left-0"></div>
                        <div class="w-full border-b border-surface-container-high absolute bottom-[40%] left-0"></div>
                        <div class="w-full border-b border-surface-container-high absolute bottom-[60%] left-0"></div>
                        <div class="w-full border-b border-surface-container-high absolute bottom-[80%] left-0"></div>
                        <svg class="w-full h-full text-secondary" preserveAspectRatio="none" viewBox="0 0 100 100">
                            <path d="M0,80 Q10,70 20,60 T40,40 T60,50 T80,20 T100,10" fill="none" stroke="currentColor" stroke-linecap="round" stroke-width="3"></path>
                            <path d="M0,100 L0,80 Q10,70 20,60 T40,40 T60,50 T80,20 T100,10 L100,100 Z" fill="currentColor" fill-opacity="0.1"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Booking Distribution Bar Chart Placeholder -->
            <div class="glass-card bg-surface-container-low shadow-sm rounded-2xl p-6 flex flex-col h-[400px]">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="font-headline-md text-lg text-on-background">Booking Distribution by Sport</h3>
                    <div class="flex gap-2">
                        <span class="inline-block w-3 h-3 rounded-full bg-secondary mt-1"></span>
                        <span class="font-label-md text-xs text-on-surface-variant">Matches</span>
                    </div>
                </div>
                <div class="flex-1 flex items-end justify-between px-4 pb-2 pt-8 relative bg-surface-container-lowest rounded-xl border border-surface-container-low">
                    <div class="w-full border-b border-surface-container-high absolute bottom-[20%] left-0"></div>
                    <div class="w-full border-b border-surface-container-high absolute bottom-[40%] left-0"></div>
                    <div class="w-full border-b border-surface-container-high absolute bottom-[60%] left-0"></div>
                    <div class="w-full border-b border-surface-container-high absolute bottom-[80%] left-0"></div>
                    
                    <div class="flex flex-col items-center gap-2 z-10 w-1/6">
                        <div class="w-full bg-secondary rounded-t-md hover:opacity-80 transition-opacity" style="height: 180px;"></div>
                        <span class="font-label-md text-xs text-on-surface-variant">Futsal</span>
                    </div>
                    <div class="flex flex-col items-center gap-2 z-10 w-1/6">
                        <div class="w-full bg-secondary-fixed-dim rounded-t-md hover:opacity-80 transition-opacity" style="height: 120px;"></div>
                        <span class="font-label-md text-xs text-on-surface-variant">Badminton</span>
                    </div>
                    <div class="flex flex-col items-center gap-2 z-10 w-1/6">
                        <div class="w-full bg-primary-fixed-dim rounded-t-md hover:opacity-80 transition-opacity" style="height: 90px;"></div>
                        <span class="font-label-md text-xs text-on-surface-variant">Tennis</span>
                    </div>
                    <div class="flex flex-col items-center gap-2 z-10 w-1/6">
                        <div class="w-full bg-tertiary-fixed-dim rounded-t-md hover:opacity-80 transition-opacity" style="height: 150px;"></div>
                        <span class="font-label-md text-xs text-on-surface-variant">Basketball</span>
                    </div>
                    <div class="flex flex-col items-center gap-2 z-10 w-1/6">
                        <div class="w-full bg-surface-tint rounded-t-md hover:opacity-80 transition-opacity" style="height: 60px;"></div>
                        <span class="font-label-md text-xs text-on-surface-variant">Swimming</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
