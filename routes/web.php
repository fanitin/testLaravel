<?php

use App\Http\Controllers\CalcController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\OperationListController;
use Illuminate\Support\Facades\Route;

Route::get('/', [MainController::class, 'home']);
Route::get('/results', [OperationListController::class, 'operationList']);
Route::get('/calc', [CalcController::class, 'genView']);


Route::post('/results', [OperationListController::class, 'operationList']);
Route::post('/calc', [CalcController::class, 'calcCompute']);