<?php

use App\Http\Controllers\Admin\BackupController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\GoogleLoginController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StatisticsController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/about', function () {
    return view('about');
})->name('about');
Route::get('/login/google', [GoogleLoginController::class, 'redirectToGoogle'])->name('login.google');
Route::get('/login/google/callback', [GoogleLoginController::class, 'handleGoogleCallback']);

Route::resource('products', ProductController::class);
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

Route::middleware(['role:admin'])->group(function () {
    Route::get('/admin/product', [ProductController::class, 'adminIndex'])->name('admin.products.index');
    Route::get('/admin/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/admin/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/admin/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
    // Route::post('/admin/products/{id}/restore', [ProductController::class, 'restore'])->name('products.restore');
    Route::get('/admin/statistics', [StatisticsController::class, 'index'])->name('statistics');
    Route::get('/admin/invoices', [InvoiceController::class, 'index'])->name('invoice.index');
    Route::get('/admin/users',[RegisteredUserController::class, 'index'])->name('admin.users.index');
    Route::get('/admin/users', [RegisteredUserController::class, 'index'])->name('admin.users.index');
    Route::get('/admin/users/{user}/edit', [RegisteredUserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/admin/users/{user}', [RegisteredUserController::class, 'update'])->name('admin.users.update');
    Route::delete('/admin/users/{user}', [RegisteredUserController::class, 'destroy'])->name('admin.users.destroy');
    Route::get('/admin/notifications', [NotificationController::class, 'index'])->name('admin.notifications.index');
    Route::post('/admin/notifications/send', [NotificationController::class, 'send'])->name('admin.notifications.send');
    Route::get('/admin/backup', [BackupController::class, 'index'])->name('admin.backup.index');
    Route::post('/admin/backup', [BackupController::class, 'backup'])->name('admin.backup');
    Route::get('/admin/backup/download', [BackupController::class, 'download'])->name('admin.backup.download');
});



Route::middleware(['auth'])->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::put('/update/{cart}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/remove/{cart}', [CartController::class, 'remove'])->name('cart.remove');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/invoice/{invoice}', [InvoiceController::class, 'show'])->name('invoice.show');
    Route::post('/invoice/{invoice}/pay', [InvoiceController::class, 'pay'])->name('invoice.pay');
    Route::get('/invoice/{invoice}/confirm', [InvoiceController::class, 'confirmPayment'])->name('invoice.confirm');
    Route::get('/my-invoices', [InvoiceController::class, 'userInvoices'])->name('user.invoices');
    Route::get('/checkout', [CartController::class, 'showCheckoutForm'])->name('checkout.form');
    Route::post('/checkout', [CartController::class, 'processCheckout'])->name('checkout.process');
    Route::post('/invoice/{invoice}/cancel', [InvoiceController::class, 'cancel'])->name('invoice.cancel');
});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
