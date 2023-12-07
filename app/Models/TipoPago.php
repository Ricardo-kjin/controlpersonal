<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoPago extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre_tipopago'
    ];

    // Relación con la tabla "ingresos"
    public function ingresos()
    {
        return $this->hasMany(Ingreso::class, 'tipopago_id');
    }

    // Relación con la tabla "ventas"
    public function ventas()
    {
        return $this->hasMany(Venta::class, 'tipopago_id');
    }
}
