<?php

namespace App\Http\Controllers;

use App\Models\Solicitud;
use App\Models\Publication;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SolicitudController extends Controller
{

    public function store(Request $request)
    {
        try {
            // Validación básica
            $data = $request->validate([
                'id_estado_solicitud' => 'required|exists:estado_solicitud,id',
                'id_publicacion' => 'required|exists:publicacion,id',
                'id_usuario_nuevo' => 'required|exists:users,id',
            ]);

            // Obtener la publicación
            $publicacion = Publication::findOrFail($data['id_publicacion']);

            // Validar que el usuario nuevo no sea el creador de la publicación
            if ($data['id_usuario_nuevo'] == $publicacion->id_usuario) {
                // Lanzar error de validación con mensaje personalizado
                throw ValidationException::withMessages([
                    'id_usuario_nuevo' => 'No puedes solicitar tu propia publicación.',
                ]);
            }

            // Verificar si ya existe una solicitud del mismo usuario para la misma publicación
            $solicitudExistente = Solicitud::where('id_usuario_nuevo', $data['id_usuario_nuevo'])
                ->where('id_publicacion', $data['id_publicacion'])
                ->first();

            if ($solicitudExistente) {
                throw ValidationException::withMessages([
                    'id_usuario_nuevo' => 'Ya has enviado una solicitud para esta publicación.',
                ]);
            }


            // Crear la solicitud si todo está bien
            $solicitud = Solicitud::create($data);

            return response()->json([
                'message' => 'Solicitud creada exitosamente',
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

    public function getSolicitados($id_user)
    {
        try {
            // Obtener todas las solicitudes donde el usuario sea el solicitante
            $solicitudes = Solicitud::where('id_usuario_nuevo', $id_user)
                ->with(['publication', 'user', 'estadoSolicitud'])
                ->get();

            return response()->json($solicitudes);
            return response()->json($id_user);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al obtener solicitudes',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
   

    public function getMisSolicitudes($id_user)
    {
        try {
            // entra a todsa mis solicitudes y  
            $solicitudes = Solicitud::whereHas('publication', function ($query) use ($id_user) {
                $query->where('id_usuario', $id_user);
            })->with(['publication', 'user', 'estadoSolicitud'])->get();

            return response()->json($solicitudes);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al obtener solicitudes',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


    //solicitud aceptada con su estado, publicacion y usuario nuevo
    public function getSolicitudeAceptada($id)
    {
        try {
            $solicitud = Solicitud::where('id', $id)
                ->with(['publication', 'user', 'estadoSolicitud'])
                ->first();

            if (!$solicitud) {
                return response()->json([
                    'message' => 'Solicitud no encontrada',
                ], 404);
            }

            return response()->json($solicitud);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al obtener solicitud',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


    
    public function getSolicitudesAceptadas()
    {
        try {
            $solicitudes = Solicitud::whereHas('estadoSolicitud', function ($query) {
                $query->where('nombre', 'aceptada');
            })->with(['publication', 'user', 'estadoSolicitud'])->get();

            return response()->json($solicitudes);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al obtener solicitudes',
                'error' => $e->getMessage(),
            ], 500);
        }
    }



 

    public function updateSolicitud(Request $request, $id)
    {
        $solicitud = Solicitud::findOrFail($id);

        $accion = $request->accion;

        if ($accion === 'aceptada') {
            $solicitud->id_estado_solicitud = 2; // ID correspondiente a 'aceptada'
        } elseif ($accion === 'rechazada') {
            $solicitud->id_estado_solicitud = 3; // ID correspondiente a 'rechazada'
        } elseif ($accion === 'pendiente') {
            $solicitud->id_estado_solicitud = 1; // ID correspondiente a 'pendiente'
        }

        $solicitud->save();

        return response()->json(['message' => 'Solicitud actualizada exitosamente']);
    }


    //solicitud aceptadas de un usuario y que tengan el articulo articulo_estado_adquisicion = 2
    public function getSolicitudesCompletadas($id_user)
    {
        try {
            $solicitudes = Solicitud::where('id_usuario_nuevo', $id_user)
                ->whereHas('estadoSolicitud', function ($query) {
                    $query->where('nombre', 'aceptada');
                })
                ->whereHas('publication.article', function ($query) {
                    $query->where('id_articulo_estado_adquisicion', 5); // Estado de adquisición completado
                })
                ->with(['publication', 'user', 'estadoSolicitud'])
                ->get();
            return response()->json($solicitudes);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al obtener solicitudes aceptadas',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
