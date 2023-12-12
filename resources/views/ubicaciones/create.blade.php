@extends('layouts.panel')

@section('styles')
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css"> --}}
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
                    <h3 class="mb-0">Registro de ubicacion para el {{$user->role}} {{$user->name}}</h3>
                </div>
                <div class="col text-right">
                    <a href="{{ url('/clientes') }}" class="btn btn-sm btn-success">
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
            <form action="{{ url('/ubicaciones') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="">Mapa</label>
                    <input type="text" id="searchmap">
                    <div id="map-canvas"></div>
                </div>
                <div class="form-group">
                    <label for="latitud">Latitud</label>
                    <input type="text" name="latitud" class="form-control" value="{{ old('latitud') }}" id="latitud" required>
                </div>
                <div class="form-group">
                    <label for="longitud">Longitud</label>
                    <input type="text" name="longitud" class="form-control" id="longitud" value="{{ old('longitud') }}">
                </div>
                <div class="form-group">
                    <label for="url_map">Url de la Ubicacion</label>
                    <input type="text" name="url_map" class="form-control" id="url_map" value="{{ old('url_map') }}">
                </div>
                <div class="form-group" style="display: none">
                    <label for="user_id">Usuario</label>
                    <input type="number" step="any" name="user_id" class="form-control" id="user_id" value="{{ $user->id }}">
                </div>

                <button type="submit" class="btn btn-primary"> Guardar Ubicacion</button>
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

            // Intenta obtener la ubicación actual
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function (position) {
                    var userLocation = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };

                    map.setCenter(userLocation);

                    marker = new google.maps.Marker({
                        map: map,
                        draggable: true,
                        position: userLocation,
                    });

                    google.maps.event.addListener(marker, 'drag', function () {
                        updateLatLng(marker.getPosition());
                    });
                }, function () {
                    handleLocationError(true, map.getCenter());
                });
            } else {
                // Si la geolocalización no está disponible, centra el mapa en una ubicación predeterminada
                handleLocationError(false, map.getCenter());
            }
        }

        function updateLatLng(position) {
            document.getElementById('latitud').value = position.lat();
            document.getElementById('longitud').value = position.lng();
        }

        function handleLocationError(browserHasGeolocation, pos) {
            // Manejar errores de geolocalización
            var infoWindow = new google.maps.InfoWindow();
            infoWindow.setPosition(pos);
            infoWindow.setContent(browserHasGeolocation ?
                'Error: La geolocalización ha fallado.' :
                'Error: Tu navegador no soporta la geolocalización.');
            infoWindow.open(map);
        }
    </script>
@endsection
