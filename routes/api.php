<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Event;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HostingController;



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

    Route::get('/hosting/{visibility}', [HostingController::class, 'filterByVisibility'])->name('hosting.filter');

    // Route::get('/events', function () {
    //     return Event::all();
    // });

    Route::get('/api/hosting', [HostingController::class, 'APIindex'])->name('hosting.index');
    Route::get('/api/hosting/{visibility}', [HostingController::class, 'APIfilterByVisibility'])->name('hosting.filter');
    Route::post('/hosting/store', [HostingController::class, 'store']);
    Route::delete('/hosting/delete/{id}', [HostingController::class, 'destroy']);
    Route::put('/hosting/update/{id}', [HostingController::class, 'update']);
});
