<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    use HasFactory;

    protected $fillable = [
        'cantidad',
        'precio',
        'subtotal',
        'producto_id',
        'venta_id',
    ];

    // Relación con Productos
    // public function producto()
    // {
    //     return $this->belongsTo(Producto::class, 'producto_id');
    // }

    // // Relación con Ventas
    // public function venta()
    // {
    //     return $this->belongsTo(Venta::class, 'venta_id');
    // }
}
