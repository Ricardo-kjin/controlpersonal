<?php

namespace App\Http\Controllers;

use App\Models\Ubicacion;
use App\Models\User;
use Illuminate\Http\Request;

class UbicacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $user_id)
    {
        $user=User::find($user_id);
        return view('ubicaciones.create',compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules=[
            'latitud'=>'required',
            'longitud'=>'required',
            'url_map'=>'required',
        ];

        $messages=[
            'latitud.required'=>'La latitud de la ubicacion es obligatorio',
            'longitud.required'=>'La logitud de la ubicacion es obligatorio',
            'url_map.required'=>'El campo Url de la ubicacion es obligatorio',
        ];

        $this->validate($request,$rules,$messages);
        $ubicacion= new Ubicacion();
        $ubicacion->latitud= $request->input('latitud');
        $ubicacion->longitud= $request->input('longitud');
        $ubicacion->url_map= $request->input('url_map');
        $ubicacion->estado_ubicacion= "Activo";
        $ubicacion->user_id= $request->input('user_id');
        // dd($ubicacion);
        // dd($ubicacion,$request);
        $ubicacion->save();
        $notification='La ubicacion ha sido creada correctamente';

        return redirect('/clientes')->with(compact('notification'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Ubicacion $ubicacion)
    {
        dd($ubicacion);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $user_id)
    {
        $ubicacion=User::find($user_id)->ubicacions()->first();
        // dd($ubicacion);
        return view('ubicaciones.edit',compact('ubicacion'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ubicacion $ubicacion)
    {
        // dd($ubicacion,$request);
        $rules=[
            'latitud'=>'required',
            'longitud'=>'required',
            'url_map'=>'required',
        ];

        $messages=[
            'latitud.required'=>'La latitud de la ubicacion es obligatorio',
            'longitud.required'=>'La logitud de la ubicacion es obligatorio',
            'url_map.required'=>'El campo Url de la ubicacion es obligatorio',
        ];

        $this->validate($request,$rules,$messages);
        // $ubicacion= new Ubicacion();
        $ubicacion->latitud= $request->input('latitud');
        $ubicacion->longitud= $request->input('longitud');
        $ubicacion->url_map= $request->input('url_map');
        // dd($ubicacion);
        // dd($ubicacion,$request);
        $ubicacion->save();
        $notification='La ubicacion ha sido actualizada correctamente';

        return redirect('/clientes')->with(compact('notification'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ubicacion $ubicacion)
    {
        //
    }

    public function createv(string $user_id)
    {
        $user=User::find($user_id);
        // dd($user);
        return view('ubicaciones.createv',compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storev(Request $request)
    {
        $rules=[
            'latitud'=>'required',
            'longitud'=>'required',
            'url_map'=>'required',
        ];

        $messages=[
            'latitud.required'=>'La latitud de la ubicacion es obligatorio',
            'longitud.required'=>'La logitud de la ubicacion es obligatorio',
            'url_map.required'=>'El campo Url de la ubicacion es obligatorio',
        ];

        $this->validate($request,$rules,$messages);
        $ubicacion= new Ubicacion();
        $ubicacion->latitud= $request->input('latitud');
        $ubicacion->longitud= $request->input('longitud');
        $ubicacion->url_map= $request->input('url_map');
        $ubicacion->estado_ubicacion= "Activo";
        $ubicacion->user_id= $request->input('user_id');
        // dd($ubicacion);
        // dd($ubicacion,$request);
        $ubicacion->save();
        $notification='La ubicacion ha sido creada correctamente';

        return redirect('/vendedores')->with(compact('notification'));
    }

    public function editv(string $user_id)
    {
        $ubicacion=User::find($user_id)->ubicacions()->first();
        // dd($ubicacion);
        return view('ubicaciones.editv',compact('ubicacion'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function updatev(Request $request, Ubicacion $ubicacion)
    {
        // dd($ubicacion,$request);
        $rules=[
            'latitud'=>'required',
            'longitud'=>'required',
            'url_map'=>'required',
        ];

        $messages=[
            'latitud.required'=>'La latitud de la ubicacion es obligatorio',
            'longitud.required'=>'La logitud de la ubicacion es obligatorio',
            'url_map.required'=>'El campo Url de la ubicacion es obligatorio',
        ];

        $this->validate($request,$rules,$messages);
        // $ubicacion= new Ubicacion();
        $ubicacion->latitud= $request->input('latitud');
        $ubicacion->longitud= $request->input('longitud');
        $ubicacion->url_map= $request->input('url_map');
        // dd($ubicacion);
        // dd($ubicacion,$request);
        $ubicacion->save();
        $notification='La ubicacion ha sido actualizada correctamente';

        return redirect('/vendedores')->with(compact('notification'));
    }
}
