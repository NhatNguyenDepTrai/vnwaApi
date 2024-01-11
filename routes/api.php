<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/get-data-web', [ClientController::class, 'getDataCompany']);
Route::get('/get-data-web', [ClientController::class, 'getDataCompany']);
Route::get('/get-data-brands', [ClientController::class, 'getDataBrands']);
Route::get('/get-data-top-project', [ClientController::class, 'getDataTopProject']);
Route::get('/get-data-feedback', [ClientController::class, 'getDataFeedback']);
Route::post('/submit-contact', [ClientController::class, 'submitContact']);
