@extends('layouts.panel')

@section('content')
    <div class="card shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">clientes</h3>
                </div>
                <div class="col text-right">
                    <a href="{{url('/clientes/create')}}" class="btn btn-sm btn-primary">Nuevo cliente</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            @if (session('notification'))
            <div class="alert alert-success" role="alert">
                 {{session('notification')}}
            </div>
            @endif
        </div>
        <div class="table-responsive">
            <!-- Projects table -->
            <table class="table align-items-center table-flush">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Cedula</th>
                        <th scope="col">Rol</th>
                        <th scope="col">UBICACION</th>
                        @if (auth()->user()->role=='admin')
                            <th scope="col">Opciones</th>
                        @endif

                    </tr>
                </thead>
                <tbody>
                    @foreach ($clientes as $cliente)

                    <tr>
                        <th scope="row">
                            {{$cliente->name}}
                        </th>
                        <td>
                            {{$cliente->email}}
                        </td>
                        <td>
                            {{$cliente->cedula}}
                        </td>
                        <td>
                            {{$cliente->role}}
                        </td>
                        <td>
                            @if ($cliente->ubicacions->first())
                                Ubicacion Registrada <br> <a href="{{url('/ubicaciones/'.$cliente->id.'/edit')}}">Editar</a>
                            @else
                                <a title="Añadir una Ubicación" href="{{url('/ubicaciones/'.$cliente->id)}}">Registrar Ubicacion</a>
                            @endif
                        </td>
                        @if (auth()->user()->role=='admin')
                            <td>
                                <form action="{{url('/clientes/'.$cliente->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <a href="{{url('/clientes/'.$cliente->id.'/edit')}}" class="btn btn-sm btn-primary">Editar</a>
                                    <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                                </form>
                            </td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-body">
            {{$clientes->links()}}
        </div>
    </div>
@endsection

