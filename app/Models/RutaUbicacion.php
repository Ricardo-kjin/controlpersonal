<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RutaUbicacion extends Model
{
    use HasFactory;

    protected $fillable = [
        'fecha_ini', 'fecha_fin', 'estado_visita', 'ubicacion_id', 'ruta_id'
    ];

    // Relación con la tabla "ubicacions"
    // public function ubicacion()
    // {
    //     return $this->belongsTo(Ubicacion::class, 'ubicacion_id');
    // }

    // // Relación con la tabla "rutas"
    // public function ruta()
    // {
    //     return $this->belongsTo(Ruta::class, 'ruta_id');
    // }
}
