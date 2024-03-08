<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageController;

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


Route::group(['middleware' => 'custom'], function () {
    Route::get('/signin', function () {
        return view('layout.signin');
    });
    Route::get('/signup', function () {
        return view('layout.signup');
    });
    Route::get('/expenses', function () {
        return view('content.expenses');
    });
    Route::get('/revenue', function () {
        return view('content.revenue');
    });
    Route::get('/dashboard', function () {
        return view('content.dashboard');
    });
    Route::get('/stock', function () {
        return view('content.stock');
    });
});
Route::get('images/{filename}', [ImageController::class, 'getImage'])->name('image.get');
