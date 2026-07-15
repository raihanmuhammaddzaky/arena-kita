<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Announcement;

class AnnouncementSeeder extends Seeder
{
    public function run(): void
    {
        Announcement::create([
            'title' => 'Pemeliharaan Lapangan Futsal A',
            'content' => 'Pemberitahuan: Lapangan Futsal A (Premium) akan ditutup sementara untuk perbaikan lantai pada akhir pekan ini. Mohon maaf atas ketidaknyamanan ini.',
        ]);

        Announcement::create([
            'title' => 'Promo Diskon Akhir Tahun',
            'content' => 'Dapatkan diskon 20% untuk semua penyewaan lapangan tenis pada bulan Desember! Gunakan kode promo: TENIS20 saat melakukan pemesanan.',
        ]);
    }
}
