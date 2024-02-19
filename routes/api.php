<?php
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\EnfermedadController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ClienteLoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', [LoginController::class, 'login']);
Route::get('pacientes', [PacienteController::class, 'list']);
Route::get('paciente', [PacienteController::class, 'get']);
Route::post('paciente/crear', [PacienteController::class, 'create']);
Route::post('paciente/borrar', [PacienteController::class, 'delete']);
Route::get('doctores', [DoctorController::class, 'list']);
Route::get('doctor', [DoctorController::class, 'get']);
Route::post('doctor/crear', [DoctorController::class, 'create']);
Route::post('doctor/borrar', [DoctorController::class, 'delete']);
Route::get('enfermedades', [EnfermedadController::class, 'list']);
Route::get('enfermedad', [EnfermedadController::class, 'get']);
Route::post('enfermedad/crear', [EnfermedadController::class, 'create']);
Route::post('enfermedad/borrar', [EnfermedadController::class, 'delete']);
Route::get('citas', [CitaController::class, 'list']);
Route::get('cita', [CitaController::class, 'get']);
Route::post('cita/crear', [CitaController::class, 'create']);
Route::post('cita/borrar', [CitaController::class, 'delete']);
/********API PRODUCTOS********* */
Route::get('productos', [ProductoController::class, 'list']);
Route::get('producto', [ProductoController::class, 'get']);
Route::post('producto/crear', [ProductoController::class, 'create']);
Route::post('producto/borrar', [ProductoController::class, 'delete']);
/****API CLIENTE (PACIENTE) */
Route::get('clientes', [ClienteController::class, 'list']);
Route::get('cliente', [ClienteController::class, 'get']);
Route::post('cliente/crear', [ClienteController::class, 'create']);
Route::post('cliente/borrar', [ClienteController::class, 'delete']);
Route::post('logincliente', [ClienteLoginController::class, 'login']);
