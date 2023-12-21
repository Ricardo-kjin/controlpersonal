@extends('layouts.panel')

@section('content')
    <div class="card shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">rutas</h3>
                </div>
                @if (auth()->user()->role=='admin')

                <div class="col text-right">
                    <a href="{{url('/rutas/create')}}" class="btn btn-sm btn-primary"> Nueva ruta</a>
                </div>
                @endif
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
                        <th scope="col">Vendedor</th>
                        <th scope="col">estado</th>
                        <th scope="col">tiempo total</th>
                        <th scope="col"># Ubicaciones</th>
                        @if (auth()->user()->role=='admin')
                            <th scope="col">Opciones</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rutas as $ruta)

                    <tr>
                        <th scope="row">
                            {{$ruta->codigo_ruta}}
                        </th>
                        <th scope="row">
                            {{$ruta->user->name}}
                        </th>
                        <th scope="row">
                            {{$ruta->estado_ruta}}
                        </th>
                        <th scope="row">
                            {{$ruta->tiempo_total}}
                        </th>
                        <th scope="row">
                            {{$ruta->ubicacions()->count()}}
                        </th>
                        <td>
                            <form action="{{url('/rutas/'.$ruta->id)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                @if (auth()->user()->role=='admin')
                                    <a href="{{url('/rutas/'.$ruta->id.'/edit')}}" class="btn btn-sm btn-primary">Editar</a>
                                    <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>

                                @endif
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
