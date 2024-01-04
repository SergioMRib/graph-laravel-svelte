<?php

use App\Http\Controllers\InertiaDemoController;
use App\Http\Controllers\SurveyController;
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

Route::get('/', [SurveyController::class, 'index'])->name('survey');
Route::get('/chart', [InertiaDemoController::class, 'singleChart'])->name('chart');
Route::get('/multichart', [InertiaDemoController::class, 'multipleChart'])->name('multichart');
