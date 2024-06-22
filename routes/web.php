<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;

Route::get('/', [LoginController::class,'index'])->name('login');
Route::get('/adminlogin', [LoginController::class,'adminlogin'])->name('adminlogin');
Route::post('/login-proses', [LoginController::class,'login_proses'])->name('loginproses');
Route::get('/logout', [LoginController::class,'logout'])->name('logout');
Route::get('/pengajuan', [HomeController::class, 'pengajuan'])->name('pengajuan');
Route::post('/pengajuansubmit', [HomeController::class, 'pengajuansubmit'])->name('pengajuansubmit');
Route::get('/register', [LoginController::class,'register'])->name('register');
Route::post('/register-proses', [LoginController::class,'register_proses'])->name('registerproses');
Route::get('/dashboard', [LoginController::class, 'dashboard'])->name('dashboard');

Route::group(['prefix' => 'admin','middleware' => ['auth','role:admin'], 'as' => 'admin.'], function(){
    Route::get('/user', [HomeController::class, 'index'])->name('index');
    Route::get('/approval', [HomeController::class, 'approval'])->name('approval');
    Route::get('/create', [HomeController::class, 'create'])->name('user.create');
    Route::post('/store', [HomeController::class, 'store'])->name('user.store');
    Route::get('/edit/{id}', [HomeController::class, 'edit'])->name('user.edit');
    Route::put('/update/{id}', [HomeController::class, 'update'])->name('user.update');
    Route::post('/delete', [HomeController::class, 'delete'])->name('user.delete');
});


