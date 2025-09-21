<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Route untuk halaman beranda
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/test-layout', function () {
    return view('layouts.app');
});

// Route untuk autentikasi
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::post('/reports/{report_id}/respond', [AdminController::class, 'respond'])->name('admin.respond');
});

Route::middleware(['auth', 'role:staff'])->prefix('seller')->group(function () {
    Route::get('/products', [SellerController::class, 'index'])->name('seller.products.index');
    Route::get('/products/create', [SellerController::class, 'create'])->name('seller.products.create');
    Route::post('/products', [SellerController::class, 'store'])->name('seller.products.store');
    Route::get('/products/{id}/edit', [SellerController::class, 'edit'])->name('seller.products.edit');
    Route::put('/products/{id}', [SellerController::class, 'update'])->name('seller.products.update');
    Route::delete('/products/{id}', [SellerController::class, 'destroy'])->name('seller.products.destroy');
});

Route::middleware(['auth', 'role:customer'])->prefix('customer')->group(function () {
    Route::get('/products', [CustomerController::class, 'index'])->name('customer.products.index');
    Route::post('/orders', [CustomerController::class, 'createOrder'])->name('customer.orders.store');
    Route::post('/reports', [CustomerController::class, 'createReport'])->name('customer.reports.store');
});