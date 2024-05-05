<?php

use App\Http\Controllers\CalcController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OperationEditController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'home'])->name('home.index');
Route::get('/calc', [CalcController::class, 'genView'])->name('calc.index');
Route::get('/result', [OperationEditController::class, 'operationList'])->name('result.index');
Route::get('/result/delete/{result}', [OperationEditController::class,'operationDelete'])->name('result.delete');
Route::get('/result/edit/{result}', [OperationEditController::class,'operationSendToEdit'])->name('result.edit');



Route::post('/result', [OperationEditController::class, 'operationList'])->name('result.search');
Route::post('/calc', [CalcController::class, 'calcCompute'])->name('calc.compute');



Route::patch('/result/edited', [OperationEditController::class,'operationEdit'])->name('result.edited');