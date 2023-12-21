@extends('layouts.panel')

@section('content')


    <div class="row">
      <div class="col-12">
          <div class="card my-1">
              <div class="card-header p-0 position-relative mt-n4 mx-2 z-index-2">
                  <div class="bg-gradient-info shadow-info border-radius-lg pt-4 pb-3">
                      <h6 class="text-white text-capitalize ps-3">LISTA DE ventas</h6>
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
                  <div class="card-body d-flex justify-content-end pt-0 bt-0 mt-0">
                    <a href="{{ url('/ventas/create') }}" class="btn btn-icon btn-3 btn-success" role="button" aria-pressed="true">
                        <span class="btn-inner--icon"><i class="material-icons">person_add</i></span>
                        <span class="btn-inner--text">Agregar Nuevo</span>
                    </a>
                  </div>
                  <div class="table-responsive p-0">
                      <table class="table align-items-center mb-0">
                          <thead>
                              <tr>
                                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">FECHA
                                  </th>
                                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                      CLIENTE</th>
                                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                      TIPO PAGO</th>
                                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                      DESCUENTO</th>
                                  <th class="text-uppercase  text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                      ESTADO</th>
                                  <th class="text-uppercase  text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                      TOTAL</th>
                                  <th class="text-uppercase  text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                      TRANSACCION</th>

                                  <th class="text-secondary opacity-7">OPCIONES</th>
                              </tr>
                          </thead>
                          <tbody>
                              @foreach ($ventas as $venta)
                                  <tr>
                                      <td>
                                          <div class="d-flex px-2 py-1">
                                              {{-- <div>
                          <img src="{{asset('img/team-2.jpg')}}" class="avatar avatar-sm me-3 border-radius-lg" alt="user1">
                      </div> --}}
                                              <div class="d-flex flex-column justify-content-center">
                                                  <h6 class="mb-0 text-sm">{{ $venta->fecha_venta }}</h6>
                                                  {{-- <p class="text-xs text-secondary mb-0">john@creative-tim.com</p> --}}
                                              </div>
                                          </div>
                                      </td>
                                      <td class="align-middle text-sm">
                                          <p class="text-xs font-weight-bold mb-0 ">{{ $venta->usuario->name }}</p>
                                          {{-- <p class="text-xs text-secondary mb-0">Organization</p> --}}
                                      </td>
                                      <td class="align-middle text-sm">
                                          <span
                                              class="text-xs font-weight-bold mb-0 ">{{ $venta->tipopago->nombre_tipopago }}</span>
                                      </td>
                                      <td class="align-middle text-sm">
                                          <span
                                              class="text-xs font-weight-bold mb-0 ">{{ $venta->promocion->descuento }}</span>
                                      </td>
                                      <td class="align-middle text-sm">
                                          <span
                                              class="text-xs font-weight-bold mb-0 ">{{ $venta->estado_venta }}</span>
                                      </td>
                                      <td class="align-middle text-sm">
                                            <span
                                            class="text-xs font-weight-bold mb-0 ">{{ $venta->total_venta }}</span>
                                      </td>
                                      <td class="align-middle text-sm">
                                            <span
                                            class="text-xs font-weight-bold mb-0 ">{{ $venta->transaccion }}</span>
                                      </td>


                                      <td class="align-middle">
                                        @if ($venta->tipopago_id==1)
                                            @if ($venta->tcParametro)
                                                <a href="{{url('/ventas/'.$venta->id)}}" class="text-primary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                                    <span class="alert-icon align-middle">
                                                        <span class="material-icons text-md">
                                                            visibility
                                                        </span>
                                                    </span>
                                                    Ver Qr

                                                </a>
                                            @else
                                                @if ($venta->estado_venta=="pagado")
                                                    <a href="#" class="text-success font-weight-bold text-xs">
                                                        <span class="alert-icon align-middle">
                                                            <span class="material-icons text-md">
                                                                attach_money
                                                            </span>
                                                        </span>
                                                        Pagado
                                                    </a>
                                                @else

                                                @endif
                                                <a href="{{url('/ventas/'.$venta->id)}}" class="text-primary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                                    <span class="alert-icon align-middle">
                                                        <span class="material-icons text-md">
                                                            attach_money
                                                        </span>
                                                    </span>
                                                    Pagar
                                                </a>
                                            @endif

                                        @else
                                            <a href="{{url('/ventas/'.$venta->id)}}" class="text-primary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                                <span class="alert-icon align-middle">
                                                    <span class="material-icons text-md">
                                                        attach_money
                                                    </span>
                                                </span>
                                                Pagar
                                            </a>
                                        @endif

                                        <a href="{{url('/ventas/'.$venta->id.'/edit')}}" class="text-warning font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                          <span class="alert-icon align-middle">
                                            <span class="material-icons text-md">
                                                visibility
                                            </span>
                                          </span>
                                          Ver
                                        </a>
                                        {{-- <form action="{{URL('/ventas/'.$venta->id)}}" method="POST">
                                          @csrf
                                          @method('DELETE')

                                        </form> --}}
                                        {{-- <a href="#" class="text-danger font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user" onclick="event.preventDefault(); document.getElementById('eliminarRegistroForm').submit();">
                                          <span class="alert-icon align-middle">
                                            <span class="material-icons text-md">
                                              delete
                                            </span>
                                          </span>
                                          Eliminar
                                        </a>
                                          <!-- Formulario oculto para enviar la solicitud DELETE -->
                                        <form action="{{ URL('/ventas/'.$venta->id) }}" method="POST" id="eliminarRegistroForm" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form> --}}

                                      </td>
                                  </tr>
                              @endforeach
                          </tbody>
                      </table>
                  </div>
              </div>
            <!-- Contador de visitas para Vista 1 -->
            <div class="card-body">
                <button id="visit-counter-btn" class="btn btn-success btn-sm">
                    Vista 1 Visitas: <span id="visit-count-view1">0</span>
                </button>
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    // Definir un identificador único para la Vista 1
                    const view1Id = 'view1';

                    // Recuperar el valor actual del contador de visitas para la Vista 1
                    let visitCountView1 = localStorage.getItem(view1Id) || 0;

                    // Incrementar el contador de visitas para la Vista 1
                    visitCountView1++;

                    // Mostrar el contador en el elemento con id "visit-count-view1"
                    document.getElementById('visit-count-view1').textContent = visitCountView1;

                    // Almacenar el nuevo valor del contador para la Vista 1 en localStorage
                    localStorage.setItem(view1Id, visitCountView1.toString());
                });
            </script>
          </div>
      </div>
  </div>


@endsection


@section('scripts')
    <script>
        // Captura el evento clic en el enlace
        document.getElementById('enlacePagar').addEventListener('click', function (e) {
            // Previene el comportamiento predeterminado del enlace (evita la recarga de la página)
            e.preventDefault();

            // Muestra el formulario oculto
            document.getElementById('FormPagoFacil').style.display = 'block';

            // Simula un clic en el botón de pago
            document.getElementById('btnpagar').click();
        });
    </script>
    <script>
        // Función para llamar a la ruta cada 5 segundos y 4 veces
        function llamarRuta() {
            // Realizar la solicitud a la ruta
            fetch('/ventas')
                .then(response => response.json())
                .then(data => {
                    console.log('Respuesta de la ruta:', data);
                })
                .catch(error => console.error('Error al llamar a la ruta:', error));
        }

        // Llamar a la función cada 5 segundos y repetir 4 veces
        let contador = 0;
        const intervalId = setInterval(function () {
            if (contador < 4) {
                llamarRuta();
                contador++;
            } else {
                clearInterval(intervalId); // Detener el intervalo después de 4 llamadas
                console.log('Llamadas completadas');
            }
        }, 5000);
    </script>

@endsection
