<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('frontend.welcome');
});
Route::get('/about', [App\Http\Controllers\FrontEndController::class, 'about'])->name('about');
Route::get('/services', [App\Http\Controllers\FrontEndController::class, 'services'])->name('services');
Route::get('/service-details', [App\Http\Controllers\FrontEndController::class, 'service_details'])->name('service_details');
Route::get('/cars', [App\Http\Controllers\FrontEndController::class, 'cars'])->name('cars');
Route::get('/car-details', [App\Http\Controllers\FrontEndController::class, 'car_details'])->name('car_details');
Route::get('/contact', [App\Http\Controllers\FrontEndController::class, 'contact'])->name('contact');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
