@extends('layouts.panel')

@section('styles')
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
@endsection

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-info shadow-info border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Nuevo SubGrupo</h6>
                    </div>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger alert-dismissible text-white fade show" role="alert">
                                <span class="alert-icon align-middle">
                                    <span class="material-icons text-md">
                                        warning
                                    </span>
                                </span>
                                <span class="alert-text"><strong>Por favor!!</strong> {{ $error }}</span>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endforeach
                    @else
                    @endif
                    <form method="POST" action="{{ url('/subgrupos') }}">
                        @csrf
                        <div class="form-control">
                            <div class="input-group input-group-dynamic mb-4">
                                <label for="nombre" class="form-label">NOMBRE DEL SUBGRUPO</label>
                                <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}"
                                    id="nombre" required>
                            </div>
                        </div>
                        <div class="form-control">
                            <div class="input-group input-group-dynamic mb-4">
                                <label for="decripcion" class="form-label">DESCRIPCION</label>
                                <input type="text" name="decripcion" class="form-control" value="{{ old('decripcion') }}"
                                    id="decripcion" required>
                            </div>
                        </div>
                        <div class="form-control">
                            <div class="input-group input-group-static mb-4">
                                <label for="grupo" class="ms-0">SELECCIONAR GRUPO</label>
                                <select class="form-control" id="grupo" name="grupo">
                                    @foreach ($grupos as $grupo)
                                        <option value="{{ $grupo->id }}"> {{ $grupo->nombre_grupo }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div>
                            <button type="submit" class="btn bg-gradient-primary">Guardar</button>
                            <a href="{{ url('/subgrupos') }}" type="button" class="btn btn-outline-success"
                                title="Regresar"><i class="material-icons">arrow_back</i> Regresar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow" hidden>
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Nueva subgrupo</h3>
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
                        <strong>Por favor!</strong> {{ $error }}
                    </div>
                @endforeach
            @endif
            <form action="{{ url('/subgrupos') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="nombre">Nombre del subgrupo</label>
                    <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}" id="nombre"
                        required>
                </div>
                <div class="form-group">
                    <label for="description">Descripción del Subgrupo</label>
                    <input type="text" name="description" class="form-control" id="description"
                        value="{{ old('description') }}">
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
                <button type="submit" class="btn btn-primary"> Crear subgrupo</button>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
@endsection
