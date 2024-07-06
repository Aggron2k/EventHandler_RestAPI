<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Event;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HostingController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\InviteController;



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

Route::post('/register', [AuthController::class, 'apiRegister']);
Route::post('/login', [AuthController::class, 'apiLogin']);


Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout', [AuthController::class, 'apiLogout']);

    Route::post('/update-status', [HomeController::class, 'updateStatus'])->name('update-status');

    Route::post('/hosting/store', [HostingController::class, 'store']);
    Route::delete('/hosting/delete/{id}', [HostingController::class, 'destroy']);
    Route::put('/hosting/update/{id}', [HostingController::class, 'update']);

    Route::get('/yourevents', [EventController::class, 'fetchEvents']);
    Route::post('/change-status', [EventController::class, 'changeStatus']);

    Route::get('/users', [InviteController::class, 'getUsers']);
    Route::post('/invite', [InviteController::class, 'sendInvite']);

});
