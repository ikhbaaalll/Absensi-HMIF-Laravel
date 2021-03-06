<?php

use App\Http\Controllers\Admin\CalonAnggotaController;
use App\Http\Controllers\Admin\DataController;
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

    Route::resource('kegiatan', ReportController::class)->only(['index', 'show', 'edit', 'update']);

    Route::post('calonanggota/generate/{calonanggotum}', [CalonAnggotaController::class, 'generate'])->name('calonanggota.generate');
    Route::get('calonanggota/123cc/import',   [CalonAnggotaController::class, 'importView'])->name('calonanggota.excel');
    Route::post('calonanggota/import',   [CalonAnggotaController::class, 'importStore'])->name('calonanggota.importStore');
    Route::resource('calonanggota', CalonAnggotaController::class);

    Route::get('/data', [DataController::class, 'index'])->name('data.presensi');
});
