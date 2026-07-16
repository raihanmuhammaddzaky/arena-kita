<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'ArenaKita Admin')</title>

    <!-- Fonts and Icons -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS & AlpineJS -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            "colors": {
                    "inverse-primary": "#bec6e0",
                    "error-container": "#ffdad6",
                    "on-secondary-fixed": "#002113",
                    "tertiary-container": "#171c1f",
                    "secondary-fixed-dim": "#4edea3",
                    "on-secondary": "#ffffff",
                    "surface-container": "#e7eeff",
                    "inverse-on-surface": "#ecf1ff",
                    "tertiary": "#000000",
                    "on-primary-fixed": "#131b2e",
                    "primary": "#000000",
                    "on-tertiary-container": "#808488",
                    "surface-variant": "#d8e3fb",
                    "on-error-container": "#93000a",
                    "on-surface": "#111c2d",
                    "surface-tint": "#565e74",
                    "primary-fixed-dim": "#bec6e0",
                    "on-secondary-fixed-variant": "#005236",
                    "background": "#f9f9ff",
                    "secondary-container": "#6cf8bb",
                    "on-surface-variant": "#45464d",
                    "on-background": "#111c2d",
                    "surface-container-high": "#dee8ff",
                    "on-primary-fixed-variant": "#3f465c",
                    "tertiary-fixed-dim": "#c3c7cb",
                    "surface-dim": "#cfdaf2",
                    "surface-container-low": "#f0f3ff",
                    "surface-container-highest": "#d8e3fb",
                    "surface-container-lowest": "#ffffff",
                    "on-primary-container": "#7c839b",
                    "on-error": "#ffffff",
                    "on-primary": "#ffffff",
                    "secondary-fixed": "#6ffbbe",
                    "error": "#ba1a1a",
                    "on-tertiary-fixed-variant": "#43474b",
                    "surface-bright": "#f9f9ff",
                    "primary-fixed": "#dae2fd",
                    "on-tertiary-fixed": "#171c1f",
                    "outline": "#76777d",
                    "on-tertiary": "#ffffff",
                    "primary-container": "#131b2e",
                    "surface": "#f9f9ff",
                    "inverse-surface": "#263143",
                    "tertiary-fixed": "#dfe3e7",
                    "secondary": "#006c49",
                    "outline-variant": "#c6c6cd",
                    "on-secondary-container": "#00714d"
            },
            "borderRadius": {
                    "DEFAULT": "0.25rem",
                    "lg": "0.5rem",
                    "xl": "0.75rem",
                    "full": "9999px"
            },
            "spacing": {
                    "stack-sm": "0.5rem",
                    "stack-md": "1.5rem",
                    "margin-mobile": "1rem",
                    "margin-desktop": "2.5rem",
                    "container-max": "1280px",
                    "stack-lg": "3rem",
                    "gutter": "1.5rem"
            },
            "fontFamily": {
                    "label-md": ["Plus Jakarta Sans"],
                    "body-md": ["Plus Jakarta Sans"],
                    "display": ["Plus Jakarta Sans"],
                    "headline-lg-mobile": ["Plus Jakarta Sans"],
                    "headline-lg": ["Plus Jakarta Sans"],
                    "body-lg": ["Plus Jakarta Sans"],
                    "headline-md": ["Plus Jakarta Sans"]
            },
            "fontSize": {
                    "label-md": ["14px", {"lineHeight": "20px", "letterSpacing": "0.05em", "fontWeight": "600"}],
                    "body-md": ["16px", {"lineHeight": "24px", "fontWeight": "400"}],
                    "display": ["48px", {"lineHeight": "56px", "letterSpacing": "-0.02em", "fontWeight": "700"}],
                    "headline-lg-mobile": ["24px", {"lineHeight": "32px", "fontWeight": "700"}],
                    "headline-lg": ["32px", {"lineHeight": "40px", "letterSpacing": "-0.01em", "fontWeight": "700"}],
                    "body-lg": ["18px", {"lineHeight": "28px", "fontWeight": "400"}],
                    "headline-md": ["24px", {"lineHeight": "32px", "fontWeight": "600"}]
            }
          }
        }
      }
    </script>
    <style>
        .batik-watermark {
            background-image: url('data:image/svg+xml;utf8,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><path d="M10 50 Q 25 25, 50 50 T 90 50" stroke="%23c6c6cd" fill="none" stroke-width="0.5" opacity="0.3"/></svg>');
            background-repeat: repeat;
        }
    </style>
</head>
<body class="bg-background text-on-surface font-body-md text-body-md antialiased min-h-screen flex">
    
    <!-- Background Watermark -->
    <div class="fixed inset-0 pointer-events-none opacity-5 batik-watermark z-[-1]"></div>
    
    <!-- SideNavBar Component -->
    <x-admin.sidebar />
    
    <!-- Main Content Wrapper -->
    <div class="flex-1 md:ml-64 flex flex-col min-h-screen">
        
        <!-- TopNavBar Component -->
        <x-admin.topbar />
        
        <!-- Main Canvas -->
        <main class="flex-1 p-gutter md:p-margin-desktop overflow-y-auto">
            @yield('content')
        </main>
        
    </div>
</body>
</html>
