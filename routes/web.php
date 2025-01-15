<?php

use App\Http\Controllers\AdvertisementController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// Route::get('/', function () {
//     return redirect('advertisement');
// });

// Route::get('advertisement/admin', [AdvertisementController::class, 'admin'])
//     ->name('advertisement.admin');

// Route::get('advertisement/category/{id}', [AdvertisementController::class, 'adsByCategory'])
//     ->name('advertisement.adsByCategory');

// Route::resource('advertisement', AdvertisementController::class);

Route::get('/', function () {
    return redirect('advertisement');
});

Route::get('advertisement/admin', [AdvertisementController::class, 'admin'])
    ->name('advertisement.admin');

Route::get('advertisement/category/{id}', [AdvertisementController::class, 'adsByCategory'])
    ->name('advertisement.adsByCategory');

Route::resource('advertisement', AdvertisementController::class);


