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
                    <h3 class="mb-0">rutas</h3>
                </div>
                @if (auth()->user()->role=='admin')

                <div class="col text-right">
                    <a href="{{url('/rutas/create')}}" class="btn btn-sm btn-primary"> Nueva ruta</a>
                </div>
                @endif
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
                        <th scope="col">Vendedor</th>
                        <th scope="col">estado</th>
                        <th scope="col">tiempo total</th>
                        <th scope="col"># Ubicaciones</th>
                        @if (auth()->user()->role=='admin')
                            <th scope="col">Opciones</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rutas as $ruta)

                    <tr>
                        <th scope="row">
                            {{$ruta->codigo_ruta}}
                        </th>
                        <th scope="row">
                            {{$ruta->user->name}}
                        </th>
                        <th scope="row">
                            {{$ruta->estado_ruta}}
                        </th>
                        <th scope="row">
                            {{$ruta->tiempo_total}}
                        </th>
                        <th scope="row">
                            {{$ruta->ubicacions()->count()}}
                        </th>
                        <td>
                            <form action="{{url('/rutas/'.$ruta->id)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                @if (auth()->user()->role=='admin')
                                    <a href="{{url('/rutas/'.$ruta->id.'/edit')}}" class="btn btn-sm btn-primary">Editar</a>
                                    <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>

                                @endif
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="col">
                <h6 class="mb-0" id="contadorVisitas">Cargando contador...</h6>
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
        </div>
    </div>
@endsection
