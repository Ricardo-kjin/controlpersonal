<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subgrupo extends Model
{
    use HasFactory;

    public function grupo(){
        return $this->belongsTo(Grupo::class,'grupo_id');
    }
}
