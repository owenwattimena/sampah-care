<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\AuthController;
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

Route::middleware(['auth:admin'])->group(function () {
    Route::get('/', function () {
        return view('templates.index');
    });

    Route::prefix('admin')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('admin');
        Route::post('/', [AdminController::class, 'create'])->name('admin.create');
        Route::put('/{id}', [AdminController::class, 'update'])->name('admin.update');
        Route::delete('/{id}', [AdminController::class, 'delete'])->name('admin.delete');
    });
    Route::get('keluar', function(){
        \Auth::guard('admin')->logout();
        return redirect()->route('masuk');
    })->name('keluar');
});
Route::middleware(['guest:admin'])->group(function () {
    Route::prefix('masuk')->group(function () {
        Route::get('/', [AuthController::class, 'masuk'])->name('masuk');
        Route::post('/', [AuthController::class, 'prosesMasuk'])->name('masuk.proses');
    });
});
