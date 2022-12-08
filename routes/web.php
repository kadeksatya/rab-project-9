<?php

use App\Http\Controllers\AdministratorController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\OverBudgetController;
use App\Http\Controllers\RABController;
use App\Http\Controllers\RABDetailController;
use App\Http\Controllers\ToolController;
use App\Http\Controllers\WorkController;
use App\Http\Controllers\WorkDetailController;
use App\Http\Controllers\WorkerController;
use App\Http\Controllers\WorkTypeController;
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


Route::prefix('admin')->middleware('auth:web')->group(function(){
    Route::resource('dashboard', HomeController::class);
    
    // OverBudget Routes

    Route::get('overbudget', [OverBudgetController::class, 'index']);
    Route::post('overbudget', [OverBudgetController::class, 'store']);
    Route::get('overbudget/{id}/detail', [OverBudgetController::class, 'show']);
    Route::get('overbudget/{id}/create', [OverBudgetController::class, 'create']);
    Route::get('overbudget/{id}/edit', [OverBudgetController::class, 'edit']);
    Route::put('overbudget/{id}/update', [OverBudgetController::class, 'update']);
    Route::delete('overbudget/{id}/{rab_id}/delete', [OverBudgetController::class, 'destroy']);

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
    
        
        // Work Type 

        Route::get('worktype', [WorkTypeController::class, 'index']);
        Route::post('worktype', [WorkTypeController::class, 'store']);
        Route::get('worktype/create', [WorkTypeController::class, 'create']);
        Route::get('worktype/{id}/edit', [WorkTypeController::class, 'edit']);
        Route::put('worktype/{id}/update', [WorkTypeController::class, 'update']);
        Route::delete('worktype/{id}/delete', [WorkTypeController::class, 'destroy']);


    });

    Route::prefix('rab')->group(function(){

        // Work Routes

        Route::get('work', [WorkController::class, 'index']);
        Route::post('work', [WorkController::class, 'store']);
        Route::get('work/create', [WorkController::class, 'create']);
        Route::get('work/{id}/edit', [WorkController::class, 'edit']);
        Route::put('work/{id}/update', [WorkController::class, 'update']);
        Route::delete('work/{id}/delete', [WorkController::class, 'destroy']);
        Route::get('work/{id}/detail', [WorkController::class, 'show']);

        Route::prefix('work')->group(function(){
            Route::post('workdetail', [WorkDetailController::class, 'store']);
            Route::get('workdetail/{id}/create', [WorkDetailController::class, 'create']);
            Route::get('workdetail/{id}/edit', [WorkDetailController::class, 'edit']);
            Route::put('workdetail/{id}/update', [WorkDetailController::class, 'update']);
            Route::delete('workdetail/{id}/delete', [WorkDetailController::class, 'destroy']);
        });



        // RABS Routes

        Route::get('rabs', [RABController::class, 'index']);
        Route::post('rabs', [RABController::class, 'store']);
        Route::get('rabs/create', [RABController::class, 'create']);
        Route::get('rabs/{id}/edit', [RABController::class, 'edit']);
        Route::put('rabs/{id}/update', [RABController::class, 'update']);
        Route::delete('rabs/{id}/delete', [RABController::class, 'destroy']);
        Route::get('rabs/{id}/detail', [RABController::class, 'show']);
        Route::get('rabs/{id}/print', [RABController::class, 'print']);

        Route::prefix('rabs')->group(function(){
            Route::post('rabsdetail', [RABDetailController::class, 'store']);
            Route::get('rabsdetail/{id}/create', [RABDetailController::class, 'create']);
            Route::get('rabsdetail/{id}/edit', [RABDetailController::class, 'edit']);
            Route::put('rabsdetail/{id}/update', [RABDetailController::class, 'update']);
            Route::delete('rabsdetail/{id}/{rab_id}/delete', [RABDetailController::class, 'destroy']);
            Route::get('rabsdetail/{id}/getDatas', [RABDetailController::class, 'getDatas']);
        });

    

    });

        // Administrator Routes

        Route::get('administrator', [AdministratorController::class, 'index']);
        Route::post('administrator', [AdministratorController::class, 'store']);
        Route::get('administrator/create', [AdministratorController::class, 'create']);
        Route::get('administrator/{id}/edit', [AdministratorController::class, 'edit']);
        Route::put('administrator/{id}/update', [AdministratorController::class, 'update']);
        Route::delete('administrator/{id}/delete', [AdministratorController::class, 'destroy']);

});