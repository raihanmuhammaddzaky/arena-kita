<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ArenaKita - Sign Up</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .motif-bg {
            background-image: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M20 50 Q 35 20 50 50 T 80 50' fill='none' stroke='%23ffffff' stroke-width='2' stroke-linecap='round' opacity='0.1'/%3E%3C/svg%3E");
            background-size: 50px 50px;
        }
    </style>
</head>
<body class="bg-background min-h-screen flex items-center justify-center font-body-md text-body-md text-on-background">
    <main class="w-full max-w-container-max min-h-screen flex flex-col md:flex-row">
        <!-- Left Side -->
        <div class="hidden md:flex md:w-1/2 bg-primary-container relative overflow-hidden flex-col justify-center items-center p-margin-desktop">
            <div class="absolute inset-0 z-0 bg-cover bg-center" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuDVWAGnVMfHNGTCf5JNw6ZpSWFYnrntTqhm4mGaYwTjNWoz_1wwpFcJphHKx9FrcS-jZQhWK0oVCsO_RHbDYgbz0r7Qghe_8mB3ys_Ndljikt8Itjkjp1ZsqC20EcHhFsDVWX4xjFVGPa3rGjnY56jl4HBitARaby0dHeLuwUGAvAoYBu_pRRR0oLVKytMrYT0VFTHYKtPfgvMj3SI7055pp4jJK13rhi_-08SCnTjLZWCfP5062aQeEQ')">
                <div class="absolute inset-0 bg-primary-container/80"></div>
                <div class="absolute inset-0 motif-bg z-10 pointer-events-none"></div>
            </div>
            <div class="relative z-20 text-center text-on-primary max-w-md">
                <a href="/" class="font-display text-display mb-stack-md block hover:opacity-80">ArenaKita</a>
                <p class="font-body-lg text-body-lg text-on-primary/90">Join our community of wellness and refined sportsmanship. Discover spaces designed for focus and calm.</p>
            </div>
        </div>
        <!-- Right Side -->
        <div class="w-full md:w-1/2 bg-surface flex flex-col justify-center px-margin-mobile py-stack-lg md:px-margin-desktop lg:px-[10%]">
            <div class="w-full max-w-md mx-auto">
                <div class="md:hidden text-center mb-stack-lg">
                    <a href="/" class="font-display text-headline-lg-mobile text-primary mb-stack-sm block">ArenaKita</a>
                    <p class="font-body-md text-body-md text-on-surface-variant">Create your account</p>
                </div>
                <div class="hidden md:block mb-stack-lg">
                    <h2 class="font-headline-lg text-headline-lg text-on-surface mb-stack-sm">Create an Account</h2>
                    <p class="font-body-md text-body-md text-on-surface-variant">Join ArenaKita to start booking premium sports facilities.</p>
                </div>
                <form method="POST" action="/register" class="space-y-stack-md">
                    @csrf
                    <!-- Nama Lengkap -->
                    <div class="space-y-stack-sm">
                        <label class="block font-label-md text-label-md text-on-surface" for="name">Nama Lengkap</label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant">person</span>
                            <input class="w-full pl-10 pr-4 py-3 bg-surface-container-low border border-outline-variant/30 rounded-2xl text-on-surface placeholder:text-on-surface-variant/50 focus:ring-2 focus:ring-secondary focus:border-transparent transition-all shadow-sm" id="name" name="name" placeholder="Your full name" required="" type="text" value="{{ old('name') }}">
                        </div>
                        @error('name')
                            <span class="text-error text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- Email -->
                    <div class="space-y-stack-sm mt-4">
                        <label class="block font-label-md text-label-md text-on-surface" for="email">Email</label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant">mail</span>
                            <input class="w-full pl-10 pr-4 py-3 bg-surface-container-low border border-outline-variant/30 rounded-2xl text-on-surface placeholder:text-on-surface-variant/50 focus:ring-2 focus:ring-secondary focus:border-transparent transition-all shadow-sm" id="email" name="email" placeholder="you@example.com" required="" type="email" value="{{ old('email') }}">
                        </div>
                        @error('email')
                            <span class="text-error text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- No. Telepon -->
                    <div class="space-y-stack-sm mt-4">
                        <label class="block font-label-md text-label-md text-on-surface" for="phone">No. Telepon</label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant">phone</span>
                            <input class="w-full pl-10 pr-4 py-3 bg-surface-container-low border border-outline-variant/30 rounded-2xl text-on-surface placeholder:text-on-surface-variant/50 focus:ring-2 focus:ring-secondary focus:border-transparent transition-all shadow-sm" id="phone" name="phone" placeholder="0812..." required="" type="tel" value="{{ old('phone') }}">
                        </div>
                        @error('phone')
                            <span class="text-error text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- Password -->
                    <div class="space-y-stack-sm mt-4">
                        <label class="block font-label-md text-label-md text-on-surface" for="password">Password</label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant">lock</span>
                            <input class="w-full pl-10 pr-4 py-3 bg-surface-container-low border border-outline-variant/30 rounded-2xl text-on-surface placeholder:text-on-surface-variant/50 focus:ring-2 focus:ring-secondary focus:border-transparent transition-all shadow-sm" id="password" name="password" placeholder="••••••••" required="" type="password">
                        </div>
                        @error('password')
                            <span class="text-error text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- Password Confirmation -->
                    <div class="space-y-stack-sm mt-4">
                        <label class="block font-label-md text-label-md text-on-surface" for="password_confirmation">Confirm Password</label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant">lock</span>
                            <input class="w-full pl-10 pr-4 py-3 bg-surface-container-low border border-outline-variant/30 rounded-2xl text-on-surface placeholder:text-on-surface-variant/50 focus:ring-2 focus:ring-secondary focus:border-transparent transition-all shadow-sm" id="password_confirmation" name="password_confirmation" placeholder="••••••••" required="" type="password">
                        </div>
                    </div>
                    <!-- Submit Button -->
                    <button class="w-full py-4 bg-secondary text-on-secondary font-label-md text-label-md rounded-2xl shadow-md hover:bg-secondary/90 hover:shadow-lg transition-all duration-300 flex items-center justify-center gap-2 mt-6" type="submit">
                        <span>Sign Up</span>
                        <span class="material-symbols-outlined text-[20px]">arrow_forward</span>
                    </button>
                </form>
                <div class="mt-6 text-center">
                    <p class="font-body-md text-body-md text-on-surface-variant">
                        Already have an account? 
                        <a class="text-secondary font-label-md hover:underline transition-all" href="/login">Log In</a>
                    </p>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
