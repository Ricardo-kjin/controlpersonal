<?php

namespace App\Http\Controllers;

use App\Models\Familia;
use App\Models\Grupo;
use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    private $rules = [
        'nombre' => 'required|min:3',
        'precio' => 'required',
        'stock' => 'required',
    ];

    private $messages = [
        'nombre.required' => 'El nombre del producto es obligatorio',
        'nombre.min' => 'El nombre del producto debe tener más de 3 caracteres',
        'precio.required' => 'El precio del producto es obligatorio',
        'stock.required' => 'El stock del producto es obligatorio',
    ];

    public function index()
    {
        $productos = Producto::orderBy('id', 'asc')->get();
        return view('productos.index', compact('productos'));
    }

    public function create()
    {
        $grupos = $this->getGrupos();
        $familias = $this->getFamilias();
        return view('productos.create', compact('grupos', 'familias'));
    }

    public function store(Request $request)
    {
        $this->validate($request, $this->rules, $this->messages);
        $producto = new Producto($request->all());
        $producto->estado_producto = "Activo";
        $producto->save();
        $notification = 'El producto ha sido creado correctamente';
        return redirect('/productos')->with(compact('notification'));
    }

    public function edit(Producto $producto)
    {
        $grupos = $this->getGrupos();
        $familias = $this->getFamilias();
        return view('productos.edit', compact('producto', 'grupos', 'familias'));
    }

    public function update(Request $request, Producto $producto)
    {
        $this->validate($request, $this->rules, $this->messages);
        $producto->update($request->all());
        $producto->estado_producto = "Activo";
        $producto->save();
        $notification = 'El producto ha sido actualizado correctamente';
        return redirect('/productos')->with(compact('notification'));
    }

    public function destroy(Producto $producto)
    {
        $producto->delete();
        $notification = 'El producto se ha eliminado correctamente';
        return redirect('/productos')->with(compact('notification'));
    }

    private function getGrupos()
    {
        return Grupo::orderBy('id', 'asc')->get();
    }

    private function getFamilias()
    {
        return Familia::orderBy('id', 'asc')->get();
    }
}
