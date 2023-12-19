<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ubicacion extends Model
{
    use HasFactory;

    protected $fillable = [
        'longitud', 'latitud', 'url_map','estado_ubicacion', 'user_id'
    ];

    // Relación con la tabla "users"
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // En el modelo Ubicacion
    public function rutas()
    {
        return $this->belongsToMany(Ruta::class, 'ruta_ubicacion', 'ubicacion_id', 'ruta_id')
            ->withPivot('estado_visita', 'fecha_ini', 'fecha_fin', 'updated_at');
    }
}
