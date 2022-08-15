<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ViewChatBot;
use App\Http\Controllers\getRequestController;
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

Route::get('/', [ViewChatBot::class, 'page'] )->name('initial-page');

Route::post('/aadhaarService/{menu?}', [getRequestController::class, 'getAadharService']);

Route::post('/getInputQuery', [getRequestController::class, 'processQuery']);


