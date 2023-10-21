<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\GetDataController;

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
// get method api(Get data All)
Route::get('get/api/data',[GetDataController::class,'getData']);

// post method api(Create Data)
Route::post('category',[GetDataController::class,'category']);
Route::post('contact',[GetDataController::class,'contact']);

// delete
Route::post('category/delete',[GetDataController::class,'categoryDelete']);
Route::get('category/delete/{id}',[GetDataController::class,'deleteget']);

//detail
Route::post('category/detail',[GetDataController::class,'categoryDetail']);
Route::get('category/{id}',[GetDataController::class,'getcategoryDetail']);

// Update
Route::post('category/update',[GetDataController::class,'categoryUpdate']);




/*
get  http://127.0.0.1:8000/api/get/api/data (data pull)

post localhost:8000/api/category (data put)
post localhost:8000/api/contact

delete post localhost:8000/api/category/delete
*/
