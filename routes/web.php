<?php

use App\Http\Controllers\ProfileController;
use App\Http\Middleware\UserRoleMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'user.role:CANDIDATE'])->name('dashboard');

Route::get('company/dashboard', function () {
    return view('frontend/company-dashboard.dashboard');
})->middleware(['auth', 'verified', 'user.role:COMPANY'])->name('company/dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
