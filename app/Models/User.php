<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'cedula',
        'address',
        'phone',
        'role',
        'admin_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function scopeDesarrolladores($query){
        return $query->where('role','desarrollador');
    }
    public function scopeDesarrolladoresXAdmin($query,$id){
        return $query->where('role','desarrollador')->where('admin_id','=',$id);
    }
    public function scopeVendedorsXAdmin($query){
        return $query->where('role','vendedor');
    }
    public function scopeMonitorsXAdmin($query,$id){
        return $query->where('role','personal')->where('admin_id','=',$id);
    }
    public function scopeClientesXAdmin($query){
        return $query->where('role','cliente');
    }

    public function salas(){
         return $this->belongsToMany(Sala::class)->withTimestamps();
    }
    public function userSalas(){
         return $this->hasMany(Sala::class);
    }

    public function ubicacions()
    {
        return $this->hasMany(Ubicacion::class);
    }

    public function ruta()
    {
        return $this->belongsTo(Ruta::class);
    }

    public function rutas(){
        return $this->hasMany(Ruta::class);
    }
    //AGREGADO


        // Relación con la tabla "ingresos"
        public function ingresos()
        {
            return $this->hasMany(Ingreso::class, 'user_id');
        }

        // Relación con la tabla "movimientos"
        public function movimientos()
        {
            return $this->hasMany(Movimiento::class, 'user_id');
        }

        // Relación con la tabla "ruta_ubicacion"
        // public function ubicaciones()
        // {
        //     return $this->hasMany(Ubicacion::class, 'user_id');
        // }

        // Relación con la tabla "ventas"
        public function ventas()
        {
            return $this->hasMany(Venta::class, 'user_id');
        }

        // Otras relaciones con las demás tablas...

        // Relación con la tabla "ubicacions" a través de la tabla "ruta_ubicacion"
        public function ubicacionesRutas()
        {
            return $this->hasManyThrough(Ubicacion::class, RutaUbicacion::class, 'user_id', 'id', 'id', 'ubicacion_id');
        }

}
