<?php

use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

Route::get('/', [MainController::class, 'home']);

Route::get('/calc', [MainController::class, 'calc']);

Route::get('/results', [MainController::class, 'results']);