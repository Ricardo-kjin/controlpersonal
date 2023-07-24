@extends('layouts.panel')

@section('content')
    <div class="card shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Familias</h3>
                </div>
                @if (auth()->user()->role=='admin')

                <div class="col text-right">
                    <a href="{{url('/familias/create')}}" class="btn btn-sm btn-primary"> Nueva Familia</a>
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
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($familias as $familia)

                    <tr>
                        <th scope="row">
                            {{$familia->id}}
                        </th>
                        <th scope="row">
                            {{$familia->nombre}}
                        </th>
                        <td>
                            <form action="{{url('/familias/'.$familia->id)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                @if (auth()->user()->role=='admin')
                                    <a href="{{url('/familias/'.$familia->id.'/edit')}}" class="btn btn-sm btn-primary">Editar</a>
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
