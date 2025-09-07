<?php

namespace App\Http\Controllers;

use App\Models\Denuncia;
use App\Models\DenunciaProfile;
use App\Models\ReporteBodega;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReporteController extends Controller
{
    public function storeReporteRecepcion(Request $request)
    {
        try {
            $data = $request->validate([
                'id_solicitud' => 'required|exists:articulo_solicitud,id',
                'id_estado_verificado' => 'required|exists:estado_articulo,id',
                'id_user_bodeguero' => 'required|exists:users,id',
                'id_tipo_reporte' => 'required|exists:tipo_reporte,id',
                'observaciones_del_receptor' => 'nullable|string|max:255',
            ]);
            // Verificar si la solicitud ya tiene un reporte asociado con el mismo tipo de reporte
            $reporteExistente = ReporteBodega::where('id_solicitud', $data['id_solicitud'])
                ->where('id_tipo_reporte', $data['id_tipo_reporte'])
                ->first();

            if ($reporteExistente) {
                return response()->json([
                    'message' => "Ya se ha realizado un reporte para esta Recepcion.",
                ], 201);
            }

            $reporte = ReporteBodega::create($data);
            return response()->json([
                'message' => 'Reporte creado exitosamente',
                'id' => $reporte->id
            ], 201); 
        } catch (ValidationException $e) {
            // Retornar errores de validación
            return response()->json([
                'message' => 'Error de validación',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            // Otros errores generales
            return response()->json([
                'message' => 'Error al crear solicitud',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


    // store de denuncias
    // un solo usuario puede denunciar una publicacion una sola vez
    public function storeDenunciaPub(Request $request)
    {
        try {
            $data = $request->validate([
                'id_usuario' => 'required|exists:users,id',
                'id_publicacion' => 'required|exists:publicacion,id',
                'id_motivo_denuncia' => 'required|exists:motivo_denuncia,id',
                'id_estado_denuncia' => 'required|exists:estado_denuncia,id',
            ]);

            $denunciaExistente = DB::table('denuncia_publicacion')
                ->where('id_usuario', $data['id_usuario'])
                ->where('id_publicacion', $data['id_publicacion'])
                ->first();

            if ($denunciaExistente) {
                return response()->json([
                    'message' => "Ya has realizado una denuncia para esta publicación.",
                ], 409);
            }

            $id = Denuncia::create($data);

            return response()-> json([
                'message' => 'Se recibió la denuncia correctamente',
                'id' => $id->id // Retorna el ID de la denuncia creada
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Error de validación',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al crear denuncia',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    public function storeDenunciaProfile(Request $request)
    {
        try {
            $data = $request->validate([
                'id_usuario_denunciado' => 'required|exists:users,id',
                'id_usuario_denunciante' => 'required|exists:users,id',
                'id_motivo_denuncia' => 'required|exists:motivo_denuncia,id',
                'id_estado_denuncia' => 'required|exists:estado_denuncia,id',
            ]);
//evitar que un usuario denuncie a otro usuario mas de una vez  
            $denunciaExistente = DB::table('denuncia_usuario')
                ->where('id_usuario_denunciado', $data['id_usuario_denunciado'])
                ->where('id_usuario_denunciante', $data['id_usuario_denunciante'])
                ->first();
            
            if ($denunciaExistente) {
                return response()->json([
                    'message' => "Ya has realizado una denuncia para esta publicación.",
                ], 409);
            }
            
            $id = DenunciaProfile::create($data);

            return response()-> json([
                'message' => 'Se recibió la denuncia correctamente',
                'id' => $id->id // Retorna el ID de la denuncia creada
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Error de validación',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al crear denuncia',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    // Todas las denuncias de publicaciones
    public function getAllDenunciasUsuarios(){
        try {
            $denuncias = DenunciaProfile::with(['usuarioDenunciado', 'usuarioDenunciante', 'motivoDenuncia', 'estadoDenuncia'])
                ->get();
            return response()->json($denuncias, 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al obtener denuncias',
                'error' => $e->getMessage(),
            ], 500);
        }

    }




    public function getAllDenunciasPublicaciones(){
        try {
            $denuncias = Denuncia::with(['usuario', 'publicacion', 'motivoDenuncia', 'estadoDenuncia'])
                ->get();

            return response()->json($denuncias, 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al obtener denuncias',
                'error' => $e->getMessage(),
            ], 500);
        }


    }
    

    //actualizar estado de denuncia
    public function updateDenunciaUser($idDenuncia, $nuevoEstado){
        try {
            $denuncia = DenunciaProfile::findOrFail($idDenuncia);
            $denuncia->id_estado_denuncia = $nuevoEstado;
            $denuncia->save();

            return response()->json([
                'message' => 'Estado de denuncia al perfil actualizado correctamente',
                'denuncia' => $denuncia
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al actualizar estado de denuncia',
                'error' => $e->getMessage(),
            ], 500);
        }
    }



    public function updateDenunciaPub($idDenuncia, $nuevoEstado)
    {
        try {
            $denuncia = Denuncia::findOrFail($idDenuncia);
            $denuncia->id_estado_denuncia = $nuevoEstado;
            $denuncia->save();

            return response()->json([
                'message' => 'Estado de denuncia a la Publicacion actualizado correctamente',
                'denuncia' => $denuncia
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al actualizar estado de denuncia',
                'error' => $e->getMessage(),
            ], 500);
        }
    }









    public function index()
    {
        //
    }

    public function store() {}
}
