<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginRegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::controller(LoginRegisterController::class)->group(function() {
    Route::get('/register', 'register')->name('register');
    Route::post('/store', 'store')->name('store');
    Route::get('/login', 'login')->name('login');
    Route::post('/authenticate', 'authenticate')->name('authenticate');
    Route::get('/', 'timeline')->name('timeline');
    Route::post('/logout', 'logout')->name('logout');
    Route::get('/add', 'event_get')->name('events.view')->middleware('auth');
    Route::post('/add', 'event_post')->name('events.add')->middleware('auth');
    Route::get('/modify/{id}', 'event_modify')->name('events.modify')->middleware('auth');
    Route::delete('/eventDelete/{id}', 'event_destroy') ->name('events.destroy')->middleware('auth'); 
    Route::patch('/eventPatch/{id}', 'event_patch') ->name('events.patch')->middleware('auth');
});
