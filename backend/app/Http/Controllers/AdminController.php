<?php

namespace App\Http\Controllers;

use App\Models\Genero;
use App\Models\User;
use App\Models\MotivoNotificacion;
use App\Models\Publication;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AdminController extends Controller

{

public function store(Request $request)
{
    try {
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|string|email|max:100|unique:users,email',
            'password' => 'required|string|min:8',
            'dpi' => 'required|string|max:20|unique:users,dpi',
            'id_estado' => 'required|exists:estado_usuario,id',
            'id_rol' => 'required|exists:role_users,id',
            'id_nivel' => 'required|exists:nivel,id',
            'cantidad_puntos' => 'nullable|integer|min:0',
            'medio_contacto' => 'required|string|max:200',
            'id_genero' => 'required|exists:genero,id',  
            'fecha_nacimiento' => 'nullable|date',
            'id_municipio' => 'required|exists:municipio,id',
            'detalle_direccion' => 'required|string',
        ],
        [
            'email.unique' => 'El correo electrónico ya está en uso.',
            'dpi.unique' => 'El DPI ya está en uso.',   
        ]);

        // 🔐 Hash correcto
        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);

        return response()->json([
            'message' => 'Usuario creado exitosamente.',
            // 'message' => $data,
        ], 201);

    } catch (ValidationException $e) {
        return response()->json([
            'message' => 'Error de validación',
            'errors' => $e->errors(),
        ], 422);
    } catch (\Exception $e) {
        return response()->json([
            'message' => 'Error al crear al usuario',
            'error' => $e->getMessage(),
        ], 500);
    }
}

  




public function index() //jala todos los usuarios
{
    return User::all();
    // return User::select('id', 'name', 'email', 'id_rol', 'created_at')->get();
}


//guardar puntos al usuario
public function storePuntos(Request $request)
{
    $request->validate([
        'id' => 'required|exists:users,id',
        'cantidad_puntos' => 'required|integer|min:0',
    ]);

    $user = User::find($request->id);
    if (!$user) {
        return response()->json(['message' => 'Usuario no encontrado'], 404);
    }
    $user->cantidad_puntos += $request->cantidad_puntos;
    $user->save();

    return response()->json(['message' => 'Puntos actualizados correctamente'], 200);
}       




public function userProfilebyPub($id){
    //busca en publiaciones al usuario que creo la publicacion
    $user = User::with([
        'estado',
        'rol',
        'nivel',
        'municipio'
    ])->whereHas('publications', function ($query) use ($id) {
        $query->where('id', $id);
    })->first();
    if (!$user) {
        return response()->json(['message' => 'Usuario no encontrado'], 404);
    }
    return response()->json($user);
 
}



public function userProfile($id){
    $user = User::with([
        'estado',
        'rol',
        'nivel',
        'municipio'
    ])->find($id);

    if (!$user) {
        return response()->json(['message' => 'Usuario no encontrado'], 404);
    }

    return response()->json($user);
}

// noficaciones de un usuario
public function getNotifications($id)
{
    //todas las notificaciones del usuario
    // ordenadas por fecha de creacion
    $user =Notification::with([
        'motivoNotificacion',
        'user',
        'publication',
        'publication.article',
    ])->where('id_usuario', $id)->orderBy('created_at', 'desc')->get();
    if (!$user) {
        return response()->json(['message' => 'Usuario no encontrado'], 404);
    }

    return response()->json($user);
}


//todos los usuarios incluyendo todos sus campos
 public function getUserAllFields(){
    return User::with([
        'estado',
        'rol',
        'nivel',
        'municipio'
    ])->get();
 }


// public function getContador($id)  
// {
//      return Producto::where('id', $id)
//         ->select('id', 'cantidad')
//         ->first();
// }


// public function updateContador(Request $request)  
// {
//     // Validar los datos de entrada
//     $request->validate([
//         'id' => 'required|exists:producto,id',
//         'cantidad' => 'required|integer|min:0',
//     ]);

//     // Actualizar el contador del producto
//     $producto = Producto::find($request->id);
//     if (!$producto) {
//         return response()->json(['message' => 'Producto no encontrado'], 404);
//     }
    
//     $producto->cantidad = $request->cantidad;
//     $producto->save();
    
//     return response()->json(['message' => 'Contador actualizado correctamente'], 200);
// }  



public function uniqueUser( $id)
{
    $user = User::find($id);

    if (!$user) {
        return response()->json(['message' => 'Usuario no encontrado'], 404);
    }

    return $user;
}

public function updateUser(Request $request)
{ 
    
    $id = $request->id;
    $user = User::find($id);

    if (!$user) {
        return response()->json(['message' => 'Usuario no encontrado'], 404);
    }

    // Validar los datos de entrada
    $request->validate([
        'name' => 'required|string|max:255',
        'role' => 'required|in:admin,ayudante',
    ]);


    // Actualizar los campos del usuario
    $user->name = $request->name;
    $user->role = $request->role;
    $user->save();

    return response()->json(['message' => 'Usuario actualizado correctamente'], 200);
}

public function destroy($id)
{
    $user = User::find($id);

    if (!$user) {
        return response()->json(['message' => 'Usuario no encontrado'], 404);
    }

    $user->delete();

    return response()->json(['message' => 'Usuario eliminado correctamente'], 200);
 
}






}
