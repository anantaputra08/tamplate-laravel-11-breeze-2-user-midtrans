<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HandlePaymentNotifController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('user.dashboard'); // Updated path to the dashboard view
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Authenticated User Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin Routes
Route::middleware(['auth', \App\Http\Middleware\RoleMiddleware::class . ':admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('dashboard');

        Route::resource('users', UserController::class)->except(['show']);
        Route::resource('products', ProductController::class)->except(['show']);
        Route::resource('orders', OrderController::class);
    });

Route::middleware(['auth', \App\Http\Middleware\RoleMiddleware::class . ':user'])
    ->prefix('user')
    ->name('user.')
    ->group(function () {
        // Route::get('/dashboard', function () {
        //     return view('user.dashboard'); // User dashboard view
        // })->name('dashboard');
    
        Route::resource('products', ProductController::class)->only(['index']);
        Route::get('/checkout/{product_id}', [PaymentController::class, 'checkout'])->name('checkout');
        Route::post('/process-payment', [PaymentController::class, 'processPayment'])->name('processPayment');
        Route::post('/payment/notification', [PaymentController::class, 'notificationHandler'])->name('payment.notification');
        Route::post('/payment/recurring-notification', [PaymentController::class, 'recurringNotificationHandler'])->name('payment.recurringNotification');
        Route::post('/payment/pay-account-notification', [PaymentController::class, 'payAccountNotificationHandler'])->name('payment.payAccountNotification');
        Route::get('/payment/finish', [PaymentController::class, 'finishRedirect'])->name('payment.finishRedirect');
        Route::get('/payment/unfinished', [PaymentController::class, 'unfinishedRedirect'])->name('payment.unfinishedRedirect');
        Route::get('/payment/error', [PaymentController::class, 'errorRedirect'])->name('payment.errorRedirect');
        Route::get('/payment-success', [PaymentController::class, 'paymentSuccess'])->name('payment.success');
        Route::get('/orders', [OrderController::class, 'index'])->name('orders.index'); // Route baru untuk menampilkan transaksi
    });

// Forbidden Route
Route::get('/forbidden', function () {
    return view('forbidden'); // Forbidden view
})->name('forbidden');

// Catch-all route for 404 errors
Route::fallback(function () {
    return view('errors.404'); // 404 view
});

// Authentication Routes
require __DIR__ . '/auth.php';
