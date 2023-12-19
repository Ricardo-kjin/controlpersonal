<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class VendedorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->role=="admin") {
            # code...
            $vendedors=User::vendedorsXAdmin()->paginate(10);
        } else {
            # code...
            $vendedors=User::where('id',auth()->user()->id)->paginate(10);
        }
        // dd($vendedors);
        return view('vendedors.index',compact('vendedors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('vendedors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        $rules=[
            'name'=>'required|min:3',
            'email'=>'required|email',
            'cedula'=>'required|digits:10',
            'address'=>'nullable|min:6',
            'phone'=>'required',
        ];
        $messages=[
            'name.required'=>'El Nombre del vendedor es obligatorio.',
            'name.min'=>'El Nombre del vendedor debe tener mas de 3 caracteres.',
            'email.required'=>'El Correo electrónico es obligatorio',
            'email.email'=>'Ingresa un correo electrónico válido.',
            'cedula.required'=>'La Cédula es obligatorio.',
            'cedula.digist'=>'La cédula debe tener 10 dígitos.',
            'address.min'=>'La dirección debe tener al menos 6 caracteres.',
            'phone.required'=>'El número de teléfono es obligatorio.',
        ];

        $this->validate($request,$rules,$messages);

        User::create(
            $request->only('name','email','cedula','address','phone')
            +[
                'role'=>'vendedor',
                'admin_id'=>auth()->user()->id,
                'password'=> bcrypt($request->input('password'))
            ]
        );
        $notification='El vendedor se ha registrado correctamente.';
        return redirect('/vendedores')->with(compact('notification'));
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $vendedor=User::vendedorsXAdmin(auth()->user()->id)->findOrFail($id);
        // dd($vendedor);
        return view('vendedors.edit',compact('vendedor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rules=[
            'name'=>'required|min:3',
            'email'=>'required|email',
            'cedula'=>'required|digits:10',
            'address'=>'nullable|min:6',
            'phone'=>'required',
        ];
        $messages=[
            'name.required'=>'El Nombre del Vendedor es obligatorio.',
            'name.min'=>'El Nombre del Vendedor debe tener mas de 3 caracteres.',
            'email.required'=>'El Correo electrónico es obligatorio',
            'email.email'=>'Ingresa un correo electrónico válido.',
            'cedula.required'=>'La Cédula es obligatorio.',
            'cedula.digist'=>'La cédula debe tener 10 dígitos.',
            'address.min'=>'La dirección debe tener al menos 6 caracteres.',
            'phone.required'=>'El número de teléfono es obligatorio.',
        ];

        $this->validate($request,$rules,$messages);

        $user=User::vendedorsXAdmin(auth()->user()->id)->findOrFail($id);
        $data=$request->only('name','email','cedula','address','phone');
        $password=$request->input('password');
        if ($password) {
            $data['password']=bcrypt($password);
        }
        $user->fill($data);
        $user->save();
        $notification='El vendedor se ha actualizado correctamente.';
        return redirect('/vendedores')->with(compact('notification'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user=User::vendedorsXAdmin(auth()->user()->id)->findOrFail($id);
        $vendedorName=$user->name;
        $user->delete();
        $notification="El vendedor $vendedorName se eliminó correctamente";
        return redirect('/vendedores')->with(compact('notification'));
    }
}
