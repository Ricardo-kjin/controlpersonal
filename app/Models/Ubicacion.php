<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ubicacion extends Model
{
    use HasFactory;

    protected $fillable = [
        'longitud', 'latitud', 'url_map', 'estado_ubicacion', 'user_id'
    ];

    // Relación con la tabla "users"
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relación con la tabla "ruta_ubicacion"
    public function rutaUbicaciones()
    {
        return $this->hasMany(RutaUbicacion::class, 'ubicacion_id');
    }
}
