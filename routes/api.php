<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\UserController; 
use App\Http\Controllers\ChatController; 
use App\Http\Controllers\ReportsController; 
use App\Http\Controllers\ArchivedController; 
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
    Route::get('/get-documentstoedit/{id}', [DocumentController::class, 'getDocumentToEdit']);
    Route::delete('/delete-documents', [DocumentController::class, 'destroy']);
    Route::post('/update-documents', [DocumentController::class, 'update']);
    Route::post('/upload', [DocumentController::class, 'upload']);
    Route::delete('/delete-file', [DocumentController::class, 'deleteFile']);
    //add another api route here. 
});

Route::group(['prefix' => 'users'], function () {
    Route::post('/add', [UserController::class, 'create']);
    Route::post('/update', [UserController::class, 'update']);
    Route::delete('/delete/{id}', [UserController::class, 'delete']);
    Route::get('/get/{id}', [UserController::class, 'get']);
    //add another api route here. 
});
Route::group(['prefix' => 'messages'], function () {
    Route::post('/send', [ChatController::class, 'sendMessage']);
    
});
Route::group(['prefix' => 'reports'], function () {
    Route::get('/generate', [ReportsController::class, 'generate']);
    
});
Route::group(['prefix' => 'archived'], function () {
    Route::post('/update', [ArchivedController::class, 'update']);
    Route::post('/complete', [ArchivedController::class, 'complete']);
    
});