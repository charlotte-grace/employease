<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::name('employees')->prefix('/employees')->group(function () {
    Route::get('/', [App\Http\Controllers\EmployeeController::class, 'index'])->name('index');
    Route::post('/', [App\Http\Controllers\EmployeeController::class, 'store'])->name('store');
    Route::get('/{id}', [App\Http\Controllers\EmployeeController::class, 'show'])->name('show');
    Route::put('/{id}', [App\Http\Controllers\EmployeeController::class, 'update'])->name('update');

    Route::delete('/{id}', [App\Http\Controllers\EmployeeController::class, 'destroy'])->name('destroy');
    //    Route::get('/search', [App\Http\Controllers\EmployeeController::class, 'search'])->name('search');
});
