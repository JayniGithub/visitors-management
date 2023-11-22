<?php

use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubUserController;
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
    return view('auth.login');
});

Route::get('/register', [CustomAuthController::class, 'registration'])->name('registration');
Route::post('/custom-registration', [CustomAuthController::class, 'customRegistration'])->name('registration.custom');
Route::get('/login', [CustomAuthController::class, 'index'])->name('login');
Route::post('/custom-login', [CustomAuthController::class, 'login'])->name('login.custom');
Route::get('/dashboard', [CustomAuthController::class, 'dashboard'])->name('dashboard');
Route::get('/logout', [CustomAuthController::class, 'logout'])->name('logout');

Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
Route::post('/edit-profile', [ProfileController::class, 'edit'])->name('profile.edit');

Route::get('/sub-user', [SubUserController::class, 'index'])->name('sub-user');
Route::get('/sub-user/fetch-all', [SubUserController::class, 'fetchAll'])->name('sub-user.fetchAll');
Route::get('/sub-user-add', [SubUserController::class, 'subUser'])->name('add-sub-user.view');
Route::post('/sub-user/add', [SubUserController::class, 'addNewUser'])->name('new-sub-user.add');
Route::get('/sub-user/edit/{id}', [SubUserController::class, 'edit'])->name('sub-user.edit');
Route::post('/sub-user/update', [SubUserController::class, 'update'])->name('new-sub-user.update');
Route::get('/sub-user/delete/{id}', [SubUserController::class, 'delete'])->name('sub-user.delete');