/**
 * ============================================
 * ArenaKita - Booking Form Manager
 * ============================================
 * Mengelola pemilihan jam, pengecekan ketersediaan,
 * dan kalkulasi harga pada halaman detail venue.
 *
 * File ini di-load oleh komponen booking-form.blade.php
 * Data dinamis dibaca dari atribut data-* pada elemen HTML.
 * ============================================
 */

document.addEventListener('DOMContentLoaded', function () {

    // ==========================================
    // 1. INISIALISASI: Ambil Elemen & Data
    // ==========================================

    const form            = document.getElementById('booking-form');
    if (!form) return; // Hanya jalan di halaman yang ada form booking

    const venuePrice      = parseInt(form.dataset.venuePrice)  || 0;
    const venueId         = parseInt(form.dataset.venueId)     || 0;

    const dateInput       = form.querySelector('input[type="date"]');
    const gridContainer   = document.getElementById('time-slot-grid');
    const spinner         = document.getElementById('loading-spinner');
    const displayDuration = document.getElementById('display-duration');
    const displayPrice    = document.getElementById('display-price');
    const startInput      = document.getElementById('start_time');
    const endInput        = document.getElementById('end_time');
    const selectionError  = document.getElementById('selection-error');
    const customAlert     = document.getElementById('custom-alert');

    let selectedSlots = [];

    // ==========================================
    // 2. UTILITAS: Fungsi Pembantu Kecil
    // ==========================================

    /**
     * Format angka ke Rupiah (contoh: 150000 → "Rp 150.000")
     */
    function formatRupiah(angka) {
        return 'Rp ' + new Intl.NumberFormat('id-ID').format(angka);
    }

    /**
     * Hasilkan daftar slot waktu operasional (08:00 – 22:00).
     * Setiap slot berdurasi 1 jam.
     * Return: [{ start: "08:00", end: "09:00" }, ...]
     */
    function generateAllSlots() {
        const slots = [];
        for (let jam = 8; jam <= 21; jam++) {
            const start = String(jam).padStart(2, '0') + ':00';
            const end   = String(jam + 1).padStart(2, '0') + ':00';
            slots.push({ start, end });
        }
        return slots;
    }

    /**
     * Cek apakah sebuah slot (misal "10:00") jatuh di dalam
     * rentang waktu yang sudah di-booking orang lain.
     */
    function isSlotBooked(slot, bookedSlots) {
        return bookedSlots.some(function (booked) {
            const bStart = booked.start_time.substring(0, 5);
            const bEnd   = booked.end_time.substring(0, 5);
            return slot.start >= bStart && slot.start < bEnd;
        });
    }

    /**
     * Cek apakah slot-slot yang dipilih pengguna berurutan
     * (tidak boleh ada jam yang loncat/bolong).
     */
    function isSelectionContiguous() {
        if (selectedSlots.length <= 1) return true;

        var sorted = selectedSlots.slice().sort();
        for (var i = 1; i < sorted.length; i++) {
            var prevEnd   = parseInt(sorted[i - 1].split('-')[1].split(':')[0]);
            var currStart = parseInt(sorted[i].split('-')[0].split(':')[0]);
            if (prevEnd !== currStart) return false;
        }
        return true;
    }

    // ==========================================
    // 3. KALKULASI: Durasi & Harga
    // ==========================================

    /**
     * Hitung durasi dan total harga berdasarkan
     * jumlah slot yang dipilih, lalu perbarui tampilan.
     */
    function calculateTotals() {
        var duration = selectedSlots.length;
        displayDuration.textContent = duration + ' Jam';
        displayPrice.textContent    = formatRupiah(duration * venuePrice);

        if (duration > 0) {
            var sorted    = selectedSlots.slice().sort();
            startInput.value = sorted[0].split('-')[0];
            endInput.value   = sorted[sorted.length - 1].split('-')[1];
        } else {
            startInput.value = '';
            endInput.value   = '';
        }
    }

    // ==========================================
    // 4. UI UPDATE: Perbarui Tampilan Tombol
    // ==========================================

    /**
     * Perbarui gaya visual tombol (warna aktif/non-aktif)
     * dan validasi apakah pilihan berurutan.
     */
    function updateSelectionUI() {
        selectedSlots.sort();

        // Validasi: harus berurutan
        if (!isSelectionContiguous()) {
            selectionError.textContent = 'Mohon pilih jam yang berurutan (tidak boleh melompat).';
            selectionError.classList.remove('hidden');
            displayDuration.textContent = '0 Jam';
            displayPrice.textContent    = 'Rp 0';
            startInput.value = '';
            endInput.value   = '';
            return;
        }

        selectionError.classList.add('hidden');
        calculateTotals();

        // Perbarui warna tombol
        var buttons = gridContainer.querySelectorAll('button:not(:disabled)');
        buttons.forEach(function (btn) {
            var slotValue = btn.dataset.slot;
            if (selectedSlots.includes(slotValue)) {
                btn.classList.remove('bg-surface-container-low', 'text-on-surface');
                btn.classList.add('bg-primary', 'text-on-primary', 'border-primary');
            } else {
                btn.classList.add('bg-surface-container-low', 'text-on-surface');
                btn.classList.remove('bg-primary', 'text-on-primary', 'border-primary');
            }
        });
    }

    // ==========================================
    // 5. EVENT HANDLER: Klik Tombol Slot
    // ==========================================

    /**
     * Menangani klik pada satu tombol slot waktu.
     * Jika sudah dipilih → batalkan. Jika belum → pilih.
     */
    function handleSlotClick(e) {
        var slotValue = e.currentTarget.dataset.slot;

        if (selectedSlots.includes(slotValue)) {
            selectedSlots = selectedSlots.filter(function (s) { return s !== slotValue; });
        } else {
            selectedSlots.push(slotValue);
        }

        updateSelectionUI();
    }

    // ==========================================
    // 6. RENDER: Gambar Tombol Jam ke Layar
    // ==========================================

    /**
     * Menggambar seluruh tombol jam ke dalam grid container.
     * Tombol yang sudah dipesan diberi warna abu-abu dan disabled.
     */
    function renderTimeSlots(bookedSlots) {
        gridContainer.innerHTML = '';
        var allSlots = generateAllSlots();

        allSlots.forEach(function (slot) {
            var booked = isSlotBooked(slot, bookedSlots);

            var btn       = document.createElement('button');
            btn.type      = 'button';
            btn.dataset.slot = slot.start + '-' + slot.end;
            btn.textContent  = slot.start;

            // Gaya dasar
            var baseClasses = 'font-label-md text-[12px] py-2 rounded-xl border transition-colors';

            if (booked) {
                btn.className = baseClasses + ' bg-surface-container-highest border-outline-variant/30 text-on-surface-variant opacity-50 cursor-not-allowed';
                btn.disabled  = true;
                btn.title     = 'Sudah dipesan';
            } else {
                btn.className = baseClasses + ' bg-surface-container-low border-outline-variant/50 text-on-surface hover:border-primary/50';
                btn.addEventListener('click', handleSlotClick);
            }

            gridContainer.appendChild(btn);
        });
    }

    // ==========================================
    // 7. FETCH: Ambil Data Ketersediaan dari API
    // ==========================================

    /**
     * Mengirim permintaan ke API /venues/{id}/availability
     * lalu menggambar ulang tombol slot berdasarkan hasilnya.
     */
    async function fetchAvailability(date) {
        if (!date) return;

        // Reset state
        spinner.classList.remove('hidden');
        gridContainer.innerHTML = '';
        selectedSlots = [];
        updateSelectionUI();

        try {
            var response    = await fetch('/venues/' + venueId + '/availability?date=' + date);
            var data        = await response.json();
            var bookedSlots = data.booked_slots || [];

            renderTimeSlots(bookedSlots);

        } catch (error) {
            console.error('Gagal memuat ketersediaan:', error);
            gridContainer.innerHTML = '<p class="col-span-full text-center text-error text-sm">Gagal memuat jadwal.</p>';
        } finally {
            spinner.classList.add('hidden');
        }
    }

    // ==========================================
    // 8. VALIDASI FORM: Cek Sebelum Submit
    // ==========================================

    /**
     * Mencegah pengiriman form jika pengguna
     * belum memilih slot jam sama sekali.
     */
    function handleFormSubmit(e) {
        if (!startInput.value || !endInput.value) {
            e.preventDefault();

            // Tampilkan alert kustom
            if (customAlert) {
                customAlert.classList.remove('hidden');
                setTimeout(function () {
                    customAlert.classList.add('hidden');
                }, 3000);
            }

            selectionError.textContent = 'Silakan pilih kotak jam di atas.';
            selectionError.classList.remove('hidden');
        }
    }

    // ==========================================
    // 9. BOOT: Pasang Event Listener & Muat Awal
    // ==========================================

    dateInput.addEventListener('change', function (e) {
        fetchAvailability(e.target.value);
    });

    form.addEventListener('submit', handleFormSubmit);

    // Muat ketersediaan otomatis jika tanggal sudah terisi
    if (dateInput.value) {
        fetchAvailability(dateInput.value);
    }
});
