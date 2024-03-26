<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
class UsersController extends Controller
{
    public function perfil(Request $request)
    {
        // Obtén el nombre de usuario desde la solicitud enviada por React
        $nombreUsuario = $request->input('nombre_usuario');
    
        // Busca los datos del cliente con el nombre de usuario especificado
        $users = User::where('name', $nombreUsuario)->first();
    
        // Retorna los datos del cliente como respuesta JSON
        return response()->json($users);
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'nombre_usuario' => 'required|string',
            'password_actual' => 'required|string',
            'nueva_password' => 'required|string|min:6',
        ]);
    
        // Obtén el usuario con el nombre de usuario proporcionado
        $users = User::where('name', $request->nombre_usuario)->first();
    
        // Verifica si el usuario existe y si la contraseña actual es válida
        if (!$users || !Hash::check($request->password_actual, $users->password)) {
            return response()->json(['message' => 'Credenciales incorrectas'], 401);
        }
    
        // Actualiza la contraseña del usuario
        $users->password = Hash::make($request->nueva_password);
        $users->save();
    
        // Retorna una respuesta de éxito
        return response()->json(['message' => 'Contraseña actualizada correctamente'], 200);
    }
    
    
}
