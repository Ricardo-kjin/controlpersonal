@extends('layouts.panel')

@section('content')
    <div class="card shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">vendedores</h3>
                </div>
                <div class="col text-right">
                    <a href="{{url('/vendedores/create')}}" class="btn btn-sm btn-primary">Nuevo vendedor</a>
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
                        <th scope="col">Url Ubicacion</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($vendedors as $vendedor)

                    <tr>
                        <th scope="row">
                            {{$vendedor->name}}
                        </th>

                        <td>
                            <a href="{{url('/vermaps/'.$vendedor->ubicacions->first()->id)}}">
                                {{$vendedor->ubicacions->first()->url_map}}
                            </a>
                            {{-- @if ($vendedor->ubicacion)
                                Ubicacion Registrada <br> <a href="{{url('/ubicaciones/vendedores/'.$vendedor->id.'/edit')}}">Editar</a>
                            @else
                                <a title="Añadir una Ubicación" href="{{url('/ubicaciones/vendedores/'.$vendedor->id)}}">Registrar Ubicacion</a>
                            @endif --}}
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-body">
            {{$vendedors->links()}}
        </div>
    </div>
@endsection

