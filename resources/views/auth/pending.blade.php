<!DOCTYPE html>
<html lang="id" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ArenaKita - Menunggu Verifikasi Akun</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&amp;family=Plus+Jakarta+Sans:wght@600;700&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=block" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "error": "#ba1a1a",
                        "inverse-primary": "#afc8f0",
                        "on-error-container": "#93000a",
                        "on-primary-container": "#6f88ad",
                        "outline": "#74777f",
                        "error-container": "#ffdad6",
                        "surface-container-low": "#eff4ff",
                        "primary-fixed-dim": "#afc8f0",
                        "tertiary-fixed-dim": "#4edea3",
                        "on-secondary-fixed-variant": "#444749",
                        "on-secondary": "#ffffff",
                        "on-surface-variant": "#43474e",
                        "surface-container": "#e5eeff",
                        "surface-bright": "#f8f9ff",
                        "secondary-fixed-dim": "#c4c7c9",
                        "secondary-container": "#e0e3e5",
                        "on-background": "#0b1c30",
                        "on-primary": "#ffffff",
                        "tertiary-fixed": "#6ffbbe",
                        "on-tertiary-container": "#009969",
                        "primary": "#000613",
                        "on-surface": "#0b1c30",
                        "on-secondary-fixed": "#191c1e",
                        "primary-fixed": "#d4e3ff",
                        "secondary-fixed": "#e0e3e5",
                        "secondary": "#5c5f61",
                        "on-secondary-container": "#626567",
                        "tertiary-container": "#002416",
                        "surface-container-high": "#dce9ff",
                        "primary-container": "#001f3f",
                        "outline-variant": "#c4c6cf",
                        "surface-container-lowest": "#ffffff",
                        "on-error": "#ffffff",
                        "on-tertiary-fixed": "#002113",
                        "tertiary": "#000703",
                        "surface": "#f8f9ff",
                        "on-tertiary-fixed-variant": "#005236",
                        "inverse-on-surface": "#eaf1ff",
                        "surface-tint": "#476083",
                        "background": "#f8f9ff",
                        "surface-dim": "#cbdbf5",
                        "on-tertiary": "#ffffff",
                        "on-primary-fixed-variant": "#2f486a",
                        "on-primary-fixed": "#001c3a",
                        "inverse-surface": "#213145",
                        "surface-variant": "#d3e4fe",
                        "surface-container-highest": "#d3e4fe"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    "spacing": {
                        "unit": "8px",
                        "gutter": "24px",
                        "margin-desktop": "40px",
                        "margin-mobile": "20px",
                        "container-max": "1280px"
                    },
                    "fontFamily": {
                        "headline-md": ["Plus Jakarta Sans"],
                        "label-sm": ["Inter"],
                        "headline-lg-mobile": ["Plus Jakarta Sans"],
                        "body-md": ["Inter"],
                        "headline-lg": ["Plus Jakarta Sans"],
                        "body-lg": ["Inter"]
                    },
                    "fontSize": {
                        "headline-md": ["20px", { "lineHeight": "28px", "fontWeight": "600" }],
                        "label-sm": ["13px", { "lineHeight": "16px", "letterSpacing": "0.05em", "fontWeight": "600" }],
                        "headline-lg-mobile": ["24px", { "lineHeight": "32px", "letterSpacing": "-0.01em", "fontWeight": "700" }],
                        "body-md": ["16px", { "lineHeight": "24px", "fontWeight": "400" }],
                        "headline-lg": ["32px", { "lineHeight": "40px", "letterSpacing": "-0.02em", "fontWeight": "700" }],
                        "body-lg": ["18px", { "lineHeight": "28px", "fontWeight": "400" }]
                    },
                    boxShadow: {
                        'low': '0px 4px 20px rgba(0, 31, 63, 0.05)',
                        'high': '0px 12px 32px rgba(0, 31, 63, 0.12)',
                    }
                },
            },
        }
    </script>
</head>
<body class="bg-surface text-on-surface font-body-md min-h-screen flex flex-col relative overflow-x-hidden selection:bg-primary-container selection:text-on-primary-container">

    <!-- Mega Mendung Watermark Layer -->
    <div class="absolute inset-0 mega-mendung-pattern pointer-events-none -z-10"></div>

    <!-- Minimal TopAppBar (Transactional Context - Suppressed Navigation) -->
    <header class="w-full bg-surface dark:bg-background px-margin-mobile md:px-margin-desktop py-4 max-w-container-max mx-auto flex justify-center items-center z-10 sticky top-0">
        <a href="{{ url('/') }}" class="font-headline-md text-headline-md font-bold text-primary dark:text-inverse-primary hover:opacity-80 transition-opacity flex items-center gap-2">
            <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;" data-original-icon="sports_soccer">sports_soccer</span>
            ArenaKita
        </a>
    </header>

    <!-- Main Content Canvas -->
    <main class="flex-grow flex items-center justify-center p-margin-mobile md:p-margin-desktop z-10">
        
        <div class="max-w-xl w-full bg-surface-container-lowest rounded-xl shadow-low p-8 md:p-12 text-center transition-all hover:shadow-high border border-transparent hover:border-primary duration-300">
            
            <!-- Animated Icon Wrapper -->
            <div class="relative w-24 h-24 mx-auto mb-8 flex items-center justify-center rounded-full bg-surface-container-high text-primary-container">
                <!-- Outer pulsing ring -->
                <div class="absolute inset-0 rounded-full border-2 border-primary-container opacity-20 animate-ping"></div>
                <span class="material-symbols-outlined text-[48px]" style="font-variation-settings: 'FILL' 0;">pending_actions</span>
            </div>

            <h1 class="font-headline-lg-mobile md:font-headline-lg text-headline-lg-mobile md:text-headline-lg text-primary mb-4">
                Pendaftaran Anda Sedang Diproses
            </h1>

            <p class="font-body-md text-body-md text-secondary mb-8 leading-relaxed max-w-md mx-auto">
                Terima kasih telah bergabung dengan ArenaKita. Akun Anda sedang diverifikasi oleh tim admin kami untuk memastikan keamanan dan kualitas layanan. Anda akan menerima notifikasi setelah akun Anda aktif.
            </p>

            <!-- Status Chip -->
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-primary-container/10 text-primary-container font-label-sm text-label-sm mb-10">
                <span class="material-symbols-outlined text-[16px] animate-spin" style="animation-duration: 3s;">hourglass_empty</span>
                Status: Menunggu Verifikasi
            </div>

            <!-- Actions -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                
                <form method="POST" action="{{ route('logout') }}" class="w-full sm:w-auto">
                    @csrf
                    <button type="submit" class="bg-surface-container-lowest text-primary border border-outline-variant rounded-xl px-8 h-[48px] font-label-sm text-label-sm hover:bg-surface transition-colors flex items-center justify-center gap-2 w-full sm:w-auto">
                        <span class="material-symbols-outlined text-[18px]">logout</span>
                        Keluar
                    </button>
                </form>
            </div>
        </div>

    </main>

</body>
</html>
