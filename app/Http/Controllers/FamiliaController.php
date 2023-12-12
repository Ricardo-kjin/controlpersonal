<?php

namespace App\Http\Controllers;

use App\Models\Familia;
use Illuminate\Http\Request;

class FamiliaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $familias=Familia::orderBy('id','asc')->get();
        return view('familias.index')->with(compact('familias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('familias.create');
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
            'nombre.required'=>'El nombre de la familia es obligatorio',
            'nombre.min'=>'El nombre de la familia debe tener más de 3 carácteres',
        ];

        $this->validate($request,$rules,$messages);
        $familia= new Familia();
        $familia->nombre_familia= $request->input('nombre');
        $familia->save();
        $notification='La Familia ha sido creada correctamente';

        return redirect('/familias')->with(compact('notification'));

    }

    /**
     * Display the specified resource.
     */
    public function show(Familia $familia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Familia $familia)
    {
        return view('familias.edit',compact('familia'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Familia $familia)
    {
        // dd($request,$familia);
        $rules=[
            'nombre'=>'required|min:3',
        ];

        $messages=[
            'nombre.required'=>'El nombre de la familia es obligatorio',
            'nombre.min'=>'El nombre de la familia debe tener más de 3 carácteres',
        ];

        $this->validate($request,$rules,$messages);

        $familia->nombre_familia= $request->input('nombre');
        $familia->save();
        $notification='La familia se ha actualizado correctamente';

        return redirect('/familias')->with(compact('notification'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Familia $familia)
    {

        $familia->delete();
        $notification='La familia se ha eliminado correctamente';

        return redirect('/familias')->with(compact('notification'));
    }
}
