<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subgrupo extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre_subgrupo', 'descripcion'
    ];

    // Relación con la tabla "productos"
    public function productos()
    {
        return $this->hasMany(Producto::class, 'subgrupo_id');
    }

    // Relación con la tabla "grupo"
    public function grupo()
    {
        return $this->belongsTo(Grupo::class, 'grupo_id');
    }
}
