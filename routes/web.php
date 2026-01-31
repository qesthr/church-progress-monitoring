<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'showLoginRegister'])->name('auth.show');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Role-based dashboards
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard/pastor', function(){ return "Pastor Dashboard"; });
    Route::get('/dashboard/leader', function(){ return "Leader Dashboard"; });
    Route::get('/dashboard/disciple', function(){ return "Disciple Dashboard"; });
}); 

require __DIR__.'/auth.php';