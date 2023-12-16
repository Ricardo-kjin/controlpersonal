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
        'tcParametro',
        'total_venta',
        'tipopago_id',
        'promocion_id',
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
    // Relación con promociones
    public function promocion()
    {
        return $this->belongsTo(Promocion::class, 'promocion_id');
    }

    // Modelo Venta.php

    public function productos() {
        return $this->belongsToMany(Producto::class, 'detalle_ventas', 'venta_id', 'producto_id');
    }

}
