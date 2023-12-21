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
                    <h3 class="mb-0">Informacion de la Ruta</h3>
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

                <div class="form-group">
                    <label for="vendedor">Rutas</label>
                    <h4>{{$ruta->codigo_ruta}}</h4>
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

                <br>
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead>
                            <tr>
                                <th>Cliente</th>
                                {{-- <th>Seleccionar</th> --}}
                                <th>Ubicacion</th>
                                <th>Estado de Visita</th>
                                <th>Fecha de inicio</th>
                                <th>Fecha final</th>
                                <th>Opcion</th>
                                {{-- <th>Seleccionar</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($clientesEnRuta as $cliente)
                            <tr>
                                <td>
                                    {{ $cliente->name }}
                                </td>
                                {{-- <td>
                                    <input type="checkbox" name="seleccionados[]" value="{{ $cliente->id }}" @if($ruta->ubicacions()->exists($cliente->ubicacions->first()->id)) checked @endif>
                                </td> --}}
                                <td>
                                    {{-- <select name="rutas_ubicaciones[{{ $cliente->id }}][habitaciones][]" multiple required>
                                        @foreach($habitaciones as $habitacion)
                                            <option value="{{ $habitacion->id }}">{{ $habitacion->nombre }}</option>
                                        @endforeach
                                    </select> --}}
                                    {{$cliente->ubicacions->first()->latitud}} -
                                    {{$cliente->ubicacions->first()->longitud}} <br>
                                    <span class="text-xs font-weight-bold mb-0 ">
                                        @if ($cliente->ubicacions->first())
                                          Ubicacion Registrada <br>
                                          <a href="{{ url('/ubicaciones/' . $cliente->id . '/edit') }}">ver Ubicacion</a>

                                        @endif
                                      </span>
                                </td>
                                <td>
                                    {{ optional($cliente->ubicacions->first()->rutas->first()->pivot)->estado_visita }} <br>
                                    @if ( optional($cliente->ubicacions->first()->rutas->first()->pivot)->updated_at )
                                        fecha: {{ optional($cliente->ubicacions->first()->rutas->first()->pivot)->updated_at }}
                                    @endif
                                </td>
                                <td>
                                    <input type="date" name="fechas[{{ $cliente->id }}][inicio]" value="{{ optional($cliente->ubicacions->first()->rutas->first()->pivot)->fecha_ini }}">
                                </td>
                                <td>
                                    <input type="date" name="fechas[{{ $cliente->id }}][fin]" value="{{ optional($cliente->ubicacions->first()->rutas->first()->pivot)->fecha_fin }}">
                                </td>
                                <td><a href="{{url('/imagenes/create/'.$cliente->id)}}" class="btn btn-sm btn-primary">Marcar Visita</a></td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>

        </div>
    </div>
@endsection
@section('scripts')
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
@endsection
