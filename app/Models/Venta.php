<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    protected $fillable = [
        'nro_venta',
        'fecha_venta',
        'total_venta',
        'tipopago_id',
        'user_id',
    ];

    // Relación con TipoPagos
    public function tipoPago()
    {
        return $this->belongsTo(TipoPago::class, 'tipopago_id');
    }

    // Relación con Usuarios
    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relación con DetalleVentas
    public function detalleVentas()
    {
        return $this->hasMany(DetalleVenta::class, 'venta_id');
    }
}
