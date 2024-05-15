<?php


use App\Http\Controllers\Calc\CalcController as CalcController;
use App\Http\Controllers\Home\HomeController as HomeController;


use App\Http\Middleware\AdminPanelMiddleware;
use App\Http\Middleware\ResultMiddleware;
use Illuminate\Support\Facades\Route;


Auth::routes();

Route::namespace("App\Http\Controllers\Result")->name('result.')->group( function () {
    Route::get('/result', 'IndexController')->name('index');
    Route::delete('/result/delete/{result}', 'DeleteController')->name('delete');
    Route::get('/result/edit/{result}', 'EditController')->name('edit');
    Route::patch('/result/edited/{result}', 'EditController')->name('edited');
    Route::post('/result', 'IndexController')->name('search');
    Route::post('/calc', 'SaveController')->name('save');
});


Route::middleware(AdminPanelMiddleware::class)->namespace("App\Http\Controllers\Admin")->prefix('admin')->name('admin.')->group(function () {
    Route::prefix('home')->namespace("Home")->name('home.')->group(function () {
        Route::get('/', 'IndexController')->name('index');
    });

    Route::prefix('result')->namespace("Result")->name('result.')->group(function () {
        Route::get('/', 'IndexController')->name('index');
        Route::post('/', 'IndexController')->name('search');
        Route::delete('/delete/{result}', 'DeleteController')->name('delete');
    });
    
    Route::prefix('user')->namespace("User")->name('user.')->group(function () {
        Route::get('/', 'IndexController')->name('index');
        Route::get('/{user}', 'EditController@index')->name('changeRole');
        Route::post('/edited/{user}', 'EditController@edit')->name('changedRole');
    });
    
});


Route::get('/', [HomeController::class, 'home'])->name('home.index');
Route::get('/calc', [CalcController::class, 'index'])->name('calc.index');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');