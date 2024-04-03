<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use Illuminate\Http\Request;

class CitaController extends Controller
{
    public function create(Request $request)
{
    if ($request->id == 0) {
        $cita = new Cita();
    } else {
        $cita = Cita::find($request->id);
    }
    $cita->paciente = $request->paciente;
    $cita->doctor = $request->doctor;
    $cita->sintomas = $request->sintomas;
    $cita->fecha = $request->fecha;
    $cita->hora = $request->hora;
    $cita->codigo_qr = $request->codigo_qr; // Guardar el código QR
    
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

    public function controlCita()
    {
        // Realizar la consulta para obtener las fechas y horas de las citas
        $citas = Cita::select('fecha', 'hora')->get();
        
        // Devolver los resultados en formato JSON
        return response()->json($citas);
    }

    public function citasPorCliente(Request $request)
    {
        // Obtén el nombre completo del cliente desde la solicitud enviada por React
$nombreClienteCompleto = $request->input('nombre_cliente');

// Extraer el primer nombre del cliente
$nombreClienteArray = explode(' ', $nombreClienteCompleto);
$nombreCliente = $nombreClienteArray[0];

// Realiza la consulta para obtener las citas del cliente
$citas = Cita::where('paciente', $nombreCliente)
             ->select('paciente', 'doctor', 'sintomas', 'fecha', 'hora')
             ->get();
            
// Devuelve las citas en formato JSON
return response()->json($citas);

    }
}
