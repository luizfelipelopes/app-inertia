<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/test', function () {
    return 'Test Done!';
});

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/users', [UserController::class, 'store']);
    Route::put('/users/{user}/update', [UserController::class, 'update'])->name('users.update');
    Route::get('/users/{user}/show', [UserController::class, 'show'])->name('users.show');
    Route::delete('/users/{user}/destroy', [UserController::class, 'destroy'])->name('users.destroy');

    Route::get('/users/notifications', [UserController::class, 'allNotifications'])->name('users.allNotifications');
    Route::get('/users/{user}/notification', [UserController::class, 'sendNotification'])->name('users.notification');

    Route::get('/users/emails', [UserController::class, 'sendAllEmails'])->name('users.allEmails');
    Route::get('/users/{user}/emails', [UserController::class, 'sendEmail'])->name('users.email');
});

require __DIR__.'/auth.php';
