<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use App\Models\Subgrupo;
use Illuminate\Http\Request;

class SubgrupoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subgrupos=Subgrupo::orderBy('id','asc')->get();
        // dd($subgrupos);
        return view('subgrupos.index',compact('subgrupos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $grupos=Grupo::orderBy('id','asc')->get();
        return view('subgrupos.create',compact('grupos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        $rules=[
            'nombre'=>'required|min:3',
        ];

        $messages=[
            'nombre.required'=>'El nombre de la grupo es obligatorio',
            'nombre.min'=>'El nombre de la grupo debe tener más de 3 carácteres',
        ];

        $this->validate($request,$rules,$messages);
        $subgrupo= new Subgrupo();
        $subgrupo->nombre_subgrupo= $request->input('nombre');
        $subgrupo->descripcion= $request->input('descripcion');
        $subgrupo->grupo_id= $request->input('grupo');
        // dd($subgrupo);
        $subgrupo->save();
        $notification='El subgrupo ha sido creada correctamente';

        return redirect('/subgrupos')->with(compact('notification'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Subgrupo $subgrupo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subgrupo $subgrupo)
    {
        // dd($subgrupo);
        $grupos=Grupo::orderBy('id','asc')->get();
        // dd($grupos);
        return view('subgrupos.edit', compact('subgrupo','grupos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subgrupo $subgrupo)
    {
        // dd($subgrupo);
        $rules=[
            'nombre'=>'required|min:3',
        ];

        $messages=[
            'nombre.required'=>'El nombre de la grupo es obligatorio',
            'nombre.min'=>'El nombre de la grupo debe tener más de 3 carácteres',
        ];

        $this->validate($request,$rules,$messages);

        $subgrupo->nombre_subgrupo= $request->input('nombre');
        $subgrupo->descripcion= $request->input('descripcion');
        $subgrupo->grupo_id= $request->input('grupo');
        // dd($subgrupo);
        $subgrupo->save();
        $notification='El subgrupo ha sido actualizada correctamente';

        return redirect('/subgrupos')->with(compact('notification'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subgrupo $subgrupo)
    {
        $subgrupo->delete();
        $notification='El Subgrupo se ha eliminado correctamente';

        return redirect('/subgrupos')->with(compact('notification'));
    }
}
