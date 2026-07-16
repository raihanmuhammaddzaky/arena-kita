@extends('layouts.admin')

@section('title', 'ArenaKita Admin - Create User')

@section('content')
    <div class="flex flex-col gap-stack-lg max-w-container-max mx-auto w-full">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.users.index') }}" class="w-10 h-10 flex items-center justify-center rounded-full bg-surface hover:bg-surface-container-highest transition-colors text-on-surface-variant">
                <span class="material-symbols-outlined">arrow_back</span>
            </a>
            <x-admin.page-header title="Create New User" subtitle="Add a new administrator or renter manually" />
        </div>

        <div class="bg-surface rounded-2xl shadow-sm p-6 md:p-8 border border-surface-container-highest">
            <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-6 max-w-3xl">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Name -->
                    <div class="flex flex-col gap-1.5">
                        <label for="name" class="font-label-md text-label-md text-on-surface">Full Name <span class="text-error">*</span></label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" required 
                               class="bg-surface-container-low border-none rounded-xl px-4 py-3 text-body-md text-on-surface focus:ring-2 focus:ring-secondary @error('name') ring-2 ring-error @enderror" 
                               placeholder="e.g. John Doe">
                        @error('name') <span class="text-sm text-error mt-1">{{ $message }}</span> @enderror
                    </div>

                    <!-- Email -->
                    <div class="flex flex-col gap-1.5">
                        <label for="email" class="font-label-md text-label-md text-on-surface">Email Address <span class="text-error">*</span></label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" required 
                               class="bg-surface-container-low border-none rounded-xl px-4 py-3 text-body-md text-on-surface focus:ring-2 focus:ring-secondary @error('email') ring-2 ring-error @enderror" 
                               placeholder="e.g. john@example.com">
                        @error('email') <span class="text-sm text-error mt-1">{{ $message }}</span> @enderror
                    </div>

                    <!-- Phone -->
                    <div class="flex flex-col gap-1.5">
                        <label for="phone" class="font-label-md text-label-md text-on-surface">Phone Number</label>
                        <input type="text" name="phone" id="phone" value="{{ old('phone') }}" 
                               class="bg-surface-container-low border-none rounded-xl px-4 py-3 text-body-md text-on-surface focus:ring-2 focus:ring-secondary @error('phone') ring-2 ring-error @enderror" 
                               placeholder="e.g. 081234567890">
                        @error('phone') <span class="text-sm text-error mt-1">{{ $message }}</span> @enderror
                    </div>

                    <!-- Role -->
                    <div class="flex flex-col gap-1.5">
                        <label for="role" class="font-label-md text-label-md text-on-surface">User Role <span class="text-error">*</span></label>
                        <select name="role" id="role" required class="bg-surface-container-low border-none rounded-xl px-4 py-3 text-body-md text-on-surface focus:ring-2 focus:ring-secondary @error('role') ring-2 ring-error @enderror">
                            <option value="renter" @selected(old('role') == 'renter')>Renter</option>
                            <option value="admin" @selected(old('role') == 'admin')>Administrator</option>
                        </select>
                        @error('role') <span class="text-sm text-error mt-1">{{ $message }}</span> @enderror
                    </div>

                    <!-- Status -->
                    <div class="flex flex-col gap-1.5">
                        <label for="status" class="font-label-md text-label-md text-on-surface">Account Status <span class="text-error">*</span></label>
                        <select name="status" id="status" required class="bg-surface-container-low border-none rounded-xl px-4 py-3 text-body-md text-on-surface focus:ring-2 focus:ring-secondary @error('status') ring-2 ring-error @enderror">
                            <option value="pending" @selected(old('status') == 'pending')>Pending</option>
                            <option value="approved" @selected(old('status') == 'approved')>Approved</option>
                            <option value="rejected" @selected(old('status') == 'rejected')>Rejected</option>
                        </select>
                        @error('status') <span class="text-sm text-error mt-1">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="border-t border-surface-container-highest my-6"></div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Password -->
                    <div class="flex flex-col gap-1.5">
                        <label for="password" class="font-label-md text-label-md text-on-surface">Password <span class="text-error">*</span></label>
                        <input type="password" name="password" id="password" required 
                               class="bg-surface-container-low border-none rounded-xl px-4 py-3 text-body-md text-on-surface focus:ring-2 focus:ring-secondary @error('password') ring-2 ring-error @enderror">
                        @error('password') <span class="text-sm text-error mt-1">{{ $message }}</span> @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="flex flex-col gap-1.5">
                        <label for="password_confirmation" class="font-label-md text-label-md text-on-surface">Confirm Password <span class="text-error">*</span></label>
                        <input type="password" name="password_confirmation" id="password_confirmation" required 
                               class="bg-surface-container-low border-none rounded-xl px-4 py-3 text-body-md text-on-surface focus:ring-2 focus:ring-secondary">
                    </div>
                </div>

                <div class="pt-4 flex justify-end gap-3">
                    <a href="{{ route('admin.users.index') }}" class="px-6 py-2.5 rounded-xl font-label-md text-label-md text-on-surface-variant hover:bg-surface-container-highest transition-colors">
                        Cancel
                    </a>
                    <button type="submit" class="px-6 py-2.5 rounded-xl bg-secondary text-on-secondary font-label-md text-label-md shadow-sm hover:shadow-md transition-all">
                        Create User
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
