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
    <div class="row">
      <div class="col-12">
          <div class="card my-1">
              <div class="card-header p-0 position-relative mt-n4 mx-2 z-index-2">
                  <div class="bg-gradient-info shadow-info border-radius-lg pt-4 pb-3">
                      <h6 class="text-white text-capitalize ps-3">clientes</h6>
                  </div>
              </div>
              <div class="card-body px-0 pb-2">
                  <div class="card-body">
                    @if (session('notification'))
                      <div class="alert alert-success alert-dismissible text-white fade show" role="alert">
                          <span class="alert-icon align-middle">
                            <span class="material-icons text-md">
                            thumb_up_off_alt
                            </span>
                          </span>
                          <span class="alert-text">¡ {{session('notification')}} !</span>
                          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                    @endif
                  </div>
                  @if (auth()->user()->role=="admin")
                    <div class="card-body d-flex justify-content-end pt-0 bt-0 mt-0">
                        <a href="{{ url('/clientes/create') }}" class="btn btn-icon btn-3 btn-success" role="button" aria-pressed="true">
                            <span class="btn-inner--icon"><i class="material-icons">person_add</i></span>
                            <span class="btn-inner--text">Agregar Nuevo</span>
                        </a>
                    </div>
                  @endif
                  <div class="table-responsive p-0">
                      <table class="table align-items-center mb-0">
                          <thead>
                              <tr>
                                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">NOMBRE
                                  </th>
                                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                      CORREO</th>
                                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                      CEDULA</th>
                                  <th class="text-uppercase  text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                      ROL</th>
                                  <th
                                      class="text-uppercase  text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                      UBICACION</th>
                                  <th class="text-secondary opacity-7">OPCIONES</th>
                              </tr>
                          </thead>
                          <tbody>
                              @foreach ($clientes as $cliente)
                                  <tr>
                                      <td>
                                          <div class="d-flex px-2 py-1">
                                              {{-- <div>
                          <img src="{{asset('img/team-2.jpg')}}" class="avatar avatar-sm me-3 border-radius-lg" alt="user1">
                      </div> --}}
                                              <div class="d-flex flex-column justify-content-center">
                                                  <h6 class="mb-0 text-sm">{{ $cliente->name }}</h6>
                                                  {{-- <p class="text-xs text-secondary mb-0">john@creative-tim.com</p> --}}
                                              </div>
                                          </div>
                                      </td>
                                      <td class="align-middle text-sm">
                                          <p class="text-xs font-weight-bold mb-0 ">{{ $cliente->email }}</p>
                                          {{-- <p class="text-xs text-secondary mb-0">Organization</p> --}}
                                      </td>
                                      <td class="align-middle text-sm">
                                          <span
                                              class="text-xs font-weight-bold mb-0 ">{{ $cliente->cedula }}</span>
                                      </td>
                                      <td class="align-middle text-sm">
                                          <span
                                              class="text-xs font-weight-bold mb-0 ">{{ $cliente->role }}</span>
                                      </td>
                                      <td class="align-middle text-sm">
                                          <span class="text-xs font-weight-bold mb-0 ">
                                            @if ($cliente->ubicacions->first())
                                              Ubicacion Registrada <br>
                                              <a href="{{ url('/ubicaciones/' . $cliente->id . '/edit') }}">Editar Ubicacions</a>
                                            @else
                                              <a title="Añadir una Ubicación" href="{{ url('/ubicaciones/' . $cliente->id) }}">Registrar Ubicacion</a>
                                            @endif
                                          </span>
                                      </td>

                                      <td class="align-middle">
                                        <a href="{{url('/clientes/'.$cliente->id.'/edit')}}" class="text-warning font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                          <span class="alert-icon align-middle">
                                            <span class="material-icons text-md">
                                              edit
                                            </span>
                                          </span>
                                          Editar
                                        </a>
                                        {{-- <form action="{{URL('/clientes/'.$cliente->id)}}" method="POST">
                                          @csrf
                                          @method('DELETE')

                                        </form> --}}
                                        @if (auth()->user()->role=="admin")
                                            <a href="#" class="text-danger font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user" onclick="event.preventDefault(); document.getElementById('eliminarRegistroForm').submit();">
                                            <span class="alert-icon align-middle">
                                                <span class="material-icons text-md">
                                                delete
                                                </span>
                                            </span>
                                            Eliminar
                                            </a>
                                            <!-- Formulario oculto para enviar la solicitud DELETE -->
                                            <form action="{{ URL('/clientes/'.$cliente->id) }}" method="POST" id="eliminarRegistroForm" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        @endif

                                      </td>
                                  </tr>
                              @endforeach
                          </tbody>
                      </table>
                  </div>
              </div>
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
  </div>

@endsection


