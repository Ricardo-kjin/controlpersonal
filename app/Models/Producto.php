<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre_producto', 'descripcion', 'precio', 'stock', 'estado_producto', 'unidad_medida', 'familia_id', 'grupo_id'
    ];

    // Relación con la tabla "familias"
    public function familia()
    {
        return $this->belongsTo(Familia::class, 'familia_id');
    }

    // Relación con la tabla "grupos"
    public function grupo()
    {
        return $this->belongsTo(Grupo::class, 'grupo_id');
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    // Relación con la tabla "subgrupos"
    public function subgrupo()
    {
        return $this->belongsTo(Subgrupo::class, 'subgrupo_id');
    }

    //relacion con la tabla detalle de ventas
    // public function ventas() {
    //     return $this->belongsToMany(Venta::class, 'detalle_ventas', 'producto_id', 'venta_id');
    // }
    public function ventas()
    {
        return $this->belongsToMany(Venta::class, 'detalle_ventas', 'producto_id', 'venta_id')
            ->withPivot('id','cantidad', 'precio', 'subtotal');
    }
}
