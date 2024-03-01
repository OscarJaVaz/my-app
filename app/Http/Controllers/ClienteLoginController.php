<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Cliente; // Asegúrate de importar el modelo Cliente

class ClienteLoginController extends Controller
{
    public function login(Request $request)
    {
        $cliente = Cliente::where('email', $request->email)->first();

        if ($cliente && Hash::check($request->contrasena, $cliente->contrasena)) {
            Auth::login($cliente); // Autenticar al cliente

            $cliente->tokens()->delete();

            $token = $cliente->createToken('AppMobile')->plainTextToken;

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
            $arr = array(
                'idCliente' => 0,'token' => '',
                'error' => 'No existe el cliente o la contraseña es inválida'
            );
            Log::channel('custom')->error('Autenticación fallida: ' . $request->email); // Registro de error

            return json_encode($arr);
        }
    }
}
