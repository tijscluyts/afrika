<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FarmingController;

// Startpunt: De Login pagina
Route::get('/', [FarmingController::class, 'showLogin'])->name('login');

// Verwerk de login gegevens
Route::post('/login', [FarmingController::class, 'login']);

// Het persoonlijke dashboard van de boer
Route::get('/profile/{id}', [FarmingController::class, 'profile'])->name('profile');
