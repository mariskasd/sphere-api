<?php

use Illuminate\Http\Request;
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
Route::prefix('auth')->group(function () {
    Route::post('/login', 'AuthController@login');
    Route::post('/register', 'AuthController@register');
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::prefix('auth')->group(function () {
        Route::get('/profile', 'AuthController@getProfile');
        Route::put('/edit-profile', 'AuthController@editProfile');
        Route::put('/edit-password', 'AuthController@editPassword');
        Route::post('/logout', 'AuthController@logout');
    });
    Route::prefix('report')->group(function () {
        Route::get('/', 'ReportZoneController@getMyReport');
        Route::get('/all', 'ReportZoneController@getAllReport');
        Route::get('/unassigned', 'ReportZoneController@getUnassignedReport');
        Route::get('/task', 'ReportZoneController@getMyTask');
        Route::get('/{id}', 'ReportZoneController@getReportById');
        Route::post('/posting', 'ReportZoneController@report');
        Route::post('/solved/{id}', 'ReportZoneController@solvedTask');
        Route::post('/assign/{id}', 'ReportZoneController@assignReport');
        
    });
    Route::prefix('teknisi')->group(function () {
        Route::get('/', 'ReportZoneController@getTeknisi');
    });
    Route::prefix('river')->group(function () {
        Route::get('/list', 'RiverHeightController@getListRiver');
        Route::get('/{id}', 'RiverHeightController@getRiverHeight');
        Route::post('/height', 'RiverHeightController@report');
        Route::post('/report/{id}', 'ReportRiverController@report');
        Route::get('/report/task', 'ReportRiverController@getMyTask');
    });
    Route::prefix('notif')->group(function () {
        Route::get('/', 'RiverHeightController@getListNotif');
    });
});
