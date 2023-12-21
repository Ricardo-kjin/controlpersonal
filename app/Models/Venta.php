<?php

namespace App\Models;

use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    protected $fillable = [
        'nro_venta',
        'fecha_venta',
        'tcParametro',
        'transaccion',
        'total_venta',
        'tipopago_id',
        'promocion_id',
        'estado_venta',
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

    // public function productos() {
    //     return $this->belongsToMany(Producto::class, 'detalle_ventas', 'venta_id', 'producto_id');
    // }
    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'detalle_ventas', 'venta_id', 'producto_id')
            ->withPivot('id','cantidad', 'precio', 'subtotal');
    }

    public function verificar(int $id){

        $venta=Venta::find($id);

        $lnTransaccion = $venta->transaccion;
        // dd($lnTransaccion);
        $loClientEstado = new Client();

        $lcUrlEstadoTransaccion = "https://serviciostigomoney.pagofacil.com.bo/api/servicio/consultartransaccion";

        $laHeaderEstadoTransaccion = [
            'Accept' => 'application/json'
        ];

        $laBodyEstadoTransaccion = [
            "TransaccionDePago" => $lnTransaccion
        ];

        $loEstadoTransaccion = $loClientEstado->post($lcUrlEstadoTransaccion, [
            'headers' => $laHeaderEstadoTransaccion,
            'json' => $laBodyEstadoTransaccion
        ]);

        $laResultEstadoTransaccion = json_decode($loEstadoTransaccion->getBody()->getContents());

        // $texto = '<h5 class="text-center mb-4">Estado Transacción: ' . $laResultEstadoTransaccion->values->messageEstado . '</h5><br>';
        $venta->estado_venta=$laResultEstadoTransaccion->values->messageEstado;
        $venta->save();

        // return response()->json(['message' => $texto]);
    }
}
