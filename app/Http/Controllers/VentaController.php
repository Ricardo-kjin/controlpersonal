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
        try {
            //PARTE 0000000000
            $lcComerceID           = $this->commerceid;
            $lnMoneda              = 2;
            $lnTelefono            = $request->phone;
            $lcNombreUsuario       = "Pedro";//$request->tcRazonSocial;
            $lnCiNit               = $request->cedula;
            $lcNroPago             = $request->nro_venta;
            $lnMontoClienteEmpresa = $request->total_venta;
            $lcCorreo              = $request->email;
            $lcUrlCallBack         = "https://controlpersonal-production.up.railway.app/api/url-callback";
            $lcUrlReturn           =  "https://controlpersonal-production.up.railway.app/";
            $laPedidoDetalle       = $request->detalle_venta;
            $lcUrl                 = "";

            $loClient = new Client();

            if ($request->tipopago == 1) {
                $lcUrl = "https://serviciostigomoney.pagofacil.com.bo/api/servicio/generarqrv2";
            } elseif ($request->tipopago == 2) {
                $lcUrl = "https://serviciostigomoney.pagofacil.com.bo/api/servicio/realizarpagotigomoneyv2";
            }

            $laHeader = [
                'Accept' => 'application/json'
            ];

            $laBody   = [
                "tcCommerceID"          => $lcComerceID,
                "tnMoneda"              => $lnMoneda,
                "tnTelefono"            => $lnTelefono,
                'tcNombreUsuario'       => $lcNombreUsuario,
                'tnCiNit'               => $lnCiNit,
                'tcNroPago'             => $lcNroPago,
                "tnMontoClienteEmpresa" => $lnMontoClienteEmpresa,
                "tcCorreo"              => $lcCorreo,
                'tcUrlCallBack'         => $lcUrlCallBack,
                "tcUrlReturn"           => $lcUrlReturn,
                'taPedidoDetalle'       => $laPedidoDetalle
            ];

            $loResponse = $loClient->post($lcUrl, [
                'headers' => $laHeader,
                'json' => $laBody
            ]);

            $laResult = json_decode($loResponse->getBody()->getContents());

            if ($request->tipopago == 1) {

                $laValues = explode(";", $laResult->values)[1];

                $laQrImage = "data:image/png;base64," . json_decode($laValues)->qrImage;
                echo '<img src="' . $laQrImage . '" alt="Imagen base64">';
            } elseif ($request->tipopago == 2) {

                $csrfToken = csrf_token();

                echo '<h5 class="text-center mb-4">' . $laResult->message . '</h5>';
                echo '<p class="blue-text">Transacción Generada: </p><p id="tnTransaccion" class="blue-text">'. $laResult->values . '</p><br>';
                echo '<iframe name="QrImage" style="width: 100%; height: 300px;"></iframe>';
                echo '<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>';

                echo '<script>
                        $(document).ready(function() {
                            function hacerSolicitudAjax(numero) {
                                // Agrega el token CSRF al objeto de datos
                                var data = { _token: "' . $csrfToken . '", tnTransaccion: numero };

                                $.ajax({
                                    url: \'/consultar\',
                                    type: \'POST\',
                                    data: data,
                                    success: function(response) {
                                        var iframe = document.getElementsByName(\'QrImage\')[0];
                                        iframe.contentDocument.open();
                                        iframe.contentDocument.write(response.message);
                                        iframe.contentDocument.close();
                                    },
                                    error: function(error) {
                                        console.error(error);
                                    }
                                });
                            }

                            setInterval(function() {
                                hacerSolicitudAjax(' . $laResult->values . ');
                            }, 7000);
                        });
                    </script>';


            }
/*
            //PARTE 1111111111
            $ATokenService        = $this->tokenservice;
            $AMoneda              = 2;
            $ATelefono            = $request->phone;
            $ANombreUsuario       = $request->cliente;
            $ACiNit               = $request->cedula;
            $ANroPago             = $request->nro_venta;
            $AMontoClienteEmpresa = $request->total_venta;
            $ACorreo              = $request->email;
            $AUrlCallBack         = "https://controlpersonal-production.up.railway.app/api/url-callback";
            $AUrlReturn           = "https://controlpersonal-production.up.railway.app/";
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
*/
        } catch (\Throwable $th) {

            return $th->getMessage() . " - " . $th->getLine();
        }
        // $Commerceid=$this->commerceid;

        // return redirect('/ventas')->with(compact('tcParametros', 'Commerceid','notification'));

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

    // public function urlCallback(Request $request){
    //     dd($request);
    //     return view('ventas.index');
    // }
    public function RecolectarDatos(Request $request)
    {
    try {

        $lcComerceID           = "d029fa3a95e174a19934857f535eb9427d967218a36ea014b70ad704bc6c8d1c";
        $lnMoneda              = 2;
        $lnTelefono            = $request->tnTelefono;
        $lcNombreUsuario       = $request->tcRazonSocial;
        $lnCiNit               = $request->tcCiNit;
        $lcNroPago             = "test-" . rand(100000, 999999);
        $lnMontoClienteEmpresa = $request->tnMonto;
        $lcCorreo              = $request->tcCorreo;
        $lcUrlCallBack         = "http://localhost:8000/";
        $lcUrlReturn           = "http://localhost:8000/";
        $laPedidoDetalle       = $request->taPedidoDetalle;
        $lcUrl                 = "";

        $loClient = new Client();

        if ($request->tnTipoServicio == 1) {
            $lcUrl = "https://serviciostigomoney.pagofacil.com.bo/api/servicio/generarqrv2";
        } elseif ($request->tnTipoServicio == 2) {
            $lcUrl = "https://serviciostigomoney.pagofacil.com.bo/api/servicio/realizarpagotigomoneyv2";
        }

        $laHeader = [
            'Accept' => 'application/json'
        ];

        $laBody   = [
            "tcCommerceID"          => $lcComerceID,
            "tnMoneda"              => $lnMoneda,
            "tnTelefono"            => $lnTelefono,
            'tcNombreUsuario'       => $lcNombreUsuario,
            'tnCiNit'               => $lnCiNit,
            'tcNroPago'             => $lcNroPago,
            "tnMontoClienteEmpresa" => $lnMontoClienteEmpresa,
            "tcCorreo"              => $lcCorreo,
            'tcUrlCallBack'         => $lcUrlCallBack,
            "tcUrlReturn"           => $lcUrlReturn,
            'taPedidoDetalle'       => $laPedidoDetalle
        ];

        $loResponse = $loClient->post($lcUrl, [
            'headers' => $laHeader,
            'json' => $laBody
        ]);

        $laResult = json_decode($loResponse->getBody()->getContents());

        if ($request->tnTipoServicio == 1) {

            $laValues = explode(";", $laResult->values)[1];

            $laQrImage = "data:image/png;base64," . json_decode($laValues)->qrImage;
            echo '<img src="' . $laQrImage . '" alt="Imagen base64">';
        } elseif ($request->tnTipoServicio == 2) {

            $csrfToken = csrf_token();

            echo '<h5 class="text-center mb-4">' . $laResult->message . '</h5>';
            echo '<p class="blue-text">Transacción Generada: </p><p id="tnTransaccion" class="blue-text">'. $laResult->values . '</p><br>';
            echo '<iframe name="QrImage" style="width: 100%; height: 300px;"></iframe>';
            echo '<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>';

            echo '<script>
                    $(document).ready(function() {
                        function hacerSolicitudAjax(numero) {
                            // Agrega el token CSRF al objeto de datos
                            var data = { _token: "' . $csrfToken . '", tnTransaccion: numero };

                            $.ajax({
                                url: \'/consultar\',
                                type: \'POST\',
                                data: data,
                                success: function(response) {
                                    var iframe = document.getElementsByName(\'QrImage\')[0];
                                    iframe.contentDocument.open();
                                    iframe.contentDocument.write(response.message);
                                    iframe.contentDocument.close();
                                },
                                error: function(error) {
                                    console.error(error);
                                }
                            });
                        }

                        setInterval(function() {
                            hacerSolicitudAjax(' . $laResult->values . ');
                        }, 7000);
                    });
                </script>';


        }
    } catch (\Throwable $th) {

        return $th->getMessage() . " - " . $th->getLine();
    }
}

public function ConsultarEstado(Request $request)
{
    $lnTransaccion = $request->tnTransaccion;

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

    $texto = '<h5 class="text-center mb-4">Estado Transacción: ' . $laResultEstadoTransaccion->values->messageEstado . '</h5><br>';

    return response()->json(['message' => $texto]);
}

public function urlCallback(Request $request)
{
    dd($request);
    $Venta = $request->input("PedidoID");
    $Fecha = $request->input("Fecha");
    $NuevaFecha = date("Y-m-d", strtotime($Fecha));
    $Hora = $request->input("Hora");
    $MetodoPago = $request->input("MetodoPago");
    $Estado = $request->input("Estado");
    $Ingreso = true;

    try {
        $arreglo = ['error' => 0, 'status' => 1, 'message' => "Pago realizado correctamente.", 'values' => true];
    } catch (\Throwable $th) {
        $arreglo = ['error' => 1, 'status' => 1, 'messageSistema' => "[TRY/CATCH] " . $th->getMessage(), 'message' => "No se pudo realizar el pago, por favor intente de nuevo.", 'values' => false];
    }

    return response()->json($arreglo);
}
}
