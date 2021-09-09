<?php

use App\Http\Controllers\Admin\CalonAnggotaController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Auth;
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

Route::redirect('/', '/login');

Auth::routes(['except' => 'register']);

Route::group(['middleware' => 'auth'], function () {
    Route::resource('user', UserController::class)->except('show');
    Route::resource('kegiatan', ReportController::class)->only(['index', 'show']);
    Route::resource('calonanggota', CalonAnggotaController::class);
    Route::delete('presensi/destroy/{id}',   [ReportController::class, 'destroy'])->name('presensi.destroy');
});
