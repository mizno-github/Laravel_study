<?php

use Illuminate\Support\Facades\Route;

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

// admin_userというテキストをdumpRequestに渡している
// dumpRequest:userにするとdumpRequestのif文に入らない
Route::get('/', function () {
    return view('welcome');
})->middleware('dumpRequest:admin_user');
