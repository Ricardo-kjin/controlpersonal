<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    public function grupo(){
        return $this->belongsTo(Grupo::class);
    }
    public function familia(){
        return $this->belongsTo(Familia::class);
    }
}
