<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LangController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::middleware(['checkAdmin'])->group(function () {
    Route::resource('users', UserController::class);
    Route::get('/', function () {
        return view('home');
    });
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});

Route::prefix('tasks')->middleware(['checkAdmin'])->controller(TaskController::class)->name('tasks.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/{user_id}', 'getTasksByUserId')->name('get_tasks_by_user_id');
    Route::get('/{user_id}/create', 'create')->name('create');
    Route::get('/{id}', 'show')->name('show');
    Route::get('/edit/{id}', 'edit')->name('edit');
    Route::post('/', 'store')->name('store');
    Route::put('/{id}', 'update')->name('update');
    Route::delete('/{id}', 'destroy')->name('destroy');
});

Auth::routes();

Route::get('lang/{language}', [LangController::class, 'changeLanguage'])->name('lang');
