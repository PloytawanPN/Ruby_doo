<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageController;


Route::group(['middleware' => 'custom'], function () {
    Route::get('/', function () {
        return view('layout.signin');
    });
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
    Route::get('/home', function () {
        return view('content.homepage');
    });
    Route::get('/approve', function () {
        return view('content.approve');
    });
    Route::get('/orderlist', function () {
        return view('content.orderlist');
    });
    Route::get('/pickstock', function () {
        return view('content.pickstock');
    });
    Route::get('/approve_stock', function () {
        return view('content.approve_stock');
    });
});
Route::get('images/{filename}', [ImageController::class, 'getImage'])->name('image.get');
Route::get('/clear-alert', function () {
    session()->forget('alert');
    return response()->json(['message' => 'Alert cleared successfully']);
});
