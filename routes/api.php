<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\CarController;
use App\Http\Controllers\Api\GetCarController;
use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\ReviewController;
use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\FaqController;

Route::prefix('auth')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('reset-password', [AuthController::class, 'resetPassword']);
    Route::post('reset-password-confirm', [AuthController::class, 'resetPasswordConfirm']);
    Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('user/profile', [UserController::class, 'profile']);
    Route::put('user/update', [UserController::class, 'updateProfile']);
    Route::get('user/bookings', [UserController::class, 'userBookings']);
    Route::get('user/favorites', [UserController::class, 'favorites']);
});

Route::prefix('cars')->group(function () {
    Route::get('/', [CarController::class, 'index']);
    Route::get('/{id}', [CarController::class, 'carById']);
    Route::get('/getCars', [GetCarController::class, 'index'])->middleware('auth:sanctum', 'isAdmin');
    Route::post('/', [CarController::class, 'createCar'])->middleware('auth:sanctum', 'isAdmin');
    Route::put('{id}', [CarController::class, 'update'])->middleware('auth:sanctum', 'isAdmin');
    Route::delete('{id}', [CarController::class, 'destroy'])->middleware('auth:sanctum', 'isAdmin');
});

Route::middleware('auth:sanctum')->prefix('bookings')->group(function () {
    Route::post('/', [BookingController::class, 'store']);
    Route::get('/', [BookingController::class, 'index']);
    Route::get('{id}', [BookingController::class, 'show']);
    Route::put('{id}/cancel', [BookingController::class, 'cancel']);
});

Route::prefix('reviews')->group(function () {
    Route::post('/', [ReviewController::class, 'store'])->middleware('auth:sanctum');
    Route::get('car/{carId}', [ReviewController::class, 'carReviews']);
    Route::put('{id}', [ReviewController::class, 'update'])->middleware('auth:sanctum');
    Route::delete('{id}', [ReviewController::class, 'destroy'])->middleware('auth:sanctum');
});

Route::middleware('auth:sanctum', 'isAdmin')->prefix('admin')->group(function () {
    Route::get('users', [AdminController::class, 'indexUsers']);
    Route::post('users', [AdminController::class, 'storeUser']);
    Route::put('users/{id}', [AdminController::class, 'updateUser']);
    Route::delete('users/{id}', [AdminController::class, 'destroyUser']);
    Route::get('bookings', [AdminController::class, 'indexBookings']);
    Route::get('cars', [AdminController::class, 'manageCars']);
});

Route::prefix('faqs')->group(function () {
    Route::get('faqs', [FaqController::class, 'index']);
    Route::post('faqs', [FaqController::class, 'store'])->middleware('auth:sanctum', 'isAdmin');
    Route::put('faqs/{id}', [FaqController::class, 'update'])->middleware('auth:sanctum', 'isAdmin');
    Route::delete('faqs/{id}', [FaqController::class, 'destroy'])->middleware('auth:sanctum', 'isAdmin');
});