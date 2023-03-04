<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GuruController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\OperatorController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\TahunAjaranController;
use App\Http\Controllers\WaktuController;
use App\Http\Controllers\AbsenController;

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


Route::resource('/', DashboardController::class);
Route::resource('/jurusan', JurusanController::class);
Route::resource('/siswa', SiswaController::class);
Route::resource('/waktu', WaktuController::class);
Route::resource('/mapel', MapelController::class);
Route::resource('/guru', GuruController::class);
Route::resource('/link', LinkController::class);
Route::resource('/ruangan', RuanganController::class);
Route::resource('/tahun_ajaran', TahunAjaranController::class);
Route::resource('/operator', OperatorController::class);

Route::resource('/absen-siswa', AbsenController::class);
Route::get('/siapkan-ruangan', [AbsenController::class, 'AbsenRuangUi']);
Route::post('/absenRuang', [AbsenController::class, 'AbsenRuang']);


Route::post('/siswa/s/import',[SiswaController::class,'Import']);
Route::post('/guru/g/import',[GuruController::class,'Import']);
Route::post('/jurusan/j/import',[JurusanController::class,'Import']);
Route::post('/mapel/m/import',[MapelController::class,'Import']);
