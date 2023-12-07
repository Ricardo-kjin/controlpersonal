<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre_grupo'
    ];

    // Relación con la tabla "productos"
    public function productos()
    {
        return $this->hasMany(Producto::class, 'grupo_id');
    }

    // Relación con la tabla "subgrupos"
    public function subgrupos()
    {
        return $this->hasMany(Subgrupo::class, 'grupo_id');
    }

}
