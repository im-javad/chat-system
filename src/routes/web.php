<?php

use App\Http\Controllers\MessageController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [MessageController::class , 'index'])->name('home.index');
Route::post('/msg' , [MessageController::class , 'storageMsg'])->name('msg');

Auth::routes();
