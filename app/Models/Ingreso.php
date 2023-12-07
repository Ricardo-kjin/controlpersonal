<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingreso extends Model
{
    use HasFactory;

    protected $fillable = [
        'fecha_ingreso',
        'cantidad',
        'producto_id',
        'user_id',
        'tipopago_id',
        'monto',
    ];

    // Relación con Productos
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }

    // Relación con Usuarios
    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relación con TipoPagos
    public function tipoPago()
    {
        return $this->belongsTo(TipoPago::class, 'tipopago_id');
    }

}
