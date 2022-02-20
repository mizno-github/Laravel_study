<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('todo')->group(function () {
    Route::controller(TodoController::class)->group(function () {
        Route::get('', 'showIndex')->name('showIndex');
        Route::get('/create', 'showCreateView')->name('showCreate');
        Route::post('/create', 'create')->name('create');
        Route::get('/{id}', 'showUpdateView')->name('showUpdate');
        Route::put('/{id}', 'update')->name('update');
        Route::delete('/{id}', 'delete')->name('delete');
    });
});
