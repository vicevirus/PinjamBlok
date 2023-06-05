<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\TransactController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;

use Illuminate\Http\Request;

Route::middleware('auth:sanctum')->group(function () {
    // Routes that require authentication and email verification
    Route::get('/', function () {
        return view('welcome');
    })->name('dashboard');

    // ** Rooms **
    Route::get('/rooms', [RoomController::class, 'index'])->name('room.index');
    Route::get('/rooms/add', [RoomController::class, 'add'])->name('room.add');
    Route::post('/rooms/add', [RoomController::class, 'storeRoom'])->name('room.store');

    // ** Items **
    Route::get('/items', [ItemController::class, 'index'])->name('item.index');

    // ** Transacts ** 
    Route::get('/transacts', [TransactController::class, 'index'])->name('transact.index');
    Route::get('/transacts/store', [TransactController::class, 'store'])->name('transact.store')->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);


    Route::get('/generate-qrcode/{itemId}', [ItemController::class, 'generateQRCode'])->name('item.generateqr');
    // ** Log Out **
    Route::get('/logout', function () {
        Auth::logout();
        return redirect('/');
    })->name('logout');
});









Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
