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
                    <h3 class="mb-0">Editar subgrupo {{$subgrupo->nombre}}</h3>
                </div>
                <div class="col text-right">
                    <a href="{{ url('/subgrupos') }}" class="btn btn-sm btn-success">
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
                        <strong>Por favor!</strong> {{$error}}
                    </div>
                @endforeach
            @endif
            <form action="{{ url('/subgrupos/'.$subgrupo->id) }}" method="POST">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label for="nombre">Nombre de la subgrupo</label>
                    <input type="text" name="nombre" class="form-control" value="{{old('nombre',$subgrupo->nombre)}}" id="nombre" required>
                </div>
                <div class="form-group">
                    <label for="description">Descripción de la subgrupo</label>
                    <input type="text" name="description" class="form-control" id="description" value="{{old('description',$subgrupo->descripcion)}}">
                </div>
                <div class="form-group">
                    <label for="grupo">Grupos</label>
                    <select name="grupo" id="grupo" class="form-control selectpicker" data-style="btn-primary"
                        title="Seleccionar Grupo" required>
                        @foreach ($grupos as $grupo)
                            <option value="{{ $grupo->id }}" @if ($grupo->id==$subgrupo->grupo->id) selected @endif > {{ $grupo->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary"> Actualizar subgrupo</button>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

    {{-- <script>
        $(document).ready(()=>{});
        $('#users').selectpicker('val',@json($users_ids));
    </script> --}}
@endsection
