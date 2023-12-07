<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuenta extends Model
{
    use HasFactory;

    protected $fillable = [
        'saldo', 'estado_cuenta'
    ];

    // Relación con la tabla "movimientos"
    public function movimientos()
    {
        return $this->hasMany(Movimiento::class, 'cuenta_id');
    }

}
