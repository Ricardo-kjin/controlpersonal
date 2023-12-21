<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruta extends Model
{
    use HasFactory;


    // En el modelo Ruta
    public function ubicacions()
    {
        return $this->belongsToMany(Ubicacion::class, 'ruta_ubicacion', 'ruta_id', 'ubicacion_id')
            ->withPivot('estado_visita', 'fecha_ini', 'fecha_fin', 'updated_at');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function usuarios()
    {
        return $this->hasMany(User::class);
    }
}
