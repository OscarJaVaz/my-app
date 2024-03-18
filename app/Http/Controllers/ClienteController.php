<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use Illuminate\Support\Facades\Hash;
class ClienteController extends Controller
{
    public function create(Request $request){
        if($request->id==0){
            $cliente = new Cliente();
        }
        else{
            $cliente = Cliente::find($request->id);
        }
        $cliente->nombre = $request->nombre;
        $cliente->apellido = $request->apellido;
        $cliente->email = $request->email;
        $cliente->telefono = $request->telefono;
        //$cliente->contrasena = $request->contrasena; 
        $cliente->contrasena = Hash::make($request->contrasena); 
        $cliente->domicilio = $request->domicilio;
        
        $cliente->save();

        return $cliente;
    }

    public function get(Request $req)
    {
        $cliente = Cliente::find($req->id);
        return $cliente;
    }

    public function list(){
        $clientes = Cliente::all();

        return $clientes; 
    }

    public function delete(Request $request){
        $cliente = Cliente::find($request->id);
        $cliente->delete();

        return "ok";
    }
    public function perfil(Request $request)
{
    // Obtén el nombre de usuario desde la solicitud enviada por React
    $nombreUsuario = $request->input('nombre_usuario');

    // Busca los datos del cliente con el nombre de usuario especificado
    $cliente = Cliente::where('nombre', $nombreUsuario)->first();

    // Retorna los datos del cliente como respuesta JSON
    return response()->json($cliente);
}

public function updatePassword(Request $request)
{
    $request->validate([
        'nombre_usuario' => 'required|string',
        'contrasena_actual' => 'required|string',
        'nueva_contrasena' => 'required|string|min:6',
    ]);

    // Obtén el cliente con el nombre de usuario proporcionado
    $cliente = Cliente::where('nombre', $request->nombre_usuario)->first();

    // Verifica si el cliente existe y si la contraseña actual es válida
    if (!$cliente || !Hash::check($request->contrasena_actual, $cliente->contrasena)) {
        return response()->json(['message' => 'Credenciales incorrectas'], 401);
    }

    // Actualiza la contraseña del cliente
    $cliente->contrasena = Hash::make($request->nueva_contrasena);
    $cliente->save();

    // Retorna una respuesta de éxito
    return response()->json(['message' => 'Contraseña actualizada correctamente'], 200);
}
}

