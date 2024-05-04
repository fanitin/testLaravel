<?php

use App\Http\Controllers\CalcController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OperationEditController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'home'])->name('home.index');
Route::get('/calc', [CalcController::class, 'genView'])->name('calc.index');
Route::get('/results', [OperationEditController::class, 'operationList'])->name('result.index');
Route::get('/result/edit', [OperationEditController::class, 'operationSendToEdit']);


Route::post('/results', [OperationEditController::class, 'operationList']);
Route::post('/calc', [CalcController::class, 'calcCompute']);
Route::post('/result/delete', [OperationEditController::class,'operationDelete']);
Route::post('/result/edited', [OperationEditController::class,'operationEdit']);
Route::post('/result/edit', [OperationEditController::class,'operationSendToEdit']);