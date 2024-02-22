<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ClienteLoginController extends Controller
{
    public function login(Request $request)
    {
        $email = $request->email;
        $password = $request->contrasena;

        $cliente = DB::table('clientes')
                        ->select('id', 'nombre', 'email', 'contrasena') // Incluimos 'nombre' en la selección
                        ->where('email', $email)
                        ->first();

        if ($cliente && Hash::check($password, $cliente->contrasena)) {
            // Autenticación exitosa
            $clienteModel = \App\Models\Cliente::find($cliente->id); 
            $clienteModel->tokens()->delete(); 

            $token = $clienteModel->createToken('AppMobile')->plainTextToken;

            $arr = array(
                'idCliente' => $cliente->id,
                'nombre' => $cliente->nombre,
                'email' => $cliente->email,
                'token' => $token,
                'error' => ''
            );

            Log::channel('custom')->info('Cliente autenticado: ' . $cliente->email); // Registro de información

            return json_encode($arr);
        } else {
            // Autenticación fallida
            $arr = array(
                'idCliente' => 0,
                'error' => 'No existe el cliente o la contraseña es inválida'
            );
            Log::channel('custom')->error('Autenticación fallida: ' . $email); // Registro de error

            return json_encode($arr);
        }
    }
}
