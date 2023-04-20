<?php

use Illuminate\Support\Facades\Route;

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
    return view('home');
});

Route::get('/employee/{id}', [\App\Http\Livewire\ReadEmployee::class, '__invoke']);
Route::get('/employees', [\App\Http\Livewire\HomeEmployees::class, '__invoke']);
Route::get('/employees/create', [\App\Http\Livewire\CreateEmployee::class, '__invoke']);
Route::get('/employees/{id}/edit', [\App\Http\Livewire\EditEmployee::class, '__invoke']);
