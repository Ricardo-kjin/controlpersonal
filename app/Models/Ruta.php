<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruta extends Model
{
    use HasFactory;


    public function ubicacions()
    {
        return $this->belongsToMany(Ubicacion::class, 'ruta_ubicacion', 'ruta_id', 'ubicacion_id');
    }

    public function user(){
        $this->belongsTo(User::class);
    }

    public function usuarios()
    {
        return $this->hasMany(User::class);
    }
}
