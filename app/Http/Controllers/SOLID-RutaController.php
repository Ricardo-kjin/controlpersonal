<?php

namespace App\Http\Controllers;

use App\Models\Ruta;
use App\Models\Ubicacion;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RutaController extends Controller
{
    public function store(Request $request)
    {
        $this->validateRequest($request);
        $ruta = $this->crearRuta($request);
        $this->asignarClientesARuta($request, $ruta);
        $notification = 'La ruta ha sido creada correctamente';
        return redirect('/rutas')->with(compact('notification'));
    }

    protected function validateRequest(Request $request)
    {
        $rules = [
            'codigo_ruta' => 'required',
        ];

        $messages = [
            'codigo_ruta.required' => 'El código de la ruta es obligatorio',
        ];

        $this->validate($request, $rules, $messages);
    }

    protected function crearRuta(Request $request)
    {
        $ruta = new Ruta();
        $ruta->codigo_ruta = $request->input('codigo_ruta');
        $ruta->tiempo_total = 0;
        $ruta->estado_ruta = "Pendiente";
        $ruta->user_id = $request->input('vendedor');
        $ruta->save();

        return $ruta;
    }

    protected function asignarClientesARuta(Request $request, Ruta $ruta)
    {
        $clientesSeleccionados = $request->input('seleccionados', []);

        foreach ($clientesSeleccionados as $cliente_id) {
            $fechas = $request->input('fechas.' . $cliente_id);
            $cliente = User::clientesXAdmin()->findOrFail($cliente_id);

            $ruta->ubicacions()->attach($cliente->ubicacions->first()->id, [
                'fecha_ini' => $fechas['inicio'],
                'fecha_fin' => $fechas['fin'],
                'estado_visita' => "Pendiente",
            ]);

            $fecha_inicio = Carbon::createFromFormat('Y-m-d', $fechas['inicio']);
            $fecha_fin = Carbon::createFromFormat('Y-m-d', $fechas['fin']);
            $diferencia = $fecha_inicio->diff($fecha_fin);

            $ruta->tiempo_total += $diferencia->days;
        }

        $ruta->update();
    }


    public function verRuta()
    {
        $ruta = Ruta::where('user_id', auth()->user()->id)->first();
        // $ruta->ubicacions->where('user_id',$cliente->id)->first()->pivot->fecha_ini;
        // dd($rutas);
        $rutaId = $ruta->id;
        $codRuta = $ruta->codigo_ruta;

        $clientesEnRuta = User::whereHas('ubicacions.rutas', function ($query) use ($rutaId) {
            $query->where('ruta_id', $rutaId);
        })->with(['ubicacions.rutas' => function ($query) use ($rutaId) {
            $query->where('ruta_id', $rutaId)->withPivot('id', 'fecha_ini', 'fecha_fin', 'estado_visita');
        }])->get();
        // dd($clientesEnRuta);
        return view('rutas.show', compact('ruta', 'clientesEnRuta'));
    }

    public function edit(Ruta $ruta)
    {
        // dd($ruta);
        // $ruta = Ruta::findOrFail($ruta_id);
        $vendedors = User::where('role', 'vendedor')->orderBy('id', 'asc')->get();
        // dd($vendedors);
        $routeId = $ruta->id; // Aquí colocas el ID de la ruta que será pasada como variable
        $rutaId = $routeId;
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
            ->whereHas('ubicacions', function ($query) {
                $query->whereDoesntHave('rutas');
            })->get();
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
            $ruta->ubicacions()->syncWithoutDetaching([$ubicaciones->first()->id => [
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
}
