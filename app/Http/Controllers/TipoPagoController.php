<?php

namespace App\Http\Controllers;

use App\Models\TipoPago;
use Illuminate\Http\Request;

class TipoPagoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tipopagos=TipoPago::orderBy('id','asc')->get();
        return view('tipopagos.index')->with(compact('tipopagos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tipopagos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules=[
            'nombre'=>'required|min:2',
        ];

        $messages=[
            'nombre.required'=>'El nombre del tipo de pago es obligatorio',
            'nombre.min'=>'El nombre del tipo de pago debe tener más de 3 carácteres',
        ];

        $this->validate($request,$rules,$messages);
        $tipopago= new TipoPago();
        $tipopago->nombre_tipopago= $request->input('nombre');
        $tipopago->save();
        $notification='El tipo de pago ha sido creada correctamente';

        return redirect('/tipopagos')->with(compact('notification'));
    }

    /**
     * Display the specified resource.
     */
    public function show(TipoPago $tipoPago)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // dd($id);
        $tipopago= TipoPago::findOrFail($id);
        return view('tipopagos.edit',compact('tipopago'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rules=[
            'nombre'=>'required|min:2',
        ];

        $messages=[
            'nombre.required'=>'El nombre de la tipopago es obligatorio',
            'nombre.min'=>'El nombre de la tipopago debe tener más de 3 carácteres',
        ];

        $this->validate($request,$rules,$messages);
        $tipopago= TipoPago::findOrFail($id);
        $tipopago->nombre_tipopago= $request->input('nombre');
        $tipopago->save();
        $notification='el tipo de pago se ha actualizado correctamente';

        return redirect('/tipopagos')->with(compact('notification'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tipopago=TipoPago::findOrFail($id);
        $tipopagoNombre=$tipopago->nombre_tipopago;
        $tipopago->delete();
        $notification="El tipo de pago $tipopagoNombre se eliminó correctamente";
        return redirect('/tipopagos')->with(compact('notification'));
    }
}
