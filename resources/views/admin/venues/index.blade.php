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
                <a href="#" class="flex items-center justify-center space-x-2 bg-secondary-container text-on-secondary-container px-6 py-3 rounded-xl font-label-md text-label-md shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all duration-200">
                    <span class="material-symbols-outlined text-[20px]" data-icon="add">add</span>
                    <span>Add New Venue</span>
                </a>
            </div>
        </div>

        <!-- Filters & Controls -->
        <div class="flex flex-wrap items-center gap-3 pb-4 border-b border-surface-container-highest">
            <div class="flex-1 max-w-md relative group">
                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant group-focus-within:text-secondary transition-colors">search</span>
                <input type="text" placeholder="Search venues by name..." class="w-full bg-surface-container-low border-none rounded-xl py-2.5 pl-10 pr-4 text-on-surface font-body-md focus:ring-2 focus:ring-secondary-container transition-all shadow-sm hover:shadow-md">
            </div>
            <div class="ml-auto flex items-center space-x-2">
                <span class="text-sm text-on-surface-variant mr-2">Sort by:</span>
                <select class="bg-surface-container-low border-none rounded-lg text-on-surface font-body-md text-body-md focus:ring-2 focus:ring-secondary-container cursor-pointer py-2 pl-3 pr-8">
                    <option>Name (A-Z)</option>
                    <option>Price (High to Low)</option>
                    <option>Status</option>
                </select>
            </div>
        </div>

        <!-- Venue Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
            
            <x-admin.venue-card 
                name="Lapangan Karpet Premium A"
                category="Futsal - Synthetic"
                price="Rp 150.000"
                image="https://lh3.googleusercontent.com/aida-public/AB6AXuCm6w06PdhmfovSe_pGUI1D58UF_kywRQsKdN-ZZ7GYCFb__mtSFtph7i_V2PBKT2KcMHS3kxooSlBwpKLfX4n0ouOk6H9V5cu9hw24t779aKP4u6V1d0FJpJ-b5LhSVzsUALYCANv2loPM8yKkl0MxicfQTOLnrbFO6lkfF0VT0YEpb9FBbks1xa8GUZVtVOy6PmEPq10qjGkqxPj5yCAy9JgEjfbdOe859D7nnC9n1LGc5sGsBlijBw"
                status="active"
            />
            
            <x-admin.venue-card 
                name="Badminton VIP 1"
                category="Badminton - Wood"
                price="Rp 80.000"
                image="https://lh3.googleusercontent.com/aida-public/AB6AXuC-ahTmDBVkszWG44IOR0E3Sd2IpCaNTfngn4WCe4O9dY-uUndQYzUd0ueqPKzFxIAAGQlCd1GqFAlagd8Y_AXb30pM5VFkvaYuX0W4XfyukL9SysCdKPlBbM7AeTDMESH4bjTqjw3-bmWr7GU6udR5mnp70ASBHGQJMBi77gx74ySivZhzuBnZuAVcvhuVcAd-eP3sZIHiW31uDZ9gol24BaNnceaorKLD65xYBRQ1fvlVvsIK2x27LQ"
                status="active"
            />

            <x-admin.venue-card 
                name="Outdoor Hoops C"
                category="Basketball - Concrete"
                price="Rp 100.000"
                image="https://lh3.googleusercontent.com/aida-public/AB6AXuCCXpFrsOFLuqnlomxyxGphLifM87qXrDjSCuSbKoPap7pNyYZzpAiqh9CTozJ3RZNxYEQWh4oRlmQWsPW1ebxQe6-7MKMjOhynWEWDlyzjtXfZ1_uSUgWVna2DI94utFXphlXmTs8wYT3_VbUkOmBt4LzMpYCO1d5ZVv5KNfEnLjL97b5C4nH2n3SNo1BrCoAYsRKMdjV6L5fawlS6v9FknQ943ypHzcVDz9fKDlEyQ_mU3jpPiQXzQg"
                status="maintenance"
            />
            
        </div>
    </div>
@endsection
