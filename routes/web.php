<?php

use App\Http\Controllers\CalcController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OperationEditController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'home']);
Route::get('/results', [OperationEditController::class, 'operationList'])->name('resultView');
Route::get('/calc', [CalcController::class, 'genView']);


Route::post('/results', [OperationEditController::class, 'operationList']);
Route::post('/calc', [CalcController::class, 'calcCompute']);
Route::post('/results/{id}', [OperationEditController::class,'operationDelete']);