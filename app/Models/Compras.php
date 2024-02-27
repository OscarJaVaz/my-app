<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compras extends Model
{
    use HasFactory;
    protected $table = "compras";

    public function Cliente(){
        return $this->belongsTo(Cliente::class, 'nombre_cliente', 'nombre');
    }
}
