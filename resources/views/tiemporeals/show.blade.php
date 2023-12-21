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
                        <h3 class="mb-0">Monitorear ubicación en tiempo real para el {{$ubicacion->user()->first()->role}} {{$ubicacion->user()->first()->name}}</h3>
                    @else
                    <h3 class="mb-0">Ubicación en tiempo real del {{$ubicacion->user()->first()->role}}: {{$ubicacion->user()->first()->name}}</h3>
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
            <form>
                <!-- Mantén los campos de latitud, longitud y URL en solo lectura -->
                <div class="form-group">
                    <label for="latitud">Latitud</label>
                    <input type="text" name="latitud" class="form-control" value="{{ $ubicacion->latitud }}" id="latitud" readonly>
                </div>
                <div class="form-group">
                    <label for="longitud">Longitud</label>
                    <input type="text" name="longitud" class="form-control" id="longitud" value="{{ $ubicacion->longitud }}" readonly>
                </div>
                <div class="form-group">
                    <label for="url_map">Url de la Ubicación</label>
                    <input type="text" name="url_map" class="form-control" id="url_map" value="{{ $ubicacion->url_map }}" readonly>
                </div>
                <div class="form-group">
                    <label for="">Mapa en Tiempo Real</label>
                    <div id="map-canvas"></div>
                </div>
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

            // Obtén las coordenadas existentes desde los campos de entrada
            var latitud = parseFloat(document.getElementById('latitud').value) || 0;
            var longitud = parseFloat(document.getElementById('longitud').value) || 0;

            // Establece el mapa en la ubicación existente
            var userLocation = {
                lat: latitud,
                lng: longitud
            };

            map.setCenter(userLocation);

            // Coloca un marcador en la ubicación existente
            marker = new google.maps.Marker({
                map: map,
                position: userLocation,
            });

            // Actualiza el marcador en tiempo real
            setInterval(updateMarker, 5000); // Actualiza cada 5 segundos (ajusta según tus necesidades)
        }

        function updateMarker() {
            // Puedes realizar una petición AJAX para obtener las coordenadas en tiempo real del servidor
            // y luego actualizar el marcador y el mapa
            // Por simplicidad, aquí solo se simula una actualización con un desplazamiento aleatorio
            var randomOffset = 0.0005; // Desplazamiento aleatorio
            var newLat = marker.getPosition().lat() + (Math.random() * 2 - 1) * randomOffset;
            var newLng = marker.getPosition().lng() + (Math.random() * 2 - 1) * randomOffset;

            var newLocation = new google.maps.LatLng(newLat, newLng);
            marker.setPosition(newLocation);
            map.setCenter(newLocation);

            // También puedes actualizar los campos de latitud y longitud si es necesario
            updateLatLng(newLocation);
        }

        function updateLatLng(position) {
            document.getElementById('latitud').value = position.lat();
            document.getElementById('longitud').value = position.lng();
        }
    </script>
@endsection
