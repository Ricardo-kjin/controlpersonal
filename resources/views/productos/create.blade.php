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
                    <h3 class="mb-0">Nueva producto</h3>
                </div>
                <div class="col text-right">
                    <a href="{{ url('/productos') }}" class="btn btn-sm btn-success">
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
            <form action="{{ url('/productos') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="nombre">Nombre del producto</label>
                    <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}" id="nombre"
                        required>
                </div>
                <div class="form-group">
                    <label for="description">Descripción del producto</label>
                    <input type="text" name="description" class="form-control" id="description"
                        value="{{ old('description') }}">
                </div>
                <div class="form-group">
                    <label for="stock">Stock</label>
                    <input type="number" name="stock" class="form-control" id="stock"
                        value="{{ old('stock') }}">
                </div>
                <div class="form-group">
                    <label for="precio">Precio</label>
                    <input type="number" step="any" name="precio" class="form-control" id="precio"
                        value="{{ old('precio') }}">
                </div>
                <div class="form-group">
                    <label for="unidad_medida">Unidad de Medida</label>
                    <input type="text" name="unidad_medida" class="form-control" id="unidad_medida"
                        value="{{ old('unidad_medida') }}">
                </div>
                <div class="form-group">
                    <label for="grupo">Grupo</label>
                    <select name="grupo" id="grupo" class="form-control selectpicker" data-style="btn-primary"
                        title="Seleccionar Grupo" required>
                        @foreach ($grupos as $grupo)
                            <option value="{{ $grupo->id }}"> {{ $grupo->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="familia">familia</label>
                    <select name="familia" id="familia" class="form-control selectpicker" data-style="btn-primary"
                        title="Seleccionar familia" required>
                        @foreach ($familias as $familia)
                            <option value="{{ $familia->id }}"> {{ $familia->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary"> Crear producto</button>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
@endsection
