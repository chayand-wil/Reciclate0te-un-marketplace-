<?php


use App\Http\Controllers\AuthController;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;


Route::post('/login', [AuthController::class, 'login']);



Route::middleware(['auth:api'])->group(function () {
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);
    
     

    Route::middleware(RoleMiddleware::class . ':admin')->group(function () {
        Route::get('/admin-data', function () {
            return response()->json(['data' => 'Solo admin puede ver esto']);
        });
        Route::post('/users', [AdminController::class, 'store']);
        Route::get('/users', [AdminController::class, 'index']);   
        Route::get('/uniqueuser/{id}', [AdminController::class, 'uniqueUser']);   
        Route::post('/updateUser', [AdminController::class, 'updateUser']);   
        Route::get('/deleteUser/{id}', [AdminController::class, 'destroy']);   
        
        Route::get('/get_contador/{id}', [AdminController::class, 'getContador']);
        Route::post('/update_contador', [AdminController::class, 'updateContador']);   
    });



    Route::middleware(RoleMiddleware::class . ':ayudante')->group(function () {
        Route::get('/ayudante-data', function () {
            return response()->json(['data' => 'Solo ayudante puede ver esto']);
        });
    });


});



