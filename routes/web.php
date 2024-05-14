<?php


use App\Http\Controllers\Admin\Result\DeleteController as AdminDeleteController;
use App\Http\Controllers\Calc\CalcController as CalcController;
use App\Http\Controllers\Home\HomeController as HomeController;
use App\Http\Controllers\Admin\Home\IndexController as AdminIndexController;
use App\Http\Controllers\Admin\Result\IndexController as ResultIndexController;
use Illuminate\Support\Facades\Route;



Route::group(['namespace' => 'App\Http\Controllers\Result'], function () {
    Route::get('/result', IndexController::class)->name('result.index');
    Route::delete('/result/delete/{result}', DeleteController::class)->name('result.delete');
    Route::get('/result/edit/{result}', EditController::class)->name('result.edit');
    Route::patch('/result/edited/{result}', EditedController::class)->name('result.edited');
    Route::post('/result', IndexController::class)->name('result.search');
    Route::post('/calc', SaveController::class)->name('result.save');
});


Route::group(['namespace' => 'App\Http\Controllers\Admin', 'prefix' => 'admin'], function () {
    Route::get('/', AdminIndexController::class)->name('admin.index');
    Route::get('/result', ResultIndexController::class)->name('admin.result.index');
    Route::delete('/result/delete/{result}', AdminDeleteController::class)->name('admin.result.delete');
    Route::post('/result', ResultIndexController::class)->name('admin.result.search');
});




Route::get('/', [HomeController::class, 'home'])->name('home.index');
Route::get('/calc', [CalcController::class, 'index'])->name('calc.index');