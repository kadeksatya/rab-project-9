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
    
    
    });

});