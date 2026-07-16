<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Renter\RenterDashboardController;
use App\Http\Controllers\Renter\RenterVenueController;
use App\Http\Controllers\Renter\RenterBookingController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminVenueController;
use App\Http\Controllers\Admin\AdminAnnouncementController;
use App\Http\Controllers\Admin\AdminPaymentController;

// ==========================================
// PUBLIC ROUTES
// ==========================================
Route::get('/', function () {
    if (auth()->check()) {
        return auth()->user()->role === 'admin'
            ? redirect()->route('admin.dashboard')
            : redirect()->route('renter.dashboard');
    }
    return redirect()->route('login');
});

// ==========================================
// AUTH ROUTES (GUEST ONLY)
// ==========================================
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Halaman pending: hanya bisa diakses oleh user yang sudah login & berstatus pending
Route::get('/pending', function () {
    // Jika belum login, arahkan ke login
    if (!auth()->check()) {
        return redirect()->route('login');
    }
    // Jika sudah di-approve, arahkan ke dashboard sesuai role
    if (auth()->user()->status === 'approved') {
        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('renter.dashboard');
    }
    // Jika ditolak, logout dan arahkan ke login dengan pesan error
    if (auth()->user()->status === 'rejected') {
        auth()->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('login')->withErrors(['email' => 'Maaf, pendaftaran akun Anda telah ditolak oleh Admin.']);
    }
    return view('auth.pending');
})->name('pending')->middleware('auth');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// ==========================================
// ROUTE PENYEWA (RENTER)
// ==========================================
Route::middleware(['auth', 'role:renter'])->name('renter.')->group(function () {
    
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
// ==========================================
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // User Management + Approve/Reject
    Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
    Route::patch('/users/{user}/approve', [AdminUserController::class, 'approve'])->name('users.approve');
    Route::patch('/users/{user}/reject', [AdminUserController::class, 'reject'])->name('users.reject');

    // Venue Management (CRUD)
    Route::resource('venues', AdminVenueController::class);

    // Announcement Management (CRUD)
    Route::resource('announcements', AdminAnnouncementController::class)->except(['show']);

    // Payment Verification
    Route::get('/payments', [AdminPaymentController::class, 'index'])->name('payments.index');
    Route::get('/payments/{payment}', [AdminPaymentController::class, 'show'])->name('payments.show');
    Route::patch('/payments/{payment}/verify', [AdminPaymentController::class, 'verify'])->name('payments.verify');
    Route::patch('/payments/{payment}/reject', [AdminPaymentController::class, 'reject'])->name('payments.reject');
});
