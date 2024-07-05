<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HostingController;
use App\Http\Controllers\EventController;

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

Route::post('/register', [AuthController::class, 'register']);
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');



Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout', [AuthController::class, 'webLogout'])->name('logout');

    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::get('/hosting', [HostingController::class, 'index'])->name('hosting');
    Route::get('/api/hosting', [HostingController::class, 'APIindex'])->name('hosting.index');
    Route::get('/api/hosting/{visibility}', [HostingController::class, 'APIfilterByVisibility'])->name('hosting.filter');
    
    Route::get('/yourevents', [EventController::class, 'index'])->name('yourevents');
    
});
