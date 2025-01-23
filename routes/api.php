<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\UserController; 
use App\Http\Controllers\ChatController; 
use App\Http\Controllers\ReportsController; 
use App\Http\Controllers\ArchivedController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProgramsController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProposeController;
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
// dashboard
Route::group(['prefix' => 'dashboard', 'middleware' => 'auth:sanctum'], function () {
    Route::post('/dashboard-status', [DashboardController::class, 'getDocumentStatus']);
    Route::post('/token', [DashboardController::class, 'update_token']);
    Route::post('/test', [DashboardController::class, 'test']);
});
// documents
Route::group(['prefix' => 'documents',  'middleware' => 'auth:sanctum'], function () {
    Route::post('/add-documents', [DocumentController::class, 'create']);
    Route::get('/get-documents', [DocumentController::class, 'getDocument']);
    Route::get('/get-documents/{user_added}', [DocumentController::class, 'getDocumentByUser']);
    Route::get('/get-documentstoedit/{id}', [DocumentController::class, 'getDocumentToEdit']);
    Route::delete('/delete-documents', [DocumentController::class, 'destroy']);
    Route::post('/update-documents', [DocumentController::class, 'update']);
    Route::post('/upload', [DocumentController::class, 'upload']);
    Route::delete('/delete-file', [DocumentController::class, 'deleteFile']);
    Route::get('/documents/{id}', [DocumentController::class, 'show'])->name('documents.show');
    Route::post('/update-status', [DocumentController::class, 'updateStatus']);
    Route::post('/send-email', [DocumentController::class, 'sendEmail']);
    //add another api route here. 
});
// users
Route::group(['prefix' => 'users', 'middleware' => 'auth:sanctum'], function () {
    Route::post('/add', [UserController::class, 'create']);
    Route::post('/update', [UserController::class, 'update']);
    Route::delete('/delete/{id}', [UserController::class, 'delete']);
    Route::get('/get/{id}', [UserController::class, 'get']);
    Route::post('/update-profile', [UserController::class, 'update_profile']);
    //add another api route here. 
});
// messages
Route::group(['prefix' => 'messages', 'middleware' => 'auth:sanctum'], function () {
    Route::post('/send', [ChatController::class, 'sendMessage']);
    
});

Route::group(['prefix' => 'reports', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/generate', [ReportsController::class, 'generate']);
    
});

Route::group(['prefix' => 'archived', 'middleware' => 'auth:sanctum'], function () {
    Route::post('/update', [ArchivedController::class, 'update']);
    Route::post('/complete', [ArchivedController::class, 'complete']);
    
});
// programs
Route::group(['prefix' => 'programs', 'middleware' => 'auth:sanctum'], function () {
    Route::post('/add', [ProgramsController::class, 'add']);
    Route::post('/view-requirements/{id}', [ProgramsController::class, 'get_info']);
    Route::post('/view-comments/{id}', [ProgramsController::class, 'get_comments']);
    Route::post('/add-comments', [ProgramsController::class, 'add_comments']);
    Route::get('/get/{id}', [ProgramsController::class, 'get']);
    Route::delete('/delete/{id}', [ProgramsController::class, 'delete']);
    Route::post('/update', [ProgramsController::class, 'update']);
    Route::get('/get_users/{id}', [ProgramsController::class, 'get_user']);
});

// notification
Route::group(['prefix' => 'notification', 'middleware' => 'auth:sanctum'], function () {
    Route::post('/update', [NotificationController::class, 'update']);
});

// propose
Route::group(['prefix' => 'propose', 'middleware' => 'auth:sanctum'], function () {
    Route::post('/details', [ProposeController::class, 'view_details']);
});