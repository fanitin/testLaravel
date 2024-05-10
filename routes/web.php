<?php

use App\Http\Controllers\CalcController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;



Route::group(['namespace' => 'App\Http\Controllers\Result'], function () {
    Route::get('/result', IndexController::class)->name('result.index');
    Route::delete('/result/delete/{result}', DeleteController::class)->name('result.delete');
    Route::get('/result/edit/{result}', EditController::class)->name('result.edit');
    Route::patch('/result/edited/{result}', EditedController::class)->name('result.edited');
    Route::post('/result', IndexController::class)->name('result.search');
    Route::post('/calc', SaveController::class)->name('result.save');
});



Route::get('/', [HomeController::class, 'home'])->name('home.index');
Route::get('/calc', [CalcController::class, 'index'])->name('calc.index');