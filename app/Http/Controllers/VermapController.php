<?php

namespace App\Http\Controllers;

use App\Models\Ubicacion;
use Illuminate\Http\Request;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

class VermapController extends Controller
{

    public function index()
    {
        $vendedors = User::where('role', 'vendedor')->has('ubicacions')->with('ubicacions')->paginate(10);
        // dd($vendedors);

        return view('tiemporeals.index', compact('vendedors'));
    }
    public function verUbicacionCompartida(string $id)
    {
        // dd($id);
        $user=User::find($id);
        $ubicacion=Ubicacion::where('user_id',$id)->first();
        // dd($user);
        return view('tiemporeals.show',compact('user','ubicacion'));

    }

}
