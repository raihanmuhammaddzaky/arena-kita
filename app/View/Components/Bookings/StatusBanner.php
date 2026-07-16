<?php

namespace App\View\Components\Bookings;

use App\Models\Booking;
use Illuminate\View\Component;

class StatusBanner extends Component
{
    public Booking $booking;

    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
    }

    public function getConfig(): array
    {
        return match ($this->booking->status) {
            'Pending' => [
                'bg' => 'bg-[#f59e0b]/10 border-[#f59e0b]/30',
                'icon_bg' => 'bg-[#f59e0b] text-on-primary',
                'icon' => 'schedule',
                'title_color' => 'text-[#b45309]',
                'title' => 'Pending',
                'description' => 'Selesaikan pembayaran sebelum batas waktu.',
                'show_deadline' => true,
            ],
            'Confirmed' => [
                'bg' => 'bg-tertiary-fixed border-tertiary-fixed-dim/30',
                'icon_bg' => 'bg-on-tertiary-fixed-variant text-primary',
                'icon' => 'check_circle',
                'title_color' => 'text-on-tertiary-fixed-variant',
                'title' => 'Confirmed',
                'description' => 'Lapangan telah berhasil disewa dan siap digunakan.',
                'show_deadline' => false,
            ],
            'Waiting Verification' => [
                'bg' => 'bg-secondary-container border-secondary/30',
                'icon_bg' => 'bg-secondary text-on-secondary',
                'icon' => 'hourglass_top',
                'title_color' => 'text-on-secondary-container',
                'title' => 'Menunggu Konfirmasi',
                'description' => 'Bukti pembayaran telah kami terima dan sedang ditinjau oleh Admin.',
                'show_deadline' => false,
            ],
            default => [
                'bg' => 'bg-surface-variant/30 border-outline-variant/30',
                'icon_bg' => 'bg-on-surface-variant text-surface',
                'icon' => 'cancel',
                'title_color' => 'text-on-surface-variant',
                'title' => 'Cancelled',
                'description' => 'Pesanan ini telah dibatalkan atau melewati batas waktu pembayaran.',
                'show_deadline' => false,
            ],
        };
    }

    public function render()
    {
        return view('components.bookings.status-banner', [
            'config' => $this->getConfig()
        ]);
    }
}
