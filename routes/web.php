<?php

use App\Http\Controllers\AdvertisementController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes();

Route::get('/', function () {
    return redirect('advertisement');
});

Route::get('advertisement/admin', [AdvertisementController::class, 'admin'])
    ->name('advertisement.admin');

Route::get('advertisement/category/{id}', [AdvertisementController::class, 'adsByCategory'])
    ->name('advertisement.adsByCategory');

Route::resource('advertisement', AdvertisementController::class);