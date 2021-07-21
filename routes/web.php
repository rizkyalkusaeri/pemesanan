<?php

use App\Http\Controllers\BahanController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProduksiController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Foundation\Auth\EmailVerificationRequest;

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/home');
})->middleware(['auth'])->name('verification.verify');

Auth::routes(['verify' => true]);


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('order', OrderController::class)->except(['show']);
    Route::get('/invoice/evidence/{id}', [InvoiceController::class, 'edit'])->name('invoice.edit');
    Route::post('/invoice/evidence/{id}', [InvoiceController::class, 'update'])->name('invoice.update');

    Route::get('/transaksi', [OrderController::class, 'addOrder'])->name('order.transaksi');
    Route::get('/checkout', [OrderController::class, 'checkout'])->name('order.checkout');
    Route::post('/checkout', [OrderController::class, 'storeOrder'])->name('order.storeOrder');
    Route::put('/order/diterima/{id}', [OrderController::class, 'diterima'])->name('order.diterima');

    Route::middleware(['checkRole:admin'])->group(function () {
        Route::resource('/user', UserController::class);
    });

    Route::middleware(['checkRole:admin,direktur'])->group(function () {
        Route::resource('/product', ProductController::class)->except('show');
        Route::get('/invoice', [InvoiceController::class, 'index'])->name('invoice.index');
        Route::get('/invoice/{id}', [InvoiceController::class, 'create'])->name('invoice.create');
        Route::post('/invoice/{id}', [InvoiceController::class, 'store'])->name('invoice.store');
        Route::put('/invoice/{id}', [InvoiceController::class, 'setuju'])->name('invoice.setuju');

        Route::put('/order/setuju/{id}', [OrderController::class, 'setujui'])->name('order.setujui');
        Route::put('/order/tolak/{id}', [OrderController::class, 'tolak'])->name('order.tolak');

        Route::get('/purchase', [PurchaseController::class, 'index'])->name('purchase.index');
        Route::get('/purchase/{id}', [PurchaseController::class, 'create'])->name('purchase.create');
        Route::post('/purchase/{id}', [PurchaseController::class, 'store'])->name('purchase.store');
        Route::put('/purchase/{id}', [PurchaseController::class, 'update'])->name('purchase.update');

        Route::get('job-order/{id}', [OrderController::class, 'job_order'])->name('job');
        Route::post('job-order-store/{id}', [OrderController::class, 'job_order_store'])->name('job.store');
    });

    Route::middleware(['checkRole:admin,gudang,direktur'])->group(function () {
        Route::resource('/bahan', BahanController::class)->except(['show']);
    });

    Route::middleware(['checkRole:admin,ppic,direktur'])->group(function () {
        Route::resource('/produksi', ProduksiController::class);
        Route::get('/delivery', [DeliveryController::class, 'index'])->name('delivery.index');
        Route::get('/delivery/{id}', [DeliveryController::class, 'create'])->name('delivery.create');
        Route::post('/delivery/{id}', [DeliveryController::class, 'store'])->name('delivery.store');
        Route::get('/delivery/show/{id}', [DeliveryController::class, 'show'])->name('delivery.show');
    });
});