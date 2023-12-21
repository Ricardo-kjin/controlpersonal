@extends('layouts.panel')

@section('content')
<div class="row">
  <div class="col-12">
      <div class="card my-4">
          <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-info shadow-info border-radius-lg pt-4 pb-3">
                  <h6 class="text-white text-capitalize ps-3">Imagen para el perfil</h6>
              </div>
          </div>
          <div class="card-body">
                @if (session('success'))
                  <div class="alert alert-success alert-dismissible text-white fade show" role="alert">
                      <span class="alert-icon align-middle">
                        <span class="material-icons text-md">
                        thumb_up_off_alt
                        </span>
                      </span>
                      <span class="alert-text">¡ {{session('success')}} !</span>
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                @endif
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

              <!-- En tu vista show.blade.php -->
                      @if ($imagen)
                          <div class="form-control">
                            @if (auth()->user()->role=="vendedor")

                            <div class="card-body d-flex justify-content-end pt-0 bt-0 mt-0">
                                <a href="{{ url('/captura/'.$clienteId) }}" class="btn btn-icon btn-3 btn-success" role="button" aria-pressed="true">
                                    <span class="btn-inner--icon"><i class="material-icons">queue</i></span>
                                    <span class="btn-inner--text">Validar Visita al cliente: {{$clienteId}}</span>
                                </a>
                                {{-- <a href="{{ url('/captura') }}" class="btn btn-icon btn-3 btn-danger" role="button" aria-pressed="true">
                                    <span class="btn-inner--icon"><i class="material-icons">queue</i></span>
                                    <span class="btn-inner--text">Cerrar Cerradura</span>
                                </a> --}}
                            </div>
                            @endif

                              <!-- Otros detalles de la imagen -->
                              <img src="{{ asset( '/storage/imagenes/'.$imagen->url_imagen) }}" alt="Imagen">
                          </div>
                      @else
                          <div class="form-control">
                            <p>NO SUBIO UNA IMAGEN A SU PERFIL</p>
                            @if (auth()->user()->role=="cliente")
                                <form method="POST" action="{{ url('/imagenes') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-control">
                                        <div class="input-group input-group-static mb-4">
                                            <label for="nombre">ELEGIR IMAGEN: </label>
                                            <br>
                                            <input type="file" name="url_imagen" accept="image/*">
                                        </div>
                                    </div>
                                    <div>
                                        <button type="submit" class="btn bg-gradient-primary">Guardar</button>

                                        {{-- <a href="{{ url('/ver_rutas') }}" type="button" class="btn btn-outline-success"
                                            title="Regresar"><i class="material-icons">arrow_back</i> Regresar</a> --}}
                                    </div>
                                </form>

                            @endif
                            @if (auth()->user()->role=="vendedor")
                                <div class="card-body d-flex justify-content-end pt-0 bt-0 mt-0">
                                    <a href="{{ url('/ver_rutas') }}" type="button" class="btn btn-outline-success"
                                    title="Regresar"><i class="material-icons">arrow_back</i> Regresar</a>
                                </div>

                            @endif
                          </div>
                      @endif


          </div>
      </div>
  </div>
</div>
@endsection

