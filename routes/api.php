<?php

use App\Http\Controllers\API\LocationController;
use App\Http\Controllers\AuthCheckController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/register/check', [AuthCheckController::class, 'check'])->name('auth-check');
Route::get('provinces', [LocationController::class, 'provinces'])->name('province');
Route::get('regencies/{provinces_id}', [LocationController::class, 'regencies'])->name('regency');
Route::get('districts/{regencies_id}', [LocationController::class, 'districts'])->name('district');
Route::get('villages/{districts_id}', [LocationController::class, 'villages'])->name('villages');
