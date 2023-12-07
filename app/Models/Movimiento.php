<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movimiento extends Model
{
    use HasFactory;

    protected $fillable = ['nombre_movimiento'];

    // Relación con Cuentas
    public function cuenta()
    {
        return $this->belongsTo(Cuenta::class, 'cuenta_id');
    }

    // Relación con Usuarios
    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
