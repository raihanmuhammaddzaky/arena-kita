@extends('layouts.admin')

@section('title', 'ArenaKita Admin - Booking Management')

@section('content')
    <div class="max-w-container-max mx-auto flex flex-col gap-stack-lg">
        <!-- Page Header & Actions -->
        <section class="flex flex-col md:flex-row justify-between items-start md:items-end gap-stack-md">
            <div>
                <h1 class="font-headline-lg-mobile md:font-headline-lg text-headline-lg-mobile md:text-headline-lg text-on-background mb-2">Booking Management</h1>
                <p class="font-body-lg text-body-lg text-on-surface-variant max-w-2xl">Review, approve, and manage all arena reservations.</p>
            </div>
            <div class="flex items-center gap-3 bg-surface-container-low p-1 rounded-xl shadow-sm border border-surface-variant/50">
                <button class="px-4 py-2 rounded-lg bg-surface shadow-sm font-label-md text-label-md text-primary flex items-center gap-2 transition-all">
                    <span class="material-symbols-outlined text-[20px]">list</span>
                    List
                </button>
                <button class="px-4 py-2 rounded-lg hover:bg-surface-container-highest font-label-md text-label-md text-on-surface-variant flex items-center gap-2 transition-all">
                    <span class="material-symbols-outlined text-[20px]">calendar_view_month</span>
                    Calendar
                </button>
            </div>
        </section>

        <!-- Filters Bento -->
        <section class="bg-surface-container-lowest rounded-[24px] shadow-sm p-6 flex flex-col xl:flex-row gap-6 relative overflow-hidden">
            <!-- Decorative Motif Background -->
            <div class="absolute -bottom-24 -right-24 w-64 h-64 bg-secondary-container/10 rounded-full blur-3xl pointer-events-none"></div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 flex-grow z-10">
                <!-- Date Range -->
                <div class="flex flex-col gap-2">
                    <label class="font-label-md text-label-md text-on-surface-variant px-1">Date Range</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant">calendar_today</span>
                        <input class="w-full pl-10 pr-4 py-3 bg-surface-container-low border-none rounded-xl font-body-md text-body-md focus:ring-2 focus:ring-secondary-container outline-none transition-all cursor-pointer" placeholder="Oct 12 - Oct 19, 2023" type="text">
                    </div>
                </div>

                <!-- Status Filter -->
                <div class="flex flex-col gap-2">
                    <label class="font-label-md text-label-md text-on-surface-variant px-1">Status</label>
                    <div class="relative">
                        <select class="w-full pl-4 pr-10 py-3 bg-surface-container-low border-none rounded-xl font-body-md text-body-md focus:ring-2 focus:ring-secondary-container outline-none transition-all appearance-none cursor-pointer text-on-background">
                            <option value="all">All Statuses</option>
                            <option value="pending">Pending Payment</option>
                            <option value="confirmed">Confirmed</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                        <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-on-surface-variant pointer-events-none">expand_more</span>
                    </div>
                </div>

                <!-- Venue Filter -->
                <div class="flex flex-col gap-2">
                    <label class="font-label-md text-label-md text-on-surface-variant px-1">Venue</label>
                    <div class="relative">
                        <select class="w-full pl-4 pr-10 py-3 bg-surface-container-low border-none rounded-xl font-body-md text-body-md focus:ring-2 focus:ring-secondary-container outline-none transition-all appearance-none cursor-pointer text-on-background">
                            <option value="all">All Venues</option>
                            <option value="court1">Premium Tennis Court 1</option>
                            <option value="court2">Clay Court 2</option>
                            <option value="indoor">Indoor Futsal Arena</option>
                        </select>
                        <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-on-surface-variant pointer-events-none">expand_more</span>
                    </div>
                </div>
            </div>

            <div class="flex items-end z-10 pt-2 xl:pt-0">
                <button class="h-[48px] px-6 bg-surface-container-high hover:bg-surface-variant text-primary rounded-xl font-label-md text-label-md flex items-center gap-2 transition-all whitespace-nowrap w-full xl:w-auto justify-center">
                    <span class="material-symbols-outlined text-[20px]">filter_list</span>
                    More Filters
                </button>
            </div>
        </section>

        <!-- Data Table Area -->
        <section class="bg-surface-container-lowest rounded-[24px] shadow-sm overflow-hidden border border-surface-variant/30">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-surface-container-low/50 border-b border-surface-variant">
                            <th class="py-4 px-6 font-label-md text-label-md text-on-surface-variant font-semibold whitespace-nowrap">Booking ID</th>
                            <th class="py-4 px-6 font-label-md text-label-md text-on-surface-variant font-semibold">User</th>
                            <th class="py-4 px-6 font-label-md text-label-md text-on-surface-variant font-semibold">Venue</th>
                            <th class="py-4 px-6 font-label-md text-label-md text-on-surface-variant font-semibold">Date & Time</th>
                            <th class="py-4 px-6 font-label-md text-label-md text-on-surface-variant font-semibold text-right">Amount</th>
                            <th class="py-4 px-6 font-label-md text-label-md text-on-surface-variant font-semibold">Status</th>
                            <th class="py-4 px-6 font-label-md text-label-md text-on-surface-variant font-semibold text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="font-body-md text-body-md divide-y divide-surface-variant/50">
                        <!-- Row 1: Pending -->
                        <tr class="hover:bg-surface-container-low/30 transition-colors group">
                            <td class="py-5 px-6 font-mono text-sm text-on-surface-variant group-hover:text-primary transition-colors">#BKG-8821</td>
                            <td class="py-5 px-6">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-surface-container-highest flex items-center justify-center text-primary font-bold text-xs">AJ</div>
                                    <span class="font-semibold text-on-background">Alex Johnson</span>
                                </div>
                            </td>
                            <td class="py-5 px-6 text-on-surface-variant">Premium Tennis Court 1</td>
                            <td class="py-5 px-6 text-on-surface-variant">
                                <div class="flex flex-col">
                                    <span class="">Oct 14, 2023</span>
                                    <span class="text-sm opacity-70">18:00 - 20:00</span>
                                </div>
                            </td>
                            <td class="py-5 px-6 text-right font-semibold text-on-background">$120.00</td>
                            <td class="py-5 px-6">
                                <x-admin.badge color="warning" text="Pending Payment" />
                            </td>
                            <td class="py-5 px-6 text-right">
                                <div class="flex justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <button class="w-8 h-8 rounded-lg flex items-center justify-center text-secondary hover:bg-secondary-container/50 transition-colors tooltip-trigger" title="Approve Payment">
                                        <span class="material-symbols-outlined text-[20px]">check_circle</span>
                                    </button>
                                    <button class="w-8 h-8 rounded-lg flex items-center justify-center text-error hover:bg-error-container/50 transition-colors tooltip-trigger" title="Cancel Booking">
                                        <span class="material-symbols-outlined text-[20px]">cancel</span>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- Row 2: Confirmed -->
                        <tr class="hover:bg-surface-container-low/30 transition-colors group">
                            <td class="py-5 px-6 font-mono text-sm text-on-surface-variant group-hover:text-primary transition-colors">#BKG-8820</td>
                            <td class="py-5 px-6">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-surface-container-highest flex items-center justify-center text-primary font-bold text-xs">MR</div>
                                    <span class="font-semibold text-on-background">Maria Rodriguez</span>
                                </div>
                            </td>
                            <td class="py-5 px-6 text-on-surface-variant">Indoor Futsal Arena</td>
                            <td class="py-5 px-6 text-on-surface-variant">
                                <div class="flex flex-col">
                                    <span class="">Oct 14, 2023</span>
                                    <span class="text-sm opacity-70">20:00 - 22:00</span>
                                </div>
                            </td>
                            <td class="py-5 px-6 text-right font-semibold text-on-background">$180.00</td>
                            <td class="py-5 px-6">
                                <x-admin.badge color="success" text="Confirmed" />
                            </td>
                            <td class="py-5 px-6 text-right">
                                <div class="flex justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <button class="w-8 h-8 rounded-lg flex items-center justify-center text-on-surface-variant hover:bg-surface-container-highest transition-colors tooltip-trigger" title="View Details">
                                        <span class="material-symbols-outlined text-[20px]">visibility</span>
                                    </button>
                                    <button class="w-8 h-8 rounded-lg flex items-center justify-center text-error hover:bg-error-container/50 transition-colors tooltip-trigger" title="Cancel Booking">
                                        <span class="material-symbols-outlined text-[20px]">cancel</span>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- Row 3: Cancelled -->
                        <tr class="hover:bg-surface-container-low/30 transition-colors group opacity-70">
                            <td class="py-5 px-6 font-mono text-sm text-on-surface-variant">#BKG-8815</td>
                            <td class="py-5 px-6">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-surface-container-highest flex items-center justify-center text-primary font-bold text-xs">TC</div>
                                    <span class="font-semibold text-on-background">Tom Chen</span>
                                </div>
                            </td>
                            <td class="py-5 px-6 text-on-surface-variant line-through">Clay Court 2</td>
                            <td class="py-5 px-6 text-on-surface-variant">
                                <div class="flex flex-col">
                                    <span class="line-through">Oct 13, 2023</span>
                                    <span class="text-sm opacity-70 line-through">14:00 - 16:00</span>
                                </div>
                            </td>
                            <td class="py-5 px-6 text-right font-semibold text-on-background">$90.00</td>
                            <td class="py-5 px-6">
                                <x-admin.badge color="error" text="Cancelled" />
                            </td>
                            <td class="py-5 px-6 text-right">
                                <div class="flex justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <button class="w-8 h-8 rounded-lg flex items-center justify-center text-on-surface-variant hover:bg-surface-container-highest transition-colors tooltip-trigger" title="View Details">
                                        <span class="material-symbols-outlined text-[20px]">visibility</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Pagination Footer -->
            <div class="px-6 py-4 border-t border-surface-variant flex items-center justify-between bg-surface-container-lowest">
                <span class="font-body-md text-sm text-on-surface-variant">Showing 1 to 3 of 45 bookings</span>
                <div class="flex items-center gap-2">
                    <button class="w-8 h-8 rounded-lg flex items-center justify-center text-on-surface-variant hover:bg-surface-container-low transition-colors disabled:opacity-50">
                        <span class="material-symbols-outlined text-sm">chevron_left</span>
                    </button>
                    <button class="w-8 h-8 rounded-lg flex items-center justify-center bg-surface-container-high text-primary font-label-md text-sm transition-colors">1</button>
                    <button class="w-8 h-8 rounded-lg flex items-center justify-center text-on-surface-variant hover:bg-surface-container-low font-label-md text-sm transition-colors">2</button>
                    <button class="w-8 h-8 rounded-lg flex items-center justify-center text-on-surface-variant hover:bg-surface-container-low font-label-md text-sm transition-colors">3</button>
                    <span class="text-on-surface-variant">...</span>
                    <button class="w-8 h-8 rounded-lg flex items-center justify-center text-on-surface-variant hover:bg-surface-container-low transition-colors">
                        <span class="material-symbols-outlined text-sm">chevron_right</span>
                    </button>
                </div>
            </div>
        </section>
    </div>
@endsection
