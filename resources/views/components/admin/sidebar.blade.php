<aside class="hidden md:flex flex-col h-screen w-64 fixed left-0 top-0 bg-surface-container-low dark:bg-primary-container shadow-md py-6 px-4 gap-2 z-50">
    <!-- Header -->
    <div class="flex items-center gap-3 px-4 mb-stack-md">
        <div class="w-10 h-10 rounded-full bg-primary-container flex items-center justify-center shrink-0">
            <span class="material-symbols-outlined text-on-primary font-headline-md text-headline-md" style="font-variation-settings: 'FILL' 1;">sports_soccer</span>
        </div>
        <div>
            <h1 class="text-headline-md font-headline-md text-primary dark:text-primary-fixed leading-tight">ArenaKita Admin</h1>
            <p class="text-label-md font-label-md text-on-surface-variant">Venue Management</p>
        </div>
    </div>
    
    <!-- Navigation Links -->
    <nav class="flex-1 flex flex-col gap-1 overflow-y-auto mt-2">
        <!-- Dashboard -->
        <a class="flex items-center gap-3 {{ request()->routeIs('admin.dashboard') ? 'bg-secondary-container dark:bg-on-secondary-fixed-variant text-on-secondary-container dark:text-secondary-fixed' : 'text-on-surface-variant dark:text-on-tertiary-container hover:bg-surface-container-high dark:hover:bg-on-primary-fixed-variant' }} rounded-xl px-4 py-3 transition-transform duration-100" href="{{ route('admin.dashboard') }}">
            <span class="material-symbols-outlined" {{ request()->routeIs('admin.dashboard') ? 'style=font-variation-settings:\'FILL\'1;' : '' }}>dashboard</span>
            <span class="text-label-md font-label-md">Overview</span>
        </a>
        
        <!-- Users -->
        <a class="flex items-center gap-3 {{ request()->routeIs('admin.users.*') ? 'bg-secondary-container dark:bg-on-secondary-fixed-variant text-on-secondary-container dark:text-secondary-fixed' : 'text-on-surface-variant dark:text-on-tertiary-container hover:bg-surface-container-high dark:hover:bg-on-primary-fixed-variant' }} px-4 py-3 rounded-xl transition-all duration-200" href="{{ route('admin.users.index') }}">
            <span class="material-symbols-outlined">group</span>
            <span class="text-label-md font-label-md">Users</span>
        </a>
        
        <!-- Venues -->
        <a class="flex items-center gap-3 {{ request()->routeIs('admin.venues.*') ? 'bg-secondary-container dark:bg-on-secondary-fixed-variant text-on-secondary-container dark:text-secondary-fixed' : 'text-on-surface-variant dark:text-on-tertiary-container hover:bg-surface-container-high dark:hover:bg-on-primary-fixed-variant' }} px-4 py-3 rounded-xl transition-all duration-200" href="{{ route('admin.venues.index') }}">
            <span class="material-symbols-outlined">stadium</span>
            <span class="text-label-md font-label-md">Venues</span>
        </a>
        
        <!-- Announcements -->
        <a class="flex items-center gap-3 {{ request()->routeIs('admin.announcements.*') ? 'bg-secondary-container dark:bg-on-secondary-fixed-variant text-on-secondary-container dark:text-secondary-fixed' : 'text-on-surface-variant dark:text-on-tertiary-container hover:bg-surface-container-high dark:hover:bg-on-primary-fixed-variant' }} px-4 py-3 rounded-xl transition-all duration-200" href="{{ route('admin.announcements.index') }}">
            <span class="material-symbols-outlined">campaign</span>
            <span class="text-label-md font-label-md">Pengumuman</span>
        </a>
        
        <!-- Payments -->
        <a class="flex items-center gap-3 {{ request()->routeIs('admin.payments.*') ? 'bg-secondary-container dark:bg-on-secondary-fixed-variant text-on-secondary-container dark:text-secondary-fixed' : 'text-on-surface-variant dark:text-on-tertiary-container hover:bg-surface-container-high dark:hover:bg-on-primary-fixed-variant' }} px-4 py-3 rounded-xl transition-all duration-200" href="{{ route('admin.payments.index') }}">
            <span class="material-symbols-outlined">payments</span>
            <span class="text-label-md font-label-md">Verifikasi Bayar</span>
        </a>
    </nav>
    
    <!-- Footer Links -->
    <div class="mt-auto border-t border-outline-variant/30 pt-4 flex flex-col gap-1">
        <!-- Logout -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full flex items-center gap-3 text-on-surface-variant dark:text-on-tertiary-container px-4 py-3 hover:bg-surface-container-high dark:hover:bg-on-primary-fixed-variant rounded-xl transition-all duration-200">
                <span class="material-symbols-outlined">logout</span>
                <span class="text-label-md font-label-md">Logout</span>
            </button>
        </form>
    </div>
</aside>
