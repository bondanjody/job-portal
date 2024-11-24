<?php

use App\Http\Controllers\ProfileController;
use App\Http\Middleware\UserRoleMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

// Candidate Dashboard Routes
Route::group(['middleware' => ['auth', 'verified', 'user.role:CANDIDATE'], 'prefix' => 'candidate', 'as' => 'candidate.'], function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// Company Dashboard Routes
Route::group(['middleware' => ['auth', 'verified', 'user.role:COMPANY'], 'prefix' => 'company', 'as' => 'company.'], function () {
    Route::get('/dashboard', function () {
        return view('frontend/company-dashboard.dashboard');
    })->name('dashboard');
});
