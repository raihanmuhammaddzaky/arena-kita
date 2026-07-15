<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ArenaKita - Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .organic-input {
            border: 1px solid transparent;
            transition: all 0.3s ease;
        }
        .organic-input:focus {
            outline: none;
            border-color: #006c49;
            box-shadow: 0 0 0 2px rgba(0, 108, 73, 0.1);
        }
    </style>
</head>
<body class="bg-background text-on-background font-body-md min-h-screen flex antialiased">
    <!-- Split Layout Container -->
    <div class="flex flex-1 w-full flex-col md:flex-row">
        <!-- Left Side: Login Form Canvas -->
        <div class="w-full md:w-1/2 flex items-center justify-center p-margin-mobile md:p-margin-desktop bg-surface-container-lowest z-10 shadow-ambient-md relative order-2 md:order-1 min-h-screen">
            <div class="w-full max-w-md flex flex-col gap-stack-lg relative">
                <!-- Brand Anchor -->
                <div class="flex flex-col items-center mb-stack-md text-center gap-stack-sm">
                    <div class="w-16 h-16 bg-surface-container-low rounded-full flex items-center justify-center mb-4 shadow-ambient-sm">
                        <span class="material-symbols-outlined text-secondary" style="font-size: 32px;">sports_tennis</span>
                    </div>
                    <a href="/" class="font-display text-headline-lg-mobile md:text-headline-lg text-primary tracking-tight">ArenaKita</a>
                    <p class="font-body-md text-body-md text-on-surface-variant">Calm focus. Better play. Sign in to your account.</p>
                </div>
                <!-- Alert Banner -->
                <div class="bg-surface-container-low border-l-4 border-primary-fixed-dim rounded-r-lg p-4 flex items-start gap-3 shadow-ambient-sm">
                    <span class="material-symbols-outlined text-on-primary-container flex-shrink-0 mt-0.5" style="font-variation-settings: 'FILL' 1;">info</span>
                    <p class="font-body-md text-[14px] leading-relaxed text-on-surface-variant">
                        Catatan: Akun baru memerlukan persetujuan Admin sebelum dapat digunakan untuk booking.
                    </p>
                </div>
                
                <form method="POST" action="/login" class="flex flex-col gap-stack-md">
                    @csrf
                    <div class="flex flex-col gap-2">
                        <label class="font-label-md text-label-md text-on-surface" for="email">Email Address</label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant z-10" style="font-size: 20px;">mail</span>
                            <input class="w-full bg-surface-variant text-on-surface rounded-[12px] py-3 pl-12 pr-4 organic-input font-body-md text-body-md placeholder:text-outline-variant" id="email" name="email" placeholder="you@example.com" required="" type="email" value="{{ old('email') }}">
                        </div>
                        @error('email')
                            <span class="text-error text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col gap-2 mt-4">
                        <div class="flex justify-between items-center">
                            <label class="font-label-md text-label-md text-on-surface" for="password">Password</label>
                        </div>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant z-10" style="font-size: 20px;">lock</span>
                            <input class="w-full bg-surface-variant text-on-surface rounded-[12px] py-3 pl-12 pr-4 organic-input font-body-md text-body-md placeholder:text-outline-variant" id="password" name="password" placeholder="••••••••" required="" type="password">
                        </div>
                        @error('password')
                            <span class="text-error text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- Actions -->
                    <div class="flex flex-col gap-4 mt-6">
                        <button class="w-full bg-secondary text-on-secondary font-label-md text-label-md py-4 rounded-[12px] shadow-ambient-md hover:shadow-ambient-sm hover:scale-[0.99] transition-all duration-300 flex justify-center items-center gap-2 group" type="submit">
                            Masuk
                            <span class="material-symbols-outlined group-hover:translate-x-1 transition-transform duration-300" style="font-size: 18px;">arrow_forward</span>
                        </button>
                        <div class="relative flex items-center py-2">
                            <div class="flex-grow border-t border-surface-container-highest"></div>
                            <span class="flex-shrink-0 mx-4 text-on-surface-variant font-label-md text-[12px]">OR</span>
                            <div class="flex-grow border-t border-surface-container-highest"></div>
                        </div>
                        <a href="/register" class="w-full bg-surface-container-highest text-on-surface font-label-md text-label-md py-4 rounded-[12px] shadow-ambient-sm hover:bg-surface-dim transition-colors duration-300 flex justify-center items-center gap-2">
                            <span class="material-symbols-outlined" style="font-size: 18px;">person_add</span>
                            Create New Account
                        </a>
                    </div>
                </form>
            </div>
        </div>
        <!-- Right Side: Visual Canvas -->
        <div class="hidden md:flex w-1/2 relative bg-primary-container order-1 md:order-2 overflow-hidden">
            <div class="absolute inset-0 opacity-10 mix-blend-overlay" style="background-image: url('https://lh3.googleusercontent.com/aida/AP1WRLvvpZc_l4YqlwXbt3982ox-MfU0UB7jx3DYw7LVq1MGV0WkYZX_ySHT5TJJonItlLfOPvbSt7yIj4TAXl0kOk4zd8DL4_MI92Bw3e-0R3Q_70lpb41jhjE_uoedN1xN0jZ1yS0WOSqn3foIWYOH4ENOsfs_FPEfjgZtj6UqS8JZDpywd1TAobHlr8wGmq8SifDH44shCFvuUflVJsivqfrAoPJNVE4NJnVLB1MHpFLGvtNXIKhUu82Z3Pk'); background-size: cover; background-position: center;"></div>
            <div class="absolute inset-0 bg-gradient-to-br from-primary-container/80 to-surface-dim/40 backdrop-blur-[2px]"></div>
            <div class="relative z-10 flex flex-col justify-end p-margin-desktop h-full w-full max-w-lg">
                <div class="bg-surface/10 backdrop-blur-md rounded-2xl p-8 border border-white/10 shadow-ambient-md">
                    <span class="material-symbols-outlined text-secondary-fixed mb-4" style="font-size: 40px;">format_quote</span>
                    <p class="font-body-lg text-body-lg text-on-primary-fixed mb-6 font-light leading-relaxed">
                        "ArenaKita provides a seamless and tranquil booking experience. The interface is intuitive, allowing me to focus on my game rather than the logistics of finding a court."
                    </p>
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full bg-surface-container-highest overflow-hidden">
                            <img class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDeroE-ybHVZO8Uozx3welnvjuAsosrxzyQ5K6DzORDQgeYY4Ms98BZnhuDCJrW5zB5Dt7jqdKN2pwwYd9b7Bq38J2v34o2qYlhV1P1B8cHxbwSpiJPTOz6KcAeXgT2rZXrcw1ACsSOGMzALK5mg-x-ebFGw6nJ22T9iJS-oY_sDH-mhQpepYgLRJMIkFjEqOWzt0AxXOI64Cu-zsV4on0FPuDlIhzmgcl1-KWQP9mtAAcPzKQ_mw93TA">
                        </div>
                        <div>
                            <p class="font-label-md text-label-md text-on-primary-fixed">Budi Santoso</p>
                            <p class="font-body-md text-[12px] text-primary-fixed-dim">Tennis Enthusiast</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
