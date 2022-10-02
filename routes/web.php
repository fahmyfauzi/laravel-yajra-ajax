<?php

use App\Http\Controllers\PegawaiController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/home', [PegawaiController::class, 'index'])->name('home-index');

Route::post('/home/tambah-pegawai', [PegawaiController::class, 'store'])->name('home-store');
Route::get('/home/pegawai/{pegawai}', [PegawaiController::class, 'show'])->name('home-show');

Route::put('/home/pegawai/{pegawai}', [PegawaiController::class, 'update'])->name('home-update');

route::delete('/home/pegawai/{id}', [PegawaiController::class, 'destroy'])->name('home-delete');
