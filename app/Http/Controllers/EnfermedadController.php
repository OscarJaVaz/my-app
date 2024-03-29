<?php

namespace App\Http\Controllers;

use App\Models\Enfermedad;
use Illuminate\Http\Request;
//CONTROLADORES
class EnfermedadController extends Controller
{
    public function create(Request $request){
        if($request->id==0){
            $enfermedad = new Enfermedad();
        }
        else{
            $enfermedad = Enfermedad::find($request->id);
        }
        $enfermedad->nombre = $request->nombre;
        $enfermedad->gravedad = $request->gravedad;
        $enfermedad->save();

        return $enfermedad;
    }

    public function get(Request $req)
    {
        $enfermedad = Enfermedad::find($req->id);
        return  $enfermedad;
    }

    public function list(){
        $enfermedades = Enfermedad::all();

        return $enfermedades; 
    }

    public function delete(Request $request){
        $enfermedad = Enfermedad::find($request->id);
        $enfermedad->delete();

        return "ok";
    }
}
