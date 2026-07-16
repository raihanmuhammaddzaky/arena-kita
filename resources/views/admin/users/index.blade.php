@extends('layouts.admin')

@section('title', 'ArenaKita Admin - User Management')

@section('content')
    <div class="flex flex-col gap-stack-lg max-w-container-max mx-auto w-full">
        <!-- Header Section -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <x-admin.page-header 
                title="User Management" 
                subtitle="Manage and verify platform users" 
            />
        </div>

        <!-- Pending Verification Alert Bento -->
        <div class="bg-surface-container-low rounded-2xl p-6 relative overflow-hidden shadow-sm flex flex-col md:flex-row items-center justify-between gap-6">
            <div class="relative z-10 flex items-start gap-4">
                <div class="w-12 h-12 rounded-full bg-secondary-container/20 text-on-secondary-container flex items-center justify-center shrink-0">
                    <span class="material-symbols-outlined">verified_user</span>
                </div>
                <div>
                    <h3 class="font-headline-md text-headline-md text-on-surface mb-1">Pending Verifications</h3>
                    <p class="text-on-surface-variant text-sm max-w-md">There are currently users awaiting identity verification to join the platform. Review them to maintain community standards.</p>
                </div>
            </div>
        </div>

        <!-- Filters & Search -->
        <div class="flex flex-col md:flex-row gap-4 items-center justify-between bg-surface p-4 rounded-2xl shadow-sm border border-transparent">
            <div class="relative w-full md:w-96">
                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant">search</span>
                <input class="w-full bg-[#f1f5f9] border-none rounded-xl pl-10 pr-4 py-3 text-sm focus:ring-2 focus:ring-[#86efac] text-on-surface transition-all" placeholder="Search by name or email..." type="text">
            </div>
            <div class="flex gap-3 w-full md:w-auto overflow-x-auto pb-2 md:pb-0">
                <select class="bg-[#f1f5f9] border-none rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-[#86efac] text-on-surface transition-all min-w-[120px]">
                    <option value="">All Status</option>
                    <option value="active">Active</option>
                    <option value="pending">Pending</option>
                    <option value="suspended">Suspended</option>
                </select>
                <select class="bg-[#f1f5f9] border-none rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-[#86efac] text-on-surface transition-all min-w-[120px]">
                    <option value="">All Roles</option>
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                    <option value="manager">Manager</option>
                </select>
            </div>
        </div>

        <!-- User Table -->
        <div class="bg-surface rounded-2xl shadow-md overflow-hidden relative">
            <div class="overflow-x-auto relative z-10">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-surface-container-highest bg-surface-container-low/50">
                            <th class="py-4 px-6 font-label-md text-label-md text-on-surface-variant">User</th>
                            <th class="py-4 px-6 font-label-md text-label-md text-on-surface-variant">Role</th>
                            <th class="py-4 px-6 font-label-md text-label-md text-on-surface-variant">Status</th>
                            <th class="py-4 px-6 font-label-md text-label-md text-on-surface-variant">Join Date</th>
                            <th class="py-4 px-6 font-label-md text-label-md text-on-surface-variant text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-surface-container-highest">
                        <!-- Row 1 -->
                        <tr class="hover:bg-surface-container-low transition-colors group">
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full overflow-hidden bg-surface-container">
                                        <img class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBfcZ_WriF_0hstD_6pgQVnS2gWTNPWyzxINrudSXg94D7ilNwAttndqlL2O1LpQKLrqfrnCJdsSiQ6ho2EX9czFjPnnhBJsHvFMmdAcWAD73ANSUtJVMnGsEfhS0K1IdnyDjUPNzAT1g88QVOqlkkoliVJl209U6dv1YepKIVrtawxKOZUWiF7wKBs4D6S_Nmw_szQwCCA23REG-TR9HNR8N4411n3ejqjJeE4SnQs7i7Fo6qv5mHJ_Q">
                                    </div>
                                    <div>
                                        <p class="font-label-md text-label-md text-on-surface">Alex Thompson</p>
                                        <p class="text-sm text-on-surface-variant">alex.t@example.com</p>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-6 text-sm text-on-surface">User</td>
                            <td class="py-4 px-6">
                                <x-admin.badge color="success" text="Active" />
                            </td>
                            <td class="py-4 px-6 text-sm text-on-surface-variant">Oct 12, 2023</td>
                            <td class="py-4 px-6 text-right">
                                <div class="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <button class="p-2 text-on-surface-variant hover:text-primary hover:bg-surface-container-highest rounded-lg transition-colors" title="Edit">
                                        <span class="material-symbols-outlined text-sm">edit</span>
                                    </button>
                                    <button class="p-2 text-on-surface-variant hover:text-error hover:bg-error-container rounded-lg transition-colors" title="Suspend">
                                        <span class="material-symbols-outlined text-sm">block</span>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- Row 2 -->
                        <tr class="hover:bg-surface-container-low transition-colors group">
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full overflow-hidden bg-surface-container flex items-center justify-center text-on-surface-variant font-bold">
                                        MR
                                    </div>
                                    <div>
                                        <p class="font-label-md text-label-md text-on-surface">Maria Rodriguez</p>
                                        <p class="text-sm text-on-surface-variant">m.rodriguez@example.com</p>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-6 text-sm text-on-surface">Manager</td>
                            <td class="py-4 px-6">
                                <x-admin.badge color="warning" text="Pending" />
                            </td>
                            <td class="py-4 px-6 text-sm text-on-surface-variant">Oct 14, 2023</td>
                            <td class="py-4 px-6 text-right">
                                <div class="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <button class="p-2 text-on-surface-variant hover:text-primary hover:bg-surface-container-highest rounded-lg transition-colors" title="Edit">
                                        <span class="material-symbols-outlined text-sm">edit</span>
                                    </button>
                                    <button class="p-2 text-on-surface-variant hover:text-error hover:bg-error-container rounded-lg transition-colors" title="Suspend">
                                        <span class="material-symbols-outlined text-sm">block</span>
                                    </button>
                                </div>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="p-4 border-t border-surface-container-highest flex items-center justify-between relative z-10 bg-surface/50 backdrop-blur-sm">
                <p class="text-sm text-on-surface-variant">Showing 1 to 2 of 2 entries</p>
                <div class="flex gap-1">
                    <button class="w-8 h-8 flex items-center justify-center rounded-lg hover:bg-surface-container-highest text-on-surface-variant transition-colors disabled:opacity-50" disabled>
                        <span class="material-symbols-outlined text-sm">chevron_left</span>
                    </button>
                    <button class="w-8 h-8 flex items-center justify-center rounded-lg bg-surface-container-highest text-on-surface font-medium transition-colors">1</button>
                    <button class="w-8 h-8 flex items-center justify-center rounded-lg hover:bg-surface-container-highest text-on-surface-variant transition-colors">
                        <span class="material-symbols-outlined text-sm">chevron_right</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
