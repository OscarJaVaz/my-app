<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    protected $table = "clientes";
    
    protected static function boot()
    {
        parent::boot();

        // Asignar el rol por defecto al crear un usuario
        static::creating(function ($user) {
            // Encuentra el rol "administrador" por nombre
            $adminRole = Roles::where('nombre', 'paciente')->first();

            if ($adminRole) {
                $user->idRol = $adminRole->id;
            }
        });
    }
    
}
