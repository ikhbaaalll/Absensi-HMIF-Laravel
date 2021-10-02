<?php

use App\Http\Controllers\Api\KegiatanControllerApi;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => 'api', 'prefix' => 'v1'], function () {
    Route::post('login',        [UserController::class, 'login']);
    Route::post('logout',       [UserController::class, 'logout']);

    Route::post('kegiatan/absen',   [KegiatanControllerApi::class, 'absen']);

    Route::post('kegiatan/checkpassword/{id}', [KegiatanControllerApi::class, 'checkPassword']);

    Route::apiResource('kegiatan',  KegiatanControllerApi::class)->only(['store', 'index', 'show', 'destroy']);

    Route::post('absen/{id}',       [KegiatanControllerApi::class, 'setAbsen']);
});
