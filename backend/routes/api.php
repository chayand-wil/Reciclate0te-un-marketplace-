<?php


use App\Http\Controllers\AuthController;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\PublicationController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\SolicitudController;
use App\Models\Genero;
use App\Models\Publication;
use App\Models\Solicitud;
use App\Models\Ubicacion;
use Database\Seeders\AdminSeeder;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AdminController::class, 'store']);
Route::get('/get_catalogos/{table}', [PublicController::class, 'getCatalogo']);
Route::get('/get_catalogos_articles', [PublicController::class, 'getCatalogoArticles']);
Route::get('/municipios', [Ubicacion::class, 'getAllMunicipios']);



Route::middleware(['auth:api'])->group(function () {
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/uniqueuser/{id}', [AdminController::class, 'userProfile']);
    Route::get('/publication/{id}', [PublicationController::class, 'getPublication']);
    Route::get('/get_catalogo/{table}', [PublicController::class, 'getCatalogo']);
    Route::get('/get_catalogo/{id}/{table}', [PublicController::class, 'getTableById']);

    Route::get('/generos', [Genero::class, 'getAllGeneros']);
    Route::get('/get_notifications/{id_user}', [AdminController::class, 'getNotifications']);
    
    Route::get('/all_users', [AdminController::class, 'index']);
        Route::get('/publications', [PublicationController::class, 'index']);
    
    
    
    
    
    
    Route::middleware(RoleMiddleware::class . ':admin')->group(function () {
        Route::get('/admin-data', function () {
            return response()->json(['data' => 'Solo admin puede ver esto']);
        });
        Route::post('/users', [AdminController::class, 'store']);
        Route::get('/users', [AdminController::class, 'index']);
        // Route::get('/uniqueuser/{id}', [AdminController::class, 'uniqueUser']);   
        Route::post('/updateUser', [AdminController::class, 'updateUser']);
        Route::get('/deleteUser/{id}', [AdminController::class, 'destroy']);

        // Route::get('/get_contador/{id}', [AdminController::class, 'getContador']);
        // Route::post('/update_contador', [AdminController::class, 'updateContador']);
        Route::get('/getAllDenunciasPublicaciones', [ReporteController::class, 'getAllDenunciasPublicaciones']);
        Route::get('/getAllDenunciasUsuarios', [ReporteController::class, 'getAllDenunciasUsuarios']);

        Route::post('/updateDenunciaPub/{idDenuncia}/{nuevoEstado}', [ReporteController::class, 'updateDenunciaPub']);
        Route::post('/updateDenunciaUser/{idDenuncia}/{nuevoEstado}', [ReporteController::class, 'updateDenunciaUser']);
        


        Route::get('getUserAllFields', [AdminController::class, 'getUserAllFields']);


    });
    




    Route::middleware(RoleMiddleware::class . ':reutilizador')->group(function () {
        Route::get('/reutilizador-data', function () {
            return response()->json(['data' => 'Solo reutilizador puede ver esto']);
        });

        Route::post('/publication', [PublicationController::class, 'store']);
        Route::get('/publications/{id}', [PublicationController::class, 'getPubs']);
        Route::post('/articulo_solicitud', [SolicitudController::class, 'store']);
        Route::get('/getMisSolicitudes/{id_user}', [SolicitudController::class, 'getMisSolicitudes']);
        Route::patch('/getMisSolicitudes/{id_user}', [SolicitudController::class, 'updateSolicitud']);
        Route::get('/getSolicitados/{id_user}', [SolicitudController::class, 'getSolicitados']);


        Route::get('/articulos_adquiridos/{id_user}', [SolicitudController::class, 'getSolicitudesCompletadas']);
        Route::post('/articulo', [ArticleController::class, 'store']);
        Route::get('/userProfilebyPub/{id}', [AdminController::class, 'userProfilebyPub']);
        Route::post('/storeDenunciaPub', [ReporteController::class, 'storeDenunciaPub']);
        Route::post('/storeDenunciaProfile', [ReporteController::class, 'storeDenunciaProfile']);
    });





    Route::middleware(RoleMiddleware::class . ':clasificador')->group(function () {
        Route::get('/clasificador-data', function () {
            return response()->json(['data' => 'Solo clasificador puede ver esto']);
        });

        Route::post('/guardar_puntos', [AdminController::class, 'storePuntos']);
    });







    Route::middleware(RoleMiddleware::class . ':bodeguero')->group(function () {
        Route::get('/bodegueroo-data', function () {
            return response()->json(['data' => 'Solo clasificador puede ver esto']);
        });


        Route::get('/all_solicitudes_aceptadas', [SolicitudController::class, 'getSolicitudesAceptadas']);
        Route::get('/getSolicitudeAceptada/{id}', [SolicitudController::class, 'getSolicitudeAceptada']);
        Route::post('/storeReporteRecepcion', [ReporteController::class, 'storeReporteRecepcion']);
    });
});
