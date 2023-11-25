<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function create(Request $request){
        if($request->id==0){
            $doctor = new Doctor();
        }
        else{
            $doctor = Doctor::find($request->id);
        }
        $doctor->nombre = $request->nombre;
        $doctor->cedula = $request->cedula;
        $doctor->contacto = $request->contacto;
        $doctor->domicilio = $request->domicilio;
        
       $doctor->save();

        return $doctor;
    }

    public function get(Request $req)
    {
        $doctor = Doctor::find($req->id);
        return $doctor;
    }

    public function list(){
        $doctores = Doctor::all();

        return $doctores; 
    }

    public function delete(Request $request){
        $doctor = Doctor::find($request->id);
        $doctor->delete();

        return "ok";
    }
}
