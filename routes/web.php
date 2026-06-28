<?php

use App\Http\Controllers\Admin\CarController;
use App\Http\Controllers\Admin\CarTypeController;
use App\Http\Controllers\Admin\RentDetailController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MyRequestsController;

Route::get('/', [App\Http\Controllers\FrontEndController::class, 'welcome'])->name('welcome');
Route::get('/about', [App\Http\Controllers\FrontEndController::class, 'about'])->name('about');
Route::get('/services', [App\Http\Controllers\FrontEndController::class, 'services'])->name('services');
Route::get('/service-details', [App\Http\Controllers\FrontEndController::class, 'service_details'])->name('service_details');
Route::get('/car', [App\Http\Controllers\FrontEndController::class, 'cars'])->name('car');
Route::get('/car-details/{car}', [App\Http\Controllers\FrontEndController::class, 'car_details'])->name('car_details');
Route::get('/contact', [App\Http\Controllers\FrontEndController::class, 'contact'])->name('contact');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// Profile Routes
Route::prefix('profile')->name('profile.')->middleware('auth')->group(function(){
    Route::get('/', [HomeController::class, 'getProfile'])->name('detail');
    Route::post('/update', [HomeController::class, 'updateProfile'])->name('update');
    Route::post('/change-password', [HomeController::class, 'changePassword'])->name('change-password');
});

// Car Type Routes
Route::prefix('carType')->name('carType.')->middleware('auth')->group(function(){
    Route::get('/', [CarTypeController::class, 'index'])->name('index');
    Route::get('/create', [CarTypeController::class, 'create'])->name('create');
    Route::post('/store', [CarTypeController::class, 'store'])->name('store');
    Route::post('/update', [CarTypeController::class, 'update'])->name('update');
});


// User Management (Admin)
Route::prefix('users')->name('users.')->middleware('auth')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('/create', [UserController::class, 'create'])->name('create');
    Route::post('/store', [UserController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [UserController::class, 'edit'])->name('edit');
    Route::put('/{id}/update', [UserController::class, 'update'])->name('update');
    Route::post('/{id}/disable', [UserController::class, 'disable'])->name('disable');
    Route::post('/{id}/enable', [UserController::class, 'enable'])->name('enable');
});

// My Requests (Customer)
Route::prefix('my-requests')->name('myRequests.')->middleware('auth')->group(function () {
    Route::get('/', [MyRequestsController::class, 'index'])->name('index');
    Route::post('/store', [MyRequestsController::class, 'store'])->name('store');
});

// Rent Detail Routes
Route::prefix('rent-requests')->name('rentDetails.')->middleware('auth')->group(function () {
    Route::get('/', [RentDetailController::class, 'index'])->name('index');
    Route::post('/{id}/approve', [RentDetailController::class, 'approve'])->name('approve');
    Route::post('/{id}/reject', [RentDetailController::class, 'reject'])->name('reject');
});

// Car Routes
Route::prefix('cars')->name('cars.')->middleware('auth')->group(function(){
    Route::get('/', [CarController::class, 'index'])->name('index');
    Route::get('/create', [CarController::class, 'create'])->name('create');
    Route::post('/store', [CarController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [CarController::class, 'edit'])->name('edit');
    Route::put('/{id}/update', [CarController::class, 'update'])->name('update');
    Route::delete('/{id}/destroy', [CarController::class, 'destroy'])->name('destroy');
});
