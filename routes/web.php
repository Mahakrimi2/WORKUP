<?php

use App\Http\Controllers\PmController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\SalleController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::middleware(['admincheck'])->group(function () {
        Route::get('admin/salles/show', [SalleController::class, 'show'])->name(('salles.show'));
        Route::post('admin/salles/store', [SalleController::class, 'store'])->name(('salles.store'));
        Route::delete('admin/salles/delete/{id}', [SalleController::class, 'delete'])->name(('salles.delete'));
        Route::put('admin/salles/edit/{id}', [SalleController::class, 'edit'])->name(('salles.edit'));


        Route::get('admin/users/show', [UserController::class, 'show'])->name(('users.show'));
        Route::post('admin/users/store', [UserController::class, 'store'])->name(('users.store'));
        Route::delete('admin/users/delete/{id}', [UserController::class, 'delete'])->name(('users.delete'));
        Route::put('admin/users/edit/{id}', [UserController::class, 'edit'])->name(('users.edit'));
    });

    Route::get('admin/reservations/salle', [ReservationController::class, 'salle'])->name(('reservations.salle'));
    Route::get('admin/reservations/date/{id}', [ReservationController::class, 'date'])->name(('reservations.date'));

    Route::post('admin/reservations/store/{id}', [ReservationController::class, 'store'])->name(('reservations.store'));
    Route::get('admin/reservations/show/{id}', [ReservationController::class, 'show'])->name(('reservations.show'));
    Route::post('admin/reservations/addUser', [ReservationController::class, 'addUser'])->name(('reservations.addUser'));
    Route::delete('admin/reservations/exitUser', [ReservationController::class, 'exitUser'])->name(('reservations.exitUser'));
    Route::delete('admin/reservations/deleteRes', [ReservationController::class, 'deleteRes'])->name(('reservations.deleteRes'));
    Route::put('admin/reservations/edit/{id}', [ReservationController::class, 'edit'])->name(('reservations.edit'));

    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
});
