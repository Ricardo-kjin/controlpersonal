@extends('layouts.panel')

@section('content')
<style>
    /* Estilos para el contenedor col */
    .col {
        text-align: center; /* Centra el contenido dentro del contenedor */
    }

    /* Estilos para el h5 */
    #contadorVisitas {
        display: inline-block; /* Convierte el h5 en un bloque en línea */
        padding: 10px 20px; /* Ajusta el espaciado interno para que parezca un botón */
        border: 2px solid #00ff00; /* Establece un borde verde */
        margin: 0; /* Elimina el margen predeterminado del h5 */
        color: #006600; /* Verde oscuro para el texto inicial */
        background-color: #b3ffb3; /* Fondo verde claro */
        cursor: pointer; /* Cambia el cursor al pasar el ratón */
        transition: background-color 0.3s; /* Transición suave solo para el fondo */
    }

    /* Cambio de color de fondo al pasar el ratón */
    #contadorVisitas:hover {
        background-color: #80ff80; /* Verde más claro al pasar el ratón */
    }
</style>
    <div class="card shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">vendedores</h3>
                </div>

                <div class="col text-right" hidden>
                    <a href="{{url('/vendedores/create')}}" class="btn btn-sm btn-primary">Nuevo vendedor</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            @if (session('notification'))
            <div class="alert alert-success" role="alert">
                 {{session('notification')}}
            </div>
            @endif
        </div>
        <div class="table-responsive">
            <!-- Projects table -->
            <table class="table align-items-center table-flush">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Url Ubicacion</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($vendedors as $vendedor)

                    <tr>
                        <th scope="row">
                            {{$vendedor->name}}
                        </th>

                        <td>
                            <a href="{{ url('/vermaps/' . $vendedor->id) }}">
                                {{ $vendedor->ubicacions->first()->url_map }}
                            </a>
                            {{-- @if ($vendedor->ubicacion)
                                Ubicacion Registrada <br> <a href="{{url('/ubicaciones/vendedores/'.$vendedor->id.'/edit')}}">Editar</a>
                            @else
                                <a title="Añadir una Ubicación" href="{{url('/ubicaciones/vendedores/'.$vendedor->id)}}">Registrar Ubicacion</a>
                            @endif --}}
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="col">
                <h6 class="mb-0" id="contadorVisitas">Cargando contador...</h6>
            </div>
            {{-- <div class="col">
                <h6 class="mb-0" id="contadorVisitas">Cargando contador...</h6>
            </div> --}}
        </div>
        <div class="card-body">
            {{$vendedors->links()}}
        </div>
    </div>
    <script>
        // Obtener la clave única para la página actual
        var paginaClave = 'pagina_visitas_{{ request()->path() }}';

        // Obtener el contador de visitas actual almacenado en localStorage
        var contadorVisitas = localStorage.getItem(paginaClave);

        // Incrementar el contador de visitas o inicializarlo si no existe
        contadorVisitas = contadorVisitas ? parseInt(contadorVisitas) + 1 : 1;

        // Actualizar el contador de visitas en localStorage
        localStorage.setItem(paginaClave, contadorVisitas);

        // Mostrar el contador de visitas en la etiqueta con id "contadorVisitas"
        document.getElementById('contadorVisitas').innerText = 'Visita # ' + contadorVisitas + '.';
    </script>
@endsection

