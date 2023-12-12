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
                        <h6 class="text-white text-capitalize ps-3">NUEVO PRODUCTO</h6>
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
                    <form method="POST" action="{{ url('/productos') }}">
                        @csrf
                        <div class="form-control">
                            <div class="input-group input-group-dynamic mb-1">
                                <label for="nombre" class="form-label">NOMBRE DEL PRODUCTO</label>
                                <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}"
                                    id="nombre" required>
                            </div>
                        </div>
                        <div class="form-control">
                            <div class="input-group input-group-dynamic mb-1">
                                <label for="descripcion" class="form-label">DESCRIPCION</label>
                                <input type="text" name="descripcion" class="form-control" value="{{ old('descripcion') }}"
                                    id="descripcion" required>
                            </div>
                        </div>
                        <div class="form-control">
                            <div class="input-group input-group-dynamic mb-1">
                                <label for="precio" class="form-label">PRECIO DEL PRODUCTO</label>
                                <input type="text" name="precio" class="form-control" value="{{ old('precio') }}"
                                    id="precio" required>
                            </div>
                        </div>
                        <div class="form-control">
                            <div class="input-group input-group-dynamic mb-1">
                                <label for="stock" class="form-label">STOCK DEL PRODUCTO</label>
                                <input type="text" name="stock" class="form-control" value="{{ old('stock') }}"
                                    id="stock" required>
                            </div>
                        </div>
                        <div class="form-control">
                            <div class="input-group input-group-dynamic mb-1">
                                <label for="unidad_medida" class="form-label">UNIDAD DE MEDIDA DEL PRODUCTO</label>
                                <input type="text" name="unidad_medida" class="form-control" value="{{ old('unidad_medida') }}"
                                    id="unidad_medida" required>
                            </div>
                        </div>
                        <div class="form-control">
                            <div class="input-group input-group-static mb-1">
                                <label for="grupo" class="ms-0">GRUPO DEL PRODUCTO</label>
                                <select class="form-control" id="grupo" name="grupo">
                                    @foreach ($grupos as $grupo)
                                        <option value="{{ $grupo->id }}"> {{ $grupo->nombre_grupo }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-control">
                            <div class="input-group input-group-static mb-1">
                                <label for="familia" class="ms-0">FAMILIA DEL PRODUCTO</label>
                                <select class="form-control" id="familia" name="familia">
                                    @foreach ($familias as $familia)
                                        <option value="{{ $familia->id }}"> {{ $familia->nombre_familia }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div>
                            <button type="submit" class="btn bg-gradient-primary">Guardar</button>
                            <a href="{{ url('/productos') }}" type="button" class="btn btn-outline-success"
                                title="Regresar"><i class="material-icons">arrow_back</i> Regresar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
@endsection
