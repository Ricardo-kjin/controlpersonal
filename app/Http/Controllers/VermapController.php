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
        $vendedors = User::vendedorsXAdmin(auth()->user()->id)->has('ubicacions')->paginate(10);
        // dd($vendedors);
        return view('tiemporeals.index', compact('vendedors'));
    }
    public function verUbicacionCompartida(Request $request)
    {


    }

}
