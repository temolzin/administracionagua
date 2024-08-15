<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;

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

Route::get('/', function () {
    return view('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::resource('users', UserController::class);
    
    Route::resource('roles', RoleController::class);

    Route::post('/users/{user}/updateRole', [UserController::class, 'updateRole'])->name('users.updateRole');
});
