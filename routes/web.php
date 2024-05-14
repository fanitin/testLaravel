<?php


use App\Http\Controllers\Admin\Result\DeleteController as AdminDeleteController;
use App\Http\Controllers\Calc\CalcController as CalcController;
use App\Http\Controllers\Home\HomeController as HomeController;
use App\Http\Controllers\Admin\Home\IndexController as AdminHomeIndexController;
use App\Http\Controllers\Admin\Result\IndexController as AdminResultIndexController;
use App\Http\Controllers\Admin\User\IndexController as AdminUserIndexController;
use App\Http\Controllers\Admin\User\EditController as AdminUserEditController;

use App\Http\Middleware\AdminPanelMiddleware;
use App\Http\Middleware\ResultMiddleware;
use Illuminate\Support\Facades\Route;


Auth::routes();

Route::middleware(ResultMiddleware::class)->namespace("App\Http\Controllers\Result")->group( function () {
    Route::get('/result', IndexController::class)->name('result.index');
    Route::delete('/result/delete/{result}', DeleteController::class)->name('result.delete');
    Route::get('/result/edit/{result}', EditController::class)->name('result.edit');
    Route::patch('/result/edited/{result}', EditedController::class)->name('result.edited');
    Route::post('/result', IndexController::class)->name('result.search');
    Route::post('/calc', SaveController::class)->name('result.save');
});


Route::middleware(AdminPanelMiddleware::class)->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', AdminHomeIndexController::class)->name('index');

    Route::prefix('result')->name('result.')->group(function () {
        Route::get('/', AdminResultIndexController::class)->name('index');
        Route::post('/', AdminResultIndexController::class)->name('search');
        Route::delete('/delete/{result}', AdminDeleteController::class)->name('delete');
    });
    
    Route::prefix('user')->name('user.')->group(function () {
        Route::get('/', AdminUserIndexController::class)->name('index');
        Route::get('/{user}', [AdminUserEditController::class, 'index'])->name('changeRole');
        Route::post('/edited/{user}', [AdminUserEditController::class, 'edit'])->name('changedRole');
    });
    
});


Route::get('/', [HomeController::class, 'home'])->name('home.index');
Route::get('/calc', [CalcController::class, 'index'])->name('calc.index');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');