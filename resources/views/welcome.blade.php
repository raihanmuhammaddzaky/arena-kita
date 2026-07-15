@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="relative w-full min-h-[85vh] flex items-center justify-center px-margin-mobile md:px-margin-desktop py-32 overflow-hidden bg-surface-container-lowest">
    <!-- Background Image (Airy/Light) -->
    <div class="absolute inset-0 z-0">
        <img alt="Sport Facility" class="object-cover w-full h-full opacity-[0.15]" src="https://lh3.googleusercontent.com/aida/AP1WRLs2LWIm83J7VZQSSTXimdYsVnSUN15iYMwQoYauaMwRvYirjZG9OAFhphK4AuSI3l7jxB3nwqx3yfu9AfyWAm2sqMkp7i1Pt-5F842xjSQwIFHqas-UapSyakiZRKNelRnrY6OzieU8GNlV2okvi5buY7iPhzCYaIz5_a61qt2uMlsd6pXgDmt0TxryRbSMxOgGWVxDkTWJNkfkAL2wD2Chemb8WKAmKSqbPqrLvW5SZiMhvGPa4cS5kWo">
        <div class="absolute inset-0 bg-surface-container-lowest/60 bg-gradient-to-b from-surface-container-lowest/80 via-surface-container-lowest/50 to-surface-container-lowest z-10"></div>
    </div>
    <!-- Decorative Shapes -->
    <div class="absolute top-0 right-0 w-1/2 h-full bg-gradient-to-bl from-surface-container-highest/40 to-transparent z-10 pointer-events-none rounded-bl-full blur-3xl opacity-60"></div>
    <div class="absolute bottom-0 left-0 w-1/2 h-1/2 bg-gradient-to-tr from-surface-variant/40 to-transparent z-10 pointer-events-none rounded-tr-full blur-3xl opacity-50"></div>
    <!-- Content -->
    <div class="relative z-20 max-w-5xl mx-auto w-full flex flex-col items-center text-center gap-8">
        <span class="inline-flex items-center px-5 py-2 rounded-full bg-surface-container border border-surface-variant text-primary-container font-label-sm shadow-sm tracking-widest uppercase">
            <span class="material-symbols-outlined text-[18px] mr-2 text-on-tertiary-container">workspace_premium</span>
            Premium Booking Platform
        </span>
        <h1 class="font-headline-lg text-5xl md:text-7xl lg:text-[80px] text-primary-container leading-[1.1] tracking-tight font-extrabold drop-shadow-sm">
            Fokus Pada <span class="text-on-tertiary-container relative inline-block">Permainan<svg class="absolute -bottom-2 left-0 w-full h-3 text-on-tertiary-container/30" preserveAspectRatio="none" viewBox="0 0 100 10" xmlns="http://www.w3.org/2000/svg"><path d="M0 5 Q 50 10 100 5" fill="none" stroke="currentColor" stroke-width="4"></path></svg></span>,<br class="hidden md:block"> Bukan Pencarian.
        </h1>
        <p class="font-body-lg text-xl md:text-2xl text-on-surface-variant max-w-3xl mx-auto font-light leading-relaxed">
            Temukan dan pesan lapangan olahraga premium di sekitarmu dengan mudah. ArenaKita menghadirkan ruang berkualitas untuk mendukung aktivitas sehatmu dalam suasana yang elegan.
        </p>
    </div>
</section>

<!-- Featured Courts Section -->
<section class="py-32 px-margin-mobile md:px-margin-desktop bg-surface relative">
    <!-- Watermark -->
    <div class="absolute top-20 left-0 text-[150px] font-extrabold text-surface-container-highest/40 tracking-tighter whitespace-nowrap pointer-events-none select-none overflow-hidden w-full -z-0">PREMIUM VENUES</div>
    <div class="max-w-container-max mx-auto relative z-10">
        <div class="flex flex-col md:flex-row justify-between items-end mb-16 gap-6">
            <div class="max-w-2xl">
                <h2 class="font-headline-lg text-4xl md:text-5xl text-primary-container mb-4 tracking-tight font-extrabold">Fasilitas Pilihan</h2>
                <p class="font-body-lg text-xl text-on-surface-variant">Ruang olahraga berkualitas tinggi untuk pengalaman optimal. Dirancang untuk kenyamanan dan performa.</p>
            </div>
            <a href="/venues" class="text-on-tertiary-container font-label-sm uppercase tracking-widest flex items-center gap-2 hover:text-primary-container transition-colors group bg-surface-container-highest/40 px-6 py-3 rounded-full hover:bg-surface-container-highest inline-flex">
                Lihat Semua <span class="material-symbols-outlined text-[20px] group-hover:translate-x-1 transition-transform">east</span>
            </a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
            <!-- Card 1 -->
            <div class="group bg-surface-container-lowest rounded-3xl shadow-sm hover:shadow-xl border border-surface-variant overflow-hidden transition-all duration-500 hover:-translate-y-2 cursor-pointer flex flex-col h-full">
                <div class="relative h-72 w-full overflow-hidden bg-surface-container rounded-t-3xl">
                    <div class="bg-cover bg-center w-full h-full transition-transform duration-1000 group-hover:scale-110" data-alt="A clean, modern indoor badminton court" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuDngfkauhoQJXthpDQBOKUb9QZ_aKxoNnwDszhcmAWhJFNltdcP2j2ivEWBViJOInsJdykD8RuGi-q-hwVSiQvYqQCNMMiArHjI0jgMMXNyZU7K5Ha5hlfr6AgEDuq0nn96tpKmmeorb3WtKLNgsFyQO4RCiodtgbE7rhrZB_bo9j4WFrUaI8lYLkvzp4pGZ-7lelOR4TTihdK3f1JTPcB0CBpA_K6e-U83XtXkDhp_Iy_Cxc04KzlbMw')"></div>
                    <div class="absolute top-5 left-5 bg-surface-container-lowest/95 backdrop-blur-md px-4 py-2 rounded-full flex items-center gap-1.5 shadow-sm border border-surface-variant/50">
                        <span class="material-symbols-outlined text-[18px] text-amber-500 fill-current">star</span>
                        <span class="font-label-sm text-on-surface font-bold text-sm">4.9</span>
                    </div>
                    <div class="absolute top-5 right-5 bg-surface-container-lowest/95 backdrop-blur-md text-on-tertiary-container px-4 py-2 rounded-full font-label-sm text-xs shadow-sm uppercase tracking-widest border border-surface-variant/50">
                        Tersedia
                    </div>
                </div>
                <div class="p-8 flex flex-col flex-grow">
                    <div class="flex items-center gap-2 mb-4">
                        <span class="material-symbols-outlined text-[18px] text-outline">location_on</span>
                        <span class="font-label-sm text-on-surface-variant uppercase tracking-widest text-xs font-semibold">Jakarta Selatan</span>
                    </div>
                    <h3 class="font-headline-lg text-2xl text-primary-container mb-6 group-hover:text-primary transition-colors leading-snug font-bold">Arena Bulutangkis Premium</h3>
                    <div class="mt-auto flex justify-between items-end pt-6 border-t border-surface-variant">
                        <div>
                            <span class="font-label-sm text-outline text-xs uppercase tracking-widest block mb-1 font-semibold">Mulai dari</span>
                            <div class="font-headline-lg text-[28px] text-primary-container font-extrabold tracking-tight">Rp 75.000<span class="font-body-md text-sm font-normal text-on-surface-variant ml-1">/jam</span></div>
                        </div>
                        <button class="w-14 h-14 rounded-full bg-surface-container flex items-center justify-center text-primary-container border border-surface-variant group-hover:bg-primary-container group-hover:text-on-primary group-hover:border-transparent transition-all duration-300">
                            <span class="material-symbols-outlined text-[24px]">arrow_forward</span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Card 2 -->
            <div class="group bg-surface-container-lowest rounded-3xl shadow-sm hover:shadow-xl border border-surface-variant overflow-hidden transition-all duration-500 hover:-translate-y-2 cursor-pointer flex flex-col h-full">
                <div class="relative h-72 w-full overflow-hidden bg-surface-container rounded-t-3xl">
                    <div class="bg-cover bg-center w-full h-full transition-transform duration-1000 group-hover:scale-110" data-alt="A premium indoor futsal court" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuAc5HFUVDeyjim2IqbrAZFEWLjECm_LZjvZRm7GdYR-l74TQLXN2p1eh48IrI5bAaJVP040q4as-9QP0MTSPeb2usgnUG8DeFXlhf7GWXa7A0qz-SLDqS7-2Jcb1sYu2w0NpSBah-h_A3pmtzNYXF3EuuN7oy77rYmumUuYZYntkad1gctVoEVquiGFNOhHk1u_-KE_pZJoBUU-uAZA8s-Eu4qIp9ZzMz6IVI1mG2M8iUBNNIbQUA_Yww')"></div>
                    <div class="absolute top-5 left-5 bg-surface-container-lowest/95 backdrop-blur-md px-4 py-2 rounded-full flex items-center gap-1.5 shadow-sm border border-surface-variant/50">
                        <span class="material-symbols-outlined text-[18px] text-amber-500 fill-current">star</span>
                        <span class="font-label-sm text-on-surface font-bold text-sm">4.8</span>
                    </div>
                    <div class="absolute top-5 right-5 bg-surface-container-lowest/95 backdrop-blur-md text-on-surface-variant px-4 py-2 rounded-full font-label-sm text-xs shadow-sm uppercase tracking-widest border border-surface-variant/50">
                        Terbatas
                    </div>
                </div>
                <div class="p-8 flex flex-col flex-grow">
                    <div class="flex items-center gap-2 mb-4">
                        <span class="material-symbols-outlined text-[18px] text-outline">location_on</span>
                        <span class="font-label-sm text-on-surface-variant uppercase tracking-widest text-xs font-semibold">Jakarta Pusat</span>
                    </div>
                    <h3 class="font-headline-lg text-2xl text-primary-container mb-6 group-hover:text-primary transition-colors leading-snug font-bold">Futsal Court Eksekutif</h3>
                    <div class="mt-auto flex justify-between items-end pt-6 border-t border-surface-variant">
                        <div>
                            <span class="font-label-sm text-outline text-xs uppercase tracking-widest block mb-1 font-semibold">Mulai dari</span>
                            <div class="font-headline-lg text-[28px] text-primary-container font-extrabold tracking-tight">Rp 150.000<span class="font-body-md text-sm font-normal text-on-surface-variant ml-1">/jam</span></div>
                        </div>
                        <button class="w-14 h-14 rounded-full bg-surface-container flex items-center justify-center text-primary-container border border-surface-variant group-hover:bg-primary-container group-hover:text-on-primary group-hover:border-transparent transition-all duration-300">
                            <span class="material-symbols-outlined text-[24px]">arrow_forward</span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Card 3 -->
            <div class="group bg-surface-container-lowest rounded-3xl shadow-sm hover:shadow-xl border border-surface-variant overflow-hidden transition-all duration-500 hover:-translate-y-2 cursor-pointer flex flex-col h-full">
                <div class="relative h-72 w-full overflow-hidden bg-surface-container rounded-t-3xl">
                    <div class="bg-cover bg-center w-full h-full transition-transform duration-1000 group-hover:scale-110" data-alt="An elegant outdoor tennis court" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuDlOjclojg99k-Hoj_wIDL8AIOj1GxxtFyWet8fZ4bEvUot-Fvg50z8LYKHP5XHWF50d8-inO5lc09FD5OXH-HP0-3Jtmu-jQ1vKfi1WVQ9GW0pTIh6rVLT6E1QeP-hw25KgmQWQ95Kl7IffoOK_MWxrcOP80bo6_GL6Oz4Fn0bte7OwwqXBv5kToaEGnPEJbFoJ0ZvhheuWctegwJZDUc1Lavo_9fCxKLja2P3CK1_OZ128wO6oxm0dA')"></div>
                    <div class="absolute top-5 left-5 bg-surface-container-lowest/95 backdrop-blur-md px-4 py-2 rounded-full flex items-center gap-1.5 shadow-sm border border-surface-variant/50">
                        <span class="material-symbols-outlined text-[18px] text-amber-500 fill-current">star</span>
                        <span class="font-label-sm text-on-surface font-bold text-sm">5.0</span>
                    </div>
                    <div class="absolute top-5 right-5 bg-surface-container-lowest/95 backdrop-blur-md text-on-tertiary-container px-4 py-2 rounded-full font-label-sm text-xs shadow-sm uppercase tracking-widest border border-surface-variant/50">
                        Tersedia
                    </div>
                </div>
                <div class="p-8 flex flex-col flex-grow">
                    <div class="flex items-center gap-2 mb-4">
                        <span class="material-symbols-outlined text-[18px] text-outline">location_on</span>
                        <span class="font-label-sm text-on-surface-variant uppercase tracking-widest text-xs font-semibold">Tangerang Selatan</span>
                    </div>
                    <h3 class="font-headline-lg text-2xl text-primary-container mb-6 group-hover:text-primary transition-colors leading-snug font-bold">Lapangan Tenis Terbuka</h3>
                    <div class="mt-auto flex justify-between items-end pt-6 border-t border-surface-variant">
                        <div>
                            <span class="font-label-sm text-outline text-xs uppercase tracking-widest block mb-1 font-semibold">Mulai dari</span>
                            <div class="font-headline-lg text-[28px] text-primary-container font-extrabold tracking-tight">Rp 120.000<span class="font-body-md text-sm font-normal text-on-surface-variant ml-1">/jam</span></div>
                        </div>
                        <button class="w-14 h-14 rounded-full bg-surface-container flex items-center justify-center text-primary-container border border-surface-variant group-hover:bg-primary-container group-hover:text-on-primary group-hover:border-transparent transition-all duration-300">
                            <span class="material-symbols-outlined text-[24px]">arrow_forward</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- How It Works Section -->
<section class="py-32 px-margin-mobile md:px-margin-desktop bg-surface">
    <div class="max-w-container-max mx-auto text-center relative">
        <h2 class="font-headline-lg text-4xl md:text-5xl text-primary-container mb-6 tracking-tight font-extrabold">Pesan dengan Mudah</h2>
        <p class="font-body-lg text-xl text-on-surface-variant mb-20 max-w-3xl mx-auto">Proses yang dirancang untuk mengurangi gangguan, sehingga kamu bisa fokus pada persiapan olahraga.</p>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-16 relative">
            <!-- Connecting Line -->
            <div class="hidden md:block absolute top-12 left-[16.66%] right-[16.66%] h-[2px] bg-surface-variant z-0"></div>
            <!-- Step 1 -->
            <div class="relative z-10 flex flex-col items-center">
                <div class="w-24 h-24 rounded-full bg-surface-container-lowest border border-surface-variant flex items-center justify-center mb-8 shadow-sm text-primary-container transition-transform duration-300 hover:scale-110 hover:shadow-md">
                    <span class="material-symbols-outlined text-[40px]">search</span>
                </div>
                <h3 class="font-headline-lg text-2xl text-primary-container mb-4 font-bold">1. Cari Lokasi</h3>
                <p class="font-body-md text-lg text-on-surface-variant max-w-xs">Temukan lapangan yang sesuai dengan kebutuhan dan lokasimu.</p>
            </div>
            <!-- Step 2 -->
            <div class="relative z-10 flex flex-col items-center">
                <div class="w-24 h-24 rounded-full bg-surface-container-lowest border border-surface-variant flex items-center justify-center mb-8 shadow-sm text-primary-container transition-transform duration-300 hover:scale-110 hover:shadow-md">
                    <span class="material-symbols-outlined text-[40px]">calendar_today</span>
                </div>
                <h3 class="font-headline-lg text-2xl text-primary-container mb-4 font-bold">2. Pilih Jadwal</h3>
                <p class="font-body-md text-lg text-on-surface-variant max-w-xs">Tentukan waktu yang pas, lihat ketersediaan secara real-time.</p>
            </div>
            <!-- Step 3 -->
            <div class="relative z-10 flex flex-col items-center">
                <div class="w-24 h-24 rounded-full bg-surface-container-lowest border border-surface-variant flex items-center justify-center mb-8 shadow-sm text-on-tertiary-container transition-transform duration-300 hover:scale-110 hover:shadow-md">
                    <span class="material-symbols-outlined text-[40px]">done_all</span>
                </div>
                <h3 class="font-headline-lg text-2xl text-primary-container mb-4 font-bold">3. Mainkan</h3>
                <p class="font-body-md text-lg text-on-surface-variant max-w-xs">Bayar dengan aman dan kamu siap untuk berolahraga.</p>
            </div>
        </div>
    </div>
</section>
@endsection
