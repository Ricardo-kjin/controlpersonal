<?php

namespace App\Http\Controllers;

use App\Models\Familia;
use App\Models\Grupo;
use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productos=Producto::orderBy('id','asc')->get();
        return view('productos.index',compact('productos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $grupos=Grupo::orderBy('id','asc')->get();
        $familias=Familia::orderBy('id','asc')->get();
        // dd($familias->pluck('id'));
        return view('productos.create',compact('grupos','familias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        $rules=[
            'nombre'=>'required|min:3',
            'precio'=>'required',
            'stock'=>'required',
        ];

        $messages=[
            'nombre.required'=>'El nombre del producto es obligatorio',
            'nombre.min'=>'El nombre del producto debe tener más de 3 carácteres',
            'precio.required'=>'El precio del producto es obligatorio',
            'stock.required'=>'El stock del producto es obligatorio',
        ];

        $this->validate($request,$rules,$messages);
        $producto= new Producto();
        $producto->nombre_producto= $request->input('nombre');
        $producto->descripcion= $request->input('descripcion');
        $producto->stock= $request->input('stock');
        $producto->precio= $request->input('precio');
        $producto->unidad_medida= $request->input('unidad_medida');
        $producto->estado_producto= "Activo";
        $producto->grupo_id= $request->input('grupo');
        $producto->familia_id= $request->input('familia');
        // $producto->user_id= auth()->user()->id;
        // dd($producto);
        $producto->save();
        $notification='El producto ha sido creada correctamente';

        return redirect('/productos')->with(compact('notification'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Producto $producto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Producto $producto)
    {
        $grupos=Grupo::orderBy('id','asc')->get();
        $familias=Familia::orderBy('id','asc')->get();

        return view('productos.edit', compact('producto','grupos','familias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Producto $producto)
    {
        // dd($producto);
        $rules=[
            'nombre'=>'required|min:3',
            'precio'=>'required',
            'stock'=>'required',
        ];

        $messages=[
            'nombre.required'=>'El nombre de la grupo es obligatorio',
            'nombre.min'=>'El nombre de la grupo debe tener más de 3 carácteres',
            'precio.required'=>'El precio del producto es obligatorio',
            'stock.required'=>'El stock del producto es obligatorio',
        ];

        $this->validate($request,$rules,$messages);

        $producto->nombre_producto= $request->input('nombre');
        $producto->descripcion= $request->input('description');
        $producto->stock= $request->input('stock');
        $producto->precio= $request->input('precio');
        $producto->unidad_medida= $request->input('unidad_medida');
        $producto->estado_producto= "Activo";
        $producto->grupo_id= $request->input('grupo');
        $producto->familia_id= $request->input('familia');
        // dd($subgrupo);
        $producto->save();
        $notification='El producto ha sido actualizada correctamente';

        return redirect('/productos')->with(compact('notification'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto)
    {
        $producto->delete();
        $notification='El producto se ha eliminado correctamente';

        return redirect('/productos')->with(compact('notification'));
    }
}
