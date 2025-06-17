<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
public function store(Request $request)
{
    $request->validate([
        'name'     => 'required|string|max:255',
        'email'    => 'required|email|unique:users,email',
        'password' => 'required|min:6',
        'id_rol'   => 'required|in:1,2,3,4',
    ]);

    $user = User::create([
        'name'     => $request->name,
        'email'    => $request->email,
        'password' => bcrypt($request->password),
        'id_rol'   => $request->id_rol,
    ]);

    // Obtener el ID del nuevo usuario
    $lastInsertedId = $user->id;

    // Puedes retornar el ID o usarlo como necesites
    return response()->json([
        'message' => 'Usuario creado exitosamente.',
        'user_id' => $lastInsertedId
    ]);
}
  




public function index() //jala todos los usuarios
{
    // return User::all();
    return User::select('id', 'name', 'email', 'id_rol', 'created_at')->get();
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
