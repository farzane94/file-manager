<?php

use App\Http\Controllers\FileController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::controller(ProfileController::class)->prefix('profile')->name('profile.')->group(function () {
        Route::get('/', 'edit')->name('edit');
        Route::patch('/', 'update')->name('update');
        Route::delete('/', 'destroy')->name('destroy');
    });

    Route::get('/dashboard', [FileController::class, 'index'])->name('dashboard');
    Route::resource('files', FileController::class)->only(['index', 'store', 'destroy']);
    Route::get('/files/{file}/download', [FileController::class, 'download'])->name('files.download');


});

require __DIR__ . '/auth.php';
