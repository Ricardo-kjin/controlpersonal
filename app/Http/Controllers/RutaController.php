<?php

namespace App\Http\Controllers;

use App\Models\Ruta;
use App\Models\Ubicacion;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RutaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->role=="admin") {
            $rutas = Ruta::all();
        }else {
            $rutas = Ruta::where('user_id',auth()->user()->id)->get();
        }

        return view('rutas.index', compact('rutas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        // dd($users);
        $vendedors = User::vendedorsXAdmin()->orderBy('id', 'asc')->get();
        // dd($vendedors);
        //clientes que tengan una ubicacion
        // $clientes = User::clientesXAdmin()->with('ubicacions.rutas')->get();;
        $clientes = User::clientesXAdmin()->whereHas('ubicacions', function ($query) {
            $query->doesntHave('rutas');
        })->get();


        // dd($clientes);
        // dd($vendedors);
        return view('rutas.create', compact('users', 'vendedors', 'clientes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        $rules = [
            'codigo_ruta' => 'required',
        ];

        $messages = [
            'codigo_ruta.required' => 'El codigo de la ruta es obligatorio',
        ];

        $this->validate($request, $rules, $messages);

        // dd($request->input('vendedor'));
        $ruta = new Ruta();
        $ruta->codigo_ruta = $request->input('codigo_ruta');
        $ruta->tiempo_total = 0;
        $ruta->estado_ruta = "Pendiente";
        $ruta->user_id = $request->input('vendedor');

        $ruta->save();

        $ruta = Ruta::latest()->first();
        $clientesSeleccionados = $request->input('seleccionados', []);
        // dd($clientesSeleccionados);

        foreach ($clientesSeleccionados as $cliente_id) {
            $fechas = $request->input('fechas.' . $cliente_id);
            $cliente = User::clientesXAdmin()->findOrFail($cliente_id);
            // dd($cliente->ubicacions->first()->id);
            // Aquí puedes realizar validaciones adicionales si es necesario
            // ...

            // Guardar en la tabla pivote
            $ruta->ubicacions()->attach($cliente->ubicacions->first()->id, [
                'fecha_ini' => $fechas['inicio'],
                'fecha_fin' => $fechas['fin'],
                'estado_visita' => "Pendiente",
            ]);

            $fecha_inicio = Carbon::createFromFormat('Y-m-d', $fechas['inicio']);
            $fecha_fin = Carbon::createFromFormat('Y-m-d', $fechas['fin']);
            $diferencia = $fecha_inicio->diff($fecha_fin);

            $ruta->tiempo_total = $ruta->tiempo_total + $diferencia->days;
            // dd($ruta);
        }
        $ruta->update();

        $notification = 'La ruta ha sido creada correctamente';

        return redirect('/rutas')->with(compact('notification'));
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {

    }
    /**
     * Display the specified resource.
     */
    public function verRuta()
    {
        $ruta=Ruta::where('user_id',auth()->user()->id)->first();
        // $ruta->ubicacions->where('user_id',$cliente->id)->first()->pivot->fecha_ini;
        // dd($rutas);
        $rutaId=$ruta->id;
        $codRuta = $ruta->codigo_ruta;

        $clientesEnRuta = User::whereHas('ubicacions.rutas', function ($query) use ($rutaId) {
            $query->where('ruta_id', $rutaId);
        })->with(['ubicacions.rutas' => function ($query) use ($rutaId) {
            $query->where('ruta_id', $rutaId)->withPivot('id', 'fecha_ini', 'fecha_fin', 'estado_visita');
        }])->get();
        // dd($clientesEnRuta);
        return view('rutas.show',compact('ruta','clientesEnRuta'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ruta $ruta)
    {
        // dd($ruta);
        // $ruta = Ruta::findOrFail($ruta_id);
        $vendedors = User::where('role','vendedor')->orderBy('id', 'asc')->get();
        // dd($vendedors);
        $routeId = $ruta->id; // Aquí colocas el ID de la ruta que será pasada como variable
        $rutaId=$routeId;
        ///////////////////ESTA PARTE DE PRUEBA COMPLETA

        $clientesEnRuta = User::whereHas('ubicacions.rutas', function ($query) use ($rutaId) {
                $query->where('ruta_id', $rutaId);
            })->with(['ubicacions.rutas' => function ($query) use ($rutaId) {
                $query->where('ruta_id', $rutaId)->withPivot('id', 'fecha_ini', 'fecha_fin', 'estado_visita');
            }])->get();
            // dd($clientesEnRuta1);
        $clientesEnRuta1 = User::where('role', 'cliente')
            ->whereHas('ubicacions', function ($query) use ($routeId) {
                $query->whereHas('rutas', function ($query) use ($routeId) {
                    $query->where('ruta_id', $routeId);
                });
            })
            ->get();

        // $clientesSinRuta = User::where('role', 'cliente')
        //     ->whereDoesntHave('ubicacions', function ($query) {
        //         $query->whereHas('rutas');
        //     })
            // ->get();
            $clientesSinRuta = User::where('role', 'cliente')
            ->whereHas('ubicacions', function ($query) {$query->whereDoesntHave('rutas');})  ->get();
            // dd($clientesConUbicacionSinRuta);

        return view('rutas.edit', compact('ruta', 'clientesEnRuta', 'clientesSinRuta', 'vendedors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ruta $ruta)
    {
        // dd($request, $ruta);
        // dd($request);
        $rules = [
            'codigo_ruta' => 'required',
        ];

        $messages = [
            'codigo_ruta.required' => 'El codigo de la ruta es obligatorio',
        ];

        $this->validate($request, $rules, $messages);


        // $ruta = new Ruta();
        $ruta->codigo_ruta = $request->input('codigo_ruta');
        $ruta->tiempo_total = 0;
        $ruta->estado_ruta = "Pendiente";
        $ruta->user_id = $request->input('vendedor');

        // $ruta->save();

        // $ruta = Ruta::latest()->first();
        $clientesSeleccionados = $request->input('seleccionados', []);
        // dd($clientesSeleccionados);

        foreach ($clientesSeleccionados as $cliente_id) {
            $fechas = $request->input('fechas.' . $cliente_id);
            // dd($fechas['inicio'],$fechas['fin']);
            $cliente = User::findOrFail($cliente_id);
            $ubicaciones = User::find($cliente_id)->ubicacions;
            // dd($cliente,$ubicaciones);

            // Aquí puedes realizar validaciones adicionales si es necesario
            // ...

            // Guardar en la tabla pivote
            $ruta->ubicacions()->syncWithoutDetaching([$ubicaciones->first()->id=> [
                'fecha_ini' => $fechas['inicio'],
                'fecha_fin' => $fechas['fin'],
                'estado_visita' => "Pendiente",
            ]]);

            $fecha_inicio = Carbon::createFromFormat('Y-m-d', $fechas['inicio']);
            $fecha_fin = Carbon::createFromFormat('Y-m-d', $fechas['fin']);
            $diferencia = $fecha_inicio->diff($fecha_fin);

            $ruta->tiempo_total = $ruta->tiempo_total + $diferencia->days;
            // dd($ruta);
        }
        $ruta->update();

        $notification = 'La ruta ha sido Actualizada correctamente';

        return redirect('/rutas')->with(compact('notification'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ruta $ruta)
    {
        //
    }
}
