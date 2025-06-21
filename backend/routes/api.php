<?php


use App\Http\Controllers\AuthController;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\PublicationController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\SolicitudController;
use App\Models\Publication;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AdminController::class, 'store']);
Route::get('/get_catalogos/{table}', [PublicController::class, 'getCatalogo']);
Route::get('/get_catalogos_articles', [PublicController::class, 'getCatalogoArticles']);



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
    
    
    
    Route::middleware(RoleMiddleware::class . ':reutilizador')->group(function () {
        Route::get('/reutilizador-data', function () {
            return response()->json(['data' => 'Solo reutilizador puede ver esto']);
        });

        Route::get('/publication/{id}', [PublicationController::class, 'getPublication']);   
        Route::post('/publication', [PublicationController::class, 'store']);   
        Route::get('/publications/{id}', [PublicationController::class, 'getPubs']);   
        Route::get('/publications', [PublicationController::class, 'index']);   
        Route::get('/get_catalogo/{table}', [PublicController::class, 'getCatalogo']);
        Route::get('/get_catalogo/{id}/{table}', [PublicController::class, 'getTableById']);
        Route::post('/articulo_solicitud', [SolicitudController::class, 'store']);   
        Route::get('/getMisSolicitudes/{id_user}', [SolicitudController::class, 'getMisSolicitudes']);   
        Route::patch('/getMisSolicitudes/{id_user}', [SolicitudController::class, 'updateSolicitud']);   
        Route::post('/articulo', [ArticleController::class, 'store']);   

 
    });
    
    Route::middleware(RoleMiddleware::class . ':reutilizador')->group(function () {
        Route::get('/reutilizador-data', function () {
            return response()->json(['data' => 'Solo reutilizador puede ver esto']);
        });
    });


});



