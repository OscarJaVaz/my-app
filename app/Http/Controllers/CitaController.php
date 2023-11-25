<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use Illuminate\Http\Request;

class CitaController extends Controller
{
    public function create(Request $request){
        if($request->id==0){
            $cita = new Cita();
        }
        else{
            $cita = Cita::find($request->id);
        }
        $cita->paciente = $request->paciente;
        $cita->doctor = $request->doctor;
        $cita->enfermedad = $request->enfermedad;
        $cita->fecha= $request->fecha;
        $cita->hora= $request->hora;

       $cita->save();

        return $cita;
    }

    public function get(Request $req)
    {
        $cita = Cita::find($req->id);
        return $cita;
    }

    public function list(){
        $citas = Cita::all();

        return $citas; 
    }

    public function delete(Request $request){
        $cita = Cita::find($request->id);
        $cita->delete();

        return "ok";
    }
}
