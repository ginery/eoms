<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\UserController; 
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'documents'], function () {
    Route::post('/add-documents', [DocumentController::class, 'create']);
    Route::get('/get-documents', [DocumentController::class, 'getDocument']);
    Route::get('/get-documents/{user_added}', [DocumentController::class, 'getDocumentByUser']);
    
    //add another api route here. 
});

Route::group(['prefix' => 'users'], function () {
    Route::post('/add', [UserController::class, 'create']);
    //add another api route here. 
});