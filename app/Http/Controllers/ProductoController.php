<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function create(Request $request)
    {
        // Verificamos si se ha subido una imagen
        if ($request->hasFile('imagen')) {
            // Guardamos la imagen en el servidor
            $imagen = $request->file('imagen');
            $imagenPath = $imagen->store('public/build/storage/imagenes'); // Puedes ajustar la ruta según tus necesidades

            // Asignamos la ruta de la imagen al producto
            $request->merge(['imagen' => $imagenPath]);
        }

        if ($request->id == 0) {
            $producto = new Producto();
        } else {
            $producto = Producto::find($request->id);
        }

        $producto->nom_producto = $request->nom_producto;
        $producto->descripcion = $request->descripcion;
        $producto->price = $request->price;
        $producto->imagen = $request->imagen;

        $producto->save();

        return $producto;
    }

    public function get(Request $req)
{
    // Obtener el producto con sus relaciones cargadas
    $producto = Producto::find($req->id);

    // Verificar si el producto existe
    if ($producto) {
        // Acceder a los datos del producto, incluida la imagen
        $nom_producto = $producto->nom_producto;
        $descripcion = $producto->descripcion;
        $price = $producto->price;
        $imagen = $producto->imagen;
        
        Log::info('Ruta de la imagen para el producto ' . $req->id . ': ' . $imagen);
        Log::info('Longitud de la cadena Base64: ' . strlen($imagen));

        // Devolvuelve los datos
        return response()->json([
            'id' => $req->id,
            'nom_producto' => $nom_producto,
            'descripcion' => $descripcion,
            'price' => $price,
            'imagen' => $imagen,
        ]);
    } else {
        // Si el producto no se encuentra, devuelve una respuesta inadecuada
        return response()->json(['mensaje' => 'Producto no encontrado'], 404);
    }
}


    public function list()
    {
        $productos = Producto::all();
        return $productos; 
    }

    public function delete(Request $request)
    {
        $producto = Producto::find($request->id);
        $producto->delete();

        return "ok";
    }
}