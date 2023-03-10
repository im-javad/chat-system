<?php

use App\Http\Controllers\MessageController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [MessageController::class , 'index'])->name('home.index');

Route::prefix('/messages')->group(function(){
    Route::post('' , [MessageController::class , 'storageMsg'])->name('messages.storage');
    Route::delete('/{message}/destroy' , [MessageController::class , 'destroy'])->name('messages.destroy');
});

Auth::routes();
