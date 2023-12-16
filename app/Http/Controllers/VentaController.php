<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Promocion;
use App\Models\TipoPago;
use App\Models\User;
use App\Models\Venta;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class VentaController extends Controller
{

    private $tokenservice="51247fae280c20410824977b0781453df59fad5b23bf2a0d14e884482f91e09078dbe5966e0b970ba696ec4caf9aa5661802935f86717c481f1670e63f35d5041c31d7cc6124be82afedc4fe926b806755efe678917468e31593a5f427c79cdf016b686fca0cb58eb145cf524f62088b57c6987b3bb3f30c2082b640d7c52907";
    private $tokensecret="9E7BC239DDC04F83B49FFDA5";
    private $commerceid="d029fa3a95e174a19934857f535eb9427d967218a36ea014b70ad704bc6c8d1c";

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ventas=Venta::all();
        $Commerceid=$this->commerceid;
        return view('ventas.index',compact('ventas','Commerceid'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clientes=User::where('role','cliente')->get();
        $tipopagos=TipoPago::all();
        $promociones=Promocion::all();
        $productos=Producto::all();
        // dd($clientes);
        return view('ventas.create',compact('clientes','tipopagos','promociones','productos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        // dd($request->input('promocion'));
        // try {

            $ATokenService        = $this->tokenservice;
            $AMoneda              = 2;
            $ATelefono            = $request->phone;
            $ANombreUsuario       = $request->cliente;
            $ACiNit               = $request->cedula;
            $ANroPago             = $request->nro_venta;
            $AMontoClienteEmpresa = $request->total_venta;
            $ACorreo              = $request->email;
            $AUrlCallBack         = "http://localhost:8000/api/url-callback";
            $AUrlReturn           = "http://localhost:8000/";
            $APedidoDetalle       = $request->detalle_venta;
            $AUrl                 = "";

            // Valor original de $APedidoDetalle
            $APedidoDetalle = '[{"serie":1,"idProducto":"6","producto":"JPK-001N","cantidad":1,"precio":0.01,"subtotal":0.01},{"serie":2,"idProducto":"7","producto":"95D31L-TOYO CARGADA","cantidad":1,"precio":0.02,"subtotal":0.02}]';

            // Decodificar el JSON a un array asociativo
            $detalleArray = json_decode($APedidoDetalle, true);

            // Nuevo array con las claves y valores modificados
            $nuevoArray = array_map(function ($item) {
                return [
                    "Serial" => $item["serie"],
                    "ID_Producto" => $item["idProducto"],
                    "Producto" => $item["producto"],
                    "LinkPago" => 0,
                    "Cantidad" => $item["cantidad"],
                    "Precio" => $item["precio"],
                    "Descuento" => 0,
                    "Total" => $item["subtotal"]
                ];
            }, $detalleArray);

            // Convertir el nuevo array a formato JSON con barras invertidas
            $ANuevoDetalle = json_encode($nuevoArray, JSON_UNESCAPED_SLASHES);
            // Aplicar addslashes para escapar las barras invertidas
            $cadenaEscapada = addslashes($ANuevoDetalle);
            // echo $cadenaEscapada;
            // [{\"Serial\":1,\"ID_Producto\":"6\",\"Producto\":\"JPK-001N\",\"LinkPago\":0,\"Cantidad\":1,\"Precio\":0.01,\"Descuento\":0,\"Total\":0.01},{\"Serial\":2,\"ID_Producto\":"7\",\"producto\":\"95D31L-TOYO CARGADA\",\"LinkPago\":0,\"Cantidad\":1,\"Precio\":0.02,\"Descuento\":0,\"Total\":0.02}]

            //Cadena a firmar
            //“TokenService|Email|Telefono|PedidoID|Monto|Moneda|P1|P2|P3|P4”
            $CadenaAFirmar=$ATokenService . "|" . $ACorreo . "|" .$ATelefono."|".$ANroPago."|".$AMontoClienteEmpresa."|".$AMoneda."|".$AUrlCallBack."|".$AUrlReturn."|".$cadenaEscapada."|".strval(11);
            // dd($CadenaAFirmar);

            //Preparando la firma
            $Firma= hash('sha256',$CadenaAFirmar);
            // dd($Firma);

            //Preparando TcPArametro
            //DatosDePago=tcFirma|Email|Telefono|PedidoID|Monto|Moneda|P1|P2|P3|P4
            $DatosDePago=$Firma."|".$ACorreo . "|" .$ATelefono."|".$ANroPago."|".$AMontoClienteEmpresa."|".$AMoneda."|".$AUrlCallBack."|".$AUrlReturn."|".$cadenaEscapada."|".strval(11)."\u0000\u0000\u0000";
            $tcParametros=base64_encode( openssl_encrypt($DatosDePago, "DES-EDE3", $this->tokensecret ,OPENSSL_ZERO_PADDING));
            // dd($tcParametros);

            // Crear la venta
            $venta = Venta::create([
                'user_id' => $request->input('cliente'),
                'tipopago_id' => $request->input('tipopago'),
                'promocion_id' => $request->input('promocion'),
                'nro_venta' => $request->input('nro_venta'),
                'fecha_venta' => Carbon::now()->toDateString(),//colocar la fecha de ahora
                'total_venta' => $request->input('total_venta'),
                'tcParametro' => $tcParametros,
            ]);

            // Obtener el detalle de venta desde el request
            $detalleVentaData = json_decode($request->input('detalle_venta'), true);

            // Agregar registros a la tabla pivote
            foreach ($detalleVentaData as $detalle) {
                $productoId = $detalle['idProducto'];
                $cantidad = $detalle['cantidad'];
                $precio = $detalle['precio'];
                $subtotal = $detalle['subtotal'];

                // Attach agrega registros a la tabla pivote
                $venta->productos()->attach($productoId, [
                    'cantidad' => $cantidad,
                    'precio' => $precio,
                    'subtotal' => $subtotal,
                ]);
            }

            $notification="La venta fue registrada correctamente";

            //DE ACA ERA SIGUIENDO PRUEBAS DEL SITIO WEB
            // $loClient = new Client();
        // } catch (\Throwable $th) {
            //throw $th;
            // $notification="La venta no fue registrada correctamente";
        // }
        $Commerceid=$this->commerceid;

        return redirect('/ventas')->with(compact('tcParametros', 'Commerceid','notification'));

    }

    /**
     * Display the specified resource.
     */
    public function show(Venta $venta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Venta $venta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Venta $venta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Venta $venta)
    {
        //
    }

    public function urlCallback(Request $request){
        dd($request);
        return view('ventas.index');
    }
}
