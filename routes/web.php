<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FarmingController;

// Dit is de enige route die je nodig hebt voor de homepage
Route::get('/', [FarmingController::class, 'index']);
