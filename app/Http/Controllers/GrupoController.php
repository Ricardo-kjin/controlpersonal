<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use Illuminate\Http\Request;

class GrupoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $grupos=Grupo::orderBy('id','asc')->get();
        return view('grupos.index',compact('grupos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('grupos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules=[
            'nombre'=>'required|min:3',
        ];

        $messages=[
            'nombre.required'=>'El nombre de la grupo es obligatorio',
            'nombre.min'=>'El nombre de la grupo debe tener más de 3 carácteres',
        ];

        $this->validate($request,$rules,$messages);
        $grupo= new Grupo();
        $grupo->nombre_grupo= $request->input('nombre');
        $grupo->save();
        $notification='La grupo ha sido creada correctamente';

        return redirect('/grupos')->with(compact('notification'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Grupo $grupo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Grupo $grupo)
    {
        return view('grupos.edit',compact('grupo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Grupo $grupo)
    {
        $rules=[
            'nombre'=>'required|min:3',
        ];

        $messages=[
            'nombre.required'=>'El nombre de la grupo es obligatorio',
            'nombre.min'=>'El nombre de la grupo debe tener más de 3 carácteres',
        ];

        $this->validate($request,$rules,$messages);

        $grupo->nombre_grupo= $request->input('nombre');
        $grupo->save();
        $notification='La grupo se ha actualizado correctamente';

        return redirect('/grupos')->with(compact('notification'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Grupo $grupo)
    {
        $grupo->delete();
        $notification='La grupo se ha eliminado correctamente';

        return redirect('/grupos')->with(compact('notification'));
    }
}
