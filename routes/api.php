<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProcessController;
use App\Http\Controllers\BlogController;

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
Route::get('get-data-web', [ClientController::class, 'getDataCompany']);
Route::get('/get-data-web', [ClientController::class, 'getDataCompany']);
Route::get('/get-data-brands', [ClientController::class, 'getDataBrands']);
Route::get('/get-data-top-project', [ClientController::class, 'getDataTopProject']);
Route::get('/get-data-feedback', [ClientController::class, 'getDataFeedback']);
Route::post('/submit-contact', [ClientController::class, 'submitContact']);
Route::get('/check-slug-table-{slug}', [ClientController::class, 'checkSlugTable']);
Route::get('/get-data-category-project', [ProjectController::class, 'getDataCategoryProject']);
Route::get('/get-all-project', [ProjectController::class, 'getDataAllProject']);
Route::get('/get-project-in-cate-{slug}', [ProjectController::class, 'getProjectInCate']);
Route::get('/get-project-{slug}', [ProjectController::class, 'getProject']);
Route::get('/get-process', [ProcessController::class, 'getProcess']);
Route::get('/get-data-category-blog', [BlogController::class, 'getDataCategoryBlog']);
Route::get('/get-data-all-blog', [BlogController::class, 'getDataAllBlog']);
Route::get('/get-blog-in-cate-{slug}', [BlogController::class, 'getBlogInCate']);
Route::get('/get-detail-blog-{slug}', [BlogController::class, 'getDetailBlog']);
