<?php

use App\Http\Controllers\CalcController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OperationEditController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'home'])->name('home.index');
Route::get('/calc', [CalcController::class, 'genView'])->name('calc.index');
Route::get('/result', [OperationEditController::class, 'index'])->name('result.index');
Route::delete('/result/delete/{result}', [OperationEditController::class,'destroy'])->name('result.delete');
Route::get('/result/edit/{result}', [OperationEditController::class,'operationSendToEdit'])->name('result.edit');



Route::post('/result', [OperationEditController::class, 'index'])->name('result.search');
Route::post('/calc', [CalcController::class, 'calcCompute'])->name('calc.compute');



Route::patch('/result/edited', [OperationEditController::class,'edit'])->name('result.edited');