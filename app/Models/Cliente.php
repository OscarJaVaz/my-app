<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Cliente extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $table = "clientes";

    protected static function boot()
    {
        parent::boot();

        // Asignar el rol por defecto al crear un usuario
        static::creating(function ($cliente) {
            // Encuentra el rol "paciente" por nombre
            $pacienteRole = Roles::where('nombre', 'paciente')->first();

            if ($pacienteRole) {
                $cliente->idRol = $pacienteRole->id;
            }
        });
    }

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
