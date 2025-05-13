<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\OrderController;

Route::get('/order', [OrderController::class, 'create'])->name('order.create');
Route::post('/order', [OrderController::class, 'store'])->name('order.store');
Route::get('/dashboard', [OrderController::class, 'dashboard'])->name('dashboard');



use App\Jobs\SendOrderConfirmationJob;
use App\Models\Order;

Route::get('/test-mail', function () {
    $order = Order::latest()->first(); // or any valid order
    SendOrderConfirmationJob::dispatch($order);
    return 'Dispatched!';
});
