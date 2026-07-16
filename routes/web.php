<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Renter\RenterDashboardController;
use App\Http\Controllers\Renter\RenterVenueController;
use App\Http\Controllers\Renter\RenterBookingController;

// ==========================================
// PUBLIC ROUTES
// ==========================================
Route::get('/', function () {
    return redirect()->route('renter.dashboard');
});

// ==========================================
// ROUTE PENYEWA (RENTER)
// Catatan: Middleware Auth belum diterapkan
// ==========================================
Route::name('renter.')->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [RenterDashboardController::class, 'index'])->name('dashboard');

    // Katalog Lapangan
    Route::get('/venues', [RenterVenueController::class, 'index'])->name('venues.index');
    Route::get('/venues/{slug}', [RenterVenueController::class, 'show'])->name('venues.show');
    Route::get('/venues/{id}/availability', [RenterVenueController::class, 'availability'])->name('venues.availability');
    Route::post('/venues/{venue}/book', [RenterBookingController::class, 'store'])->name('venues.book');

    // Riwayat Booking & Detail
    Route::get('/bookings', [RenterBookingController::class, 'index'])->name('bookings.index');
    Route::get('/bookings/{booking_code}', [RenterBookingController::class, 'show'])->name('bookings.show');
    Route::get('/bookings/{booking_code}/invoice', [RenterBookingController::class, 'invoice'])->name('bookings.invoice');
    Route::post('/bookings/{booking_code}/cancel', [RenterBookingController::class, 'cancel'])->name('bookings.cancel');
    Route::post('/bookings/{booking_code}/pay', [RenterBookingController::class, 'pay'])->name('bookings.pay');
});

// ==========================================
// ROUTE ADMIN
// Catatan: Middleware Auth & Role belum diterapkan
// ==========================================
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');
});
