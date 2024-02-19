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
}
