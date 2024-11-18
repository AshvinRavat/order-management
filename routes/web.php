<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;


Route::controller(AdminController::class)->group(function () {
    Route::get('', 'index')->middleware('auth')->name('index');
    Route::get('login', 'login')->middleware('guest')->name('login');
    Route::post('authenticate', 'authenticate')->middleware('guest')->name('authenticate');
    Route::post('logout', 'logout')->middleware('auth')->name('logout');
});


Route::controller(OrderController::class)->middleware('auth')->group(function () {
    Route::get('order', 'index')->name('order.index');
    Route::get('order/create', 'create')->name('order.create');
    Route::post('order/store', 'store')->name('order.store');
    Route::post('order/delete/{order}', 'delete')->name('order.delete');
});