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
                        ->select('id', 'email', 'contrasena')
                        ->where('email', $email)
                        ->where('contrasena', $password)
                        ->first();
    
        if ($cliente) {
            $arr = array(
                'idCliente' => $cliente->id,
                'email' => $cliente->email,
                'error' => ''
            );
    
            Log::channel('custom')->info('Cliente autenticado: ' . $cliente->email); // Registro de información
    
            return json_encode($arr);
        } else {
            $arr = array(
                'idCliente' => 0,
                'error' => 'No existe el cliente o la contraseña es inválida'
            );
            Log::channel('custom')->error('Autenticación fallida: ' . $email); // Registro de error
    
            return json_encode($arr);
        }
    }
    


}
