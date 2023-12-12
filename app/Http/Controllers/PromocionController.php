<?php

namespace App\Http\Controllers;

use App\Models\Promocion;
use Illuminate\Http\Request;

class PromocionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $promociones=Promocion::orderBy('id','asc')->get();
        return view('promociones.index')->with(compact('promociones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('promociones.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules=[
            'nombre'=>'required|min:3',
            'descuento'=>'required',
            'monto'=>'required',
        ];

        $messages=[
            'nombre.required'=>'El nombre de la promocion es obligatorio',
            'nombre.min'=>'El nombre de la promocion debe tener más de 3 carácteres',
            'descuento.required'=>'El descuento de la promocion es obligatorio',
            'monto.required'=>'El monto de la promocion es obligatorio',
        ];

        $this->validate($request,$rules,$messages);
        $promocion= new Promocion();
        $promocion->nombre_promocion= $request->input('nombre');
        $promocion->monto= $request->input('monto');
        $promocion->descuento= $request->input('descuento');
        $promocion->save();
        $notification='La Promocion ha sido creada correctamente';

        return redirect('/promociones')->with(compact('notification'));

    }

    /**
     * Display the specified resource.
     */
    public function show(Promocion $promocion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $promocion= Promocion::findOrFail($id);
        return view('promociones.edit',compact('promocion'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        // dd($request,$id);
        $rules=[
            'nombre'=>'required|min:3',
            'descuento'=>'required',
            'monto'=>'required',
        ];

        $messages=[
            'nombre.required'=>'El nombre de la promocion es obligatorio',
            'nombre.min'=>'El nombre de la promocion debe tener más de 3 carácteres',
            'descuento.required'=>'El descuento de la promocion es obligatorio',
            'monto.required'=>'El monto de la promocion es obligatorio',
        ];

        $this->validate($request,$rules,$messages);
        $promocion= Promocion::findOrFail($id);
        $promocion->nombre_promocion= $request->input('nombre');
        $promocion->monto= $request->input('monto');
        $promocion->descuento= $request->input('descuento');
        $promocion->save();
        $notification='La familia se ha actualizado correctamente';

        return redirect('/promociones')->with(compact('notification'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $promocion=Promocion::findOrFail($id);
        $promocionNombre=$promocion->nombre_promocion;
        $promocion->delete();
        $notification="La Promo $promocionNombre se eliminó correctamente";
        return redirect('/promociones')->with(compact('notification'));
    }
}
