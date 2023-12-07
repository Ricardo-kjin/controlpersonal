@extends('layouts.panel')

@section('styles')
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
@endsection

@section('content')
    <div class="card shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Editar la ubicacion para el {{$ubicacion->user()->first()->role}} {{$ubicacion->user()->first()->name}}</h3>
                </div>
                <div class="col text-right">
                    <a href="{{ url('/vendedores') }}" class="btn btn-sm btn-success">
                        <i class="fas fa-chevron-left"></i>
                        Regresar
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger" role="alert">
                        <i class="fas fa-exclamation-triangle"></i>
                        <strong>Por favor!</strong> {{ $error }}
                    </div>
                @endforeach
            @endif
            <form action="{{ url('/ubicaciones/vendedores/'.$ubicacion->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="latitud">Latitud</label>
                    <input type="text" name="latitud" class="form-control" value="{{ old('latitud',$ubicacion->latitud) }}" id="latitud"
                        required>
                </div>
                <div class="form-group">
                    <label for="longitud">Longitud</label>
                    <input type="text" name="longitud" class="form-control" id="longitud"
                        value="{{ old('longitud',$ubicacion->longitud) }}">
                </div>
                <div class="form-group">
                    <label for="url_map">Url de la Ubicacion</label>
                    <input type="text" name="url_map" class="form-control" id="url_map"
                        value="{{ old('url_map',$ubicacion->url_map) }}">
                </div>
                {{-- <div class="form-group" style="display: none">
                    <label for="user_id">Usuario</label>
                    <input type="number" step="any" name="user_id" class="form-control" id="user_id"
                        value="{{ $user->id}}">
                </div> --}}

                <button type="submit" class="btn btn-primary"> Guardar Ubicacion</button>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
@endsection
