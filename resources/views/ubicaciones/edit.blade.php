@extends('layouts.panel')

@section('styles')
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <style>
        #map-canvas {
            height: 300px; /* Ajusta la altura según tus necesidades */
        }
    </style>
@endsection

@section('content')
    <div class="card shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    @if (auth()->user()->role=="admin" || auth()->user()->role=="cliennte")
                        <h3 class="mb-0">Editar la ubicación para el {{$ubicacion->user()->first()->role}} {{$ubicacion->user()->first()->name}}</h3>
                    @else
                    <h3 class="mb-0">Ubicacion del {{$ubicacion->user()->first()->role}}: {{$ubicacion->user()->first()->name}}</h3>
                    @endif
                </div>
                @if (auth()->user()->role=="admin" || auth()->user()->role=="cliennte")
                    <div class="col text-right">
                        <a href="{{ url('/clientes') }}" class="btn btn-sm btn-success">
                            <i class="fas fa-chevron-left"></i>
                            Regresar
                        </a>
                    </div>
                @endif
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
            <form action="{{ url('/ubicaciones/'.$ubicacion->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="latitud">Latitud</label>
                    <input type="text" name="latitud" class="form-control" value="{{ old('latitud', $ubicacion->latitud) }}" id="latitud" required>
                </div>
                <div class="form-group">
                    <label for="longitud">Longitud</label>
                    <input type="text" name="longitud" class="form-control" id="longitud" value="{{ old('longitud', $ubicacion->longitud) }}">
                </div>
                <div class="form-group">
                    <label for="url_map">Url de la Ubicación</label>
                    <input type="text" name="url_map" class="form-control" id="url_map" value="{{ old('url_map', $ubicacion->url_map) }}">
                </div>
                <div class="form-group">
                    {{-- <label for="">Mapa</label> --}}
                    {{-- <input type="text" id="searchmap"> --}}
                    <div id="map-canvas"></div>
                </div>
                @if (auth()->user()->role=="admin" || auth()->user()->role=="cliennte")
                    <button type="submit" class="btn btn-primary">Guardar Ubicación</button>

                @endif
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCo8vo4_Bta_TxoBm9RjLaMmyZO4Mfnf4A&libraries=places&callback=initMap" async defer></script>
    <script>
        var map;
        var marker;

        function initMap() {
            map = new google.maps.Map(document.getElementById('map-canvas'), {
                zoom: 15,
            });

            // Obtener latitud y longitud existentes desde los campos de entrada
            var latitud = parseFloat(document.getElementById('latitud').value) || 0;
            var longitud = parseFloat(document.getElementById('longitud').value) || 0;

            // Establecer el mapa en la ubicación existente
            var userLocation = {
                lat: latitud,
                lng: longitud
            };

            map.setCenter(userLocation);

            // Colocar un marcador en la ubicación existente
            marker = new google.maps.Marker({
                map: map,
                draggable: true,
                position: userLocation,
            });

            // Actualizar los campos de entrada al mover el marcador
            google.maps.event.addListener(marker, 'drag', function () {
                updateLatLng(marker.getPosition());
            });
        }

        function updateLatLng(position) {
            document.getElementById('latitud').value = position.lat();
            document.getElementById('longitud').value = position.lng();
        }
    </script>
@endsection
