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
                    <h3 class="mb-0">Nueva Ruta</h3>
                </div>
                <div class="col text-right">
                    <a href="{{ url('/rutas') }}" class="btn btn-sm btn-success">
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
            <form action="{{ url('/rutas/'.$ruta->id) }}" method="POST">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label for="codigo_ruta">Codigo de la ruta</label>
                    <input type="text" name="codigo_ruta" class="form-control" value="{{ old('codigo_ruta',$ruta->codigo_ruta) }}" id="codigo_ruta"
                        required>
                </div>
                <div class="form-group">
                    <label for="vendedor">Vendedores</label>
                    <select name="vendedor" id="vendedor" class="form-control selectpicker" data-style="btn-primary"
                        title="Seleccionar vendedor" required>
                        @foreach ($vendedors as $vendedor)
                            <option value="{{ $vendedor->id }}" @if ($vendedor->id==$ruta->user_id) selected @endif> {{ $vendedor->name }}</option>
                        @endforeach
                    </select>
                </div>
                {{-- <div class="form-group">
                    <label for="familia">familia</label>
                    <select name="familia" id="familia" class="form-control selectpicker" data-style="btn-primary"
                        title="Seleccionar familia" required>
                        @foreach ($familias as $familia)
                            <option value="{{ $familia->id }}"> {{ $familia->nombre }}</option>
                        @endforeach
                    </select>
                </div> --}}
                <h3>Lista de Clientes</h3>
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead>
                            <tr>
                                <th>Cliente</th>
                                <th>Seleccionar</th>
                                <th>Ubicacion</th>
                                <th>Fecha de inicio</th>
                                <th>Fecha final</th>
                                {{-- <th>Seleccionar</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($clientesEnRuta as $cliente)
                            <tr>
                                <td>
                                    {{ $cliente->name }}
                                </td>
                                <td>
                                    <input type="checkbox" name="seleccionados[]" value="{{ $cliente->id }}" @if($ruta->ubicacions()->exists($cliente->ubicacions->first()->id)) checked @endif>
                                </td>
                                <td>
                                    {{-- <select name="rutas_ubicaciones[{{ $cliente->id }}][habitaciones][]" multiple required>
                                        @foreach($habitaciones as $habitacion)
                                            <option value="{{ $habitacion->id }}">{{ $habitacion->nombre }}</option>
                                        @endforeach
                                    </select> --}}
                                    {{$cliente->ubicacions->first()->latitud}} -
                                    {{$cliente->ubicacions->first()->longitud}}
                                </td>
                                <td>
                                    <input type="date" name="fechas[{{ $cliente->id }}][inicio]"  value="{{  $ruta->ubicacions->where('user_id',$cliente->id)->first()->pivot->fecha_ini }}">
                                </td>
                                <td>
                                    <input type="date" name="fechas[{{ $cliente->id }}][fin]"  value="{{ $ruta->ubicacions->where('user_id',$cliente->id)->first()->pivot->fecha_fin }}">
                                </td>
                            </tr>
                            @endforeach
                            @foreach($clientesSinRuta as $cliente)
                            <tr>
                                <td>
                                    {{ $cliente->name }}
                                </td>
                                <td>
                                    <input type="checkbox" name="seleccionados[]" value="{{ $cliente->id }}">
                                </td>
                                <td>
                                    {{-- <select name="rutas_ubicaciones[{{ $cliente->id }}][habitaciones][]" multiple required>
                                        @foreach($habitaciones as $habitacion)
                                            <option value="{{ $habitacion->id }}">{{ $habitacion->nombre }}</option>
                                        @endforeach
                                    </select> --}}
                                    {{$cliente->ubicacions->first()->latitud}} -
                                    {{$cliente->ubicacions->first()->longitud}}
                                </td>
                                <td>
                                    <input type="date" name="fechas[{{ $cliente->id }}][inicio]" >
                                </td>
                                <td>
                                    <input type="date" name="fechas[{{ $cliente->id }}][fin]">
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <br>

                <button type="submit" class="btn btn-primary"> Editar ruta</button>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
@endsection
