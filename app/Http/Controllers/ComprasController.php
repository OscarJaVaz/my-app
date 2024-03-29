<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Compras;
use Illuminate\Support\Facades\Hash;
class ComprasController extends Controller
{
    public function create(Request $request){
        if($request->id==0){
            $compras = new Compras();
        }
        else{
            $compras = Compras::find($request->id);
        }
        $compras->nombre_cliente = $request->nombre_cliente;
        $compras->nombre_producto = $request->nombre_producto;
        $compras->cantidad = $request->cantidad;
        $compras->total= $request->total;
        $compras->cp = $request->cp;
        $compras->direccion = $request->direccion;
        $compras->municipio = $request->municipio;
        $compras->referencia = $request->referencia;
        $compras->num_tarjeta =Hash::make ($request->num_tarjeta);
        $compras->nom_titular = $request->nom_titular;
        $compras->expiracion = Hash::make ($request->expiracion);
        $compras->cvc = Hash::make ($request->cvc);

        $compras->save();
        return $compras;
    }

    public function get(Request $req)
    {
        $compras = Compras::find($req->id);
        return $compras;
    }

    public function list(){
        $comprass = Compras::all();

        return $comprass; 
    }

    public function delete(Request $request){
        $compras = Compras::find($request->id);
        $compras->delete();

        return "ok";
    }

    public function index(Request $request)
    {
        // Obtén el nombre del cliente desde la solicitud enviada por React
        $nombreCliente = $request->input('nombre_cliente');

        // Busca las compras realizadas por el cliente con el nombre especificado
        $compras = Compras::where('nombre_cliente', $nombreCliente)->get();

        // Retorna las compras como respuesta JSON
        return response()->json($compras);
    }
    
}
