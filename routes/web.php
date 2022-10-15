<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MaterialController;
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

Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout']);


Route::prefix('admin')->middleware('web')->group(function(){
    Route::resource('dashboard', HomeController::class);
    Route::prefix('masterdata')->group(function(){

        // Material Routes

        Route::get('material', [MaterialController::class, 'index']);
        Route::post('material', [MaterialController::class, 'store']);
        Route::get('material/create', [MaterialController::class, 'create']);
        Route::get('material/{id}/edit', [MaterialController::class, 'edit']);
        Route::put('material/{id}/update', [MaterialController::class, 'update']);
        Route::delete('material/{id}/delete', [MaterialController::class, 'destroy']);


        // Tool Routes

        Route::get('tool', [ToolController::class, 'index']);
        Route::post('tool', [ToolController::class, 'store']);
        Route::get('tool/create', [ToolController::class, 'create']);
        Route::get('tool/{id}/edit', [ToolController::class, 'edit']);
        Route::put('tool/{id}/update', [ToolController::class, 'update']);
        Route::delete('tool/{id}/delete', [ToolController::class, 'destroy']);


        // Workers Routes

        Route::get('worker', [WorkerController::class, 'index']);
        Route::post('worker', [WorkerController::class, 'store']);
        Route::get('worker/create', [WorkerController::class, 'create']);
        Route::get('worker/{id}/edit', [WorkerController::class, 'edit']);
        Route::put('worker/{id}/update', [WorkerController::class, 'update']);
        Route::delete('worker/{id}/delete', [WorkerController::class, 'destroy']);
    
    
    });

});