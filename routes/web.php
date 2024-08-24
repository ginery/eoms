<?php


use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MessagesController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\ArchivedController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProposeController;
use App\Http\Controllers\ProgramsController;
use App\Http\Controllers\InProgressController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', function () {
    return redirect()->route('login');
});
Route::middleware('auth')->group(function () {
    {/*
    * With auth middle where
    * Routes for Profiling
    *
    */}
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/documents', [DocumentController::class, 'index'])->name('documents');
    Route::get('/documents/{id}', [DocumentController::class, 'folder'])->name('folder.folder');
    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::get('/messages', [MessagesController::class, 'index'])->name('messages');
    Route::get('/reports', [ReportsController::class, 'index'])->name('reports');
    Route::get('/archived', [ArchivedController::class, 'index'])->name('archived');
    Route::get('/propose', [ProposeController::class, 'index'])->name('propose');
    Route::get('/programs', [ProgramsController::class, 'index'])->name('programs');
    Route::get('/in-progress', [InProgressController::class, 'index'])->name('in-progress');
});


require __DIR__.'/auth.php';
