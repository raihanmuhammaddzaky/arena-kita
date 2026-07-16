@extends('layouts.admin')

@section('title', 'ArenaKita Admin - User Management')

@section('content')
    <div class="max-w-container-max mx-auto flex flex-col gap-stack-lg">
        <!-- Header Section -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <x-admin.page-header 
                title="User Management" 
                subtitle="Manage and verify platform users" 
            />
        </div>

        <!-- Flash Messages -->
        @if(session('success'))
            <div class="bg-secondary-container text-on-secondary-container px-4 py-3 rounded-xl flex items-center gap-2">
                <span class="material-symbols-outlined">check_circle</span>
                {{ session('success') }}
            </div>
        @endif

        <!-- Pending Verification Alert Bento -->
        @php $pendingCount = $users->where('status', 'pending')->count(); @endphp
        @if($pendingCount > 0 || request('status') === 'pending')
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
        @endif

        <!-- Filters & Search -->
        <form method="GET" action="{{ route('admin.users.index') }}" class="flex flex-col md:flex-row gap-4 items-center justify-between bg-surface p-4 rounded-2xl shadow-sm border border-transparent">
            <div class="relative w-full md:w-96">
                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant">search</span>
                <input name="search" value="{{ request('search') }}" class="w-full bg-[#f1f5f9] border-none rounded-xl pl-10 pr-4 py-3 text-sm focus:ring-2 focus:ring-[#86efac] text-on-surface transition-all" placeholder="Search by name or email..." type="text">
            </div>
            <div class="flex gap-3 w-full md:w-auto overflow-x-auto pb-2 md:pb-0">
                <select name="status" class="bg-[#f1f5f9] border-none rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-[#86efac] text-on-surface transition-all min-w-[120px]" onchange="this.form.submit()">
                    <option value="">All Status</option>
                    <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="approved" {{ request('status') === 'approved' ? 'selected' : '' }}>Approved</option>
                    <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Rejected</option>
                </select>

                <button type="submit" class="bg-secondary text-on-secondary px-4 py-3 rounded-xl text-sm font-label-md hover:shadow-md transition-all">
                    Filter
                </button>
            </div>
        </form>

        <!-- User Table -->
        <div class="bg-surface rounded-2xl shadow-md overflow-hidden relative">
            <div class="overflow-x-auto relative z-10">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-surface-container-highest bg-surface-container-low/50">
                            <th class="py-4 px-6 font-label-md text-label-md text-on-surface-variant">User</th>
                            <th class="py-4 px-6 font-label-md text-label-md text-on-surface-variant">Phone</th>
                            <th class="py-4 px-6 font-label-md text-label-md text-on-surface-variant">Role</th>
                            <th class="py-4 px-6 font-label-md text-label-md text-on-surface-variant">Status</th>
                            <th class="py-4 px-6 font-label-md text-label-md text-on-surface-variant">Join Date</th>
                            <th class="py-4 px-6 font-label-md text-label-md text-on-surface-variant text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-surface-container-highest">
                        @forelse($users as $user)
                            <tr class="hover:bg-surface-container-low transition-colors group">
                                <td class="py-4 px-6">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-full overflow-hidden bg-surface-container flex items-center justify-center text-on-surface-variant font-bold uppercase">
                                            {{ substr($user->name, 0, 2) }}
                                        </div>
                                        <div>
                                            <p class="font-label-md text-label-md text-on-surface">{{ $user->name }}</p>
                                            <p class="text-sm text-on-surface-variant">{{ $user->email }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4 px-6 text-sm text-on-surface-variant">{{ $user->phone ?? '-' }}</td>
                                <td class="py-4 px-6 text-sm text-on-surface capitalize">{{ $user->role }}</td>
                                <td class="py-4 px-6">
                                    <x-admin.badge 
                                        :color="$user->status === 'approved' ? 'success' : ($user->status === 'pending' ? 'warning' : 'error')" 
                                        :text="ucfirst($user->status)" 
                                    />
                                </td>
                                <td class="py-4 px-6 text-sm text-on-surface-variant">{{ $user->created_at->format('M d, Y') }}</td>
                                <td class="py-4 px-6 text-right">
                                    <div class="flex items-center justify-end gap-1">
                                        {{-- Approve/Reject buttons for pending users --}}
                                        @if($user->status === 'pending')
                                            <form action="{{ route('admin.users.approve', $user) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="p-2 text-secondary hover:bg-secondary-container rounded-lg transition-colors" title="Approve">
                                                    <span class="material-symbols-outlined text-sm">check_circle</span>
                                                </button>
                                            </form>
                                            <form action="{{ route('admin.users.reject', $user) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="p-2 text-error hover:bg-error-container rounded-lg transition-colors" title="Reject">
                                                    <span class="material-symbols-outlined text-sm">cancel</span>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-8 text-center text-on-surface-variant">Belum ada data user.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="p-4 border-t border-surface-container-highest relative z-10 bg-surface/50 backdrop-blur-sm">
                {{ $users->links() }}
            </div>
        </div>
    </div>
@endsection
