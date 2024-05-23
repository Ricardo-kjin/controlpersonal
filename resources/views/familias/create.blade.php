@extends('layouts.panel')

@section('content')
<div class="row">
  <div class="col-12">
      <div class="card my-4">
          <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-info shadow-info border-radius-lg pt-4 pb-3">
                  <h6 class="text-white text-capitalize ps-3">NUEVO CATALOGO</h6>
              </div>
          </div>
          <div class="card-body">
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
              <form method="POST" action="{{ url('/catalogos') }}">
                  @csrf
                  <div class="form-control">
                      <div class="input-group input-group-dynamic mb-4">
                          <label for="nombre" class="form-label">NOMBRE </label>
                          <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}"
                              id="nombre" required>
                      </div>
                  </div>
                  <div>
                      <button type="submit" class="btn bg-gradient-primary">Guardar</button>
                      <a href="{{ url('/catalogos') }}" type="button" class="btn btn-outline-success"
                          title="Regresar"><i class="material-icons">arrow_back</i> Regresar</a>
                  </div>
              </form>
          </div>
      </div>
  </div>
</div>
    <div class="card shadow" hidden>
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Nueva Familia</h3>
                </div>
                <div class="col text-right">
                    <a href="{{ url('/catalogos') }}" class="btn btn-sm btn-success">
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
            <form action="{{ url('/catalogos') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="nombre">Nombre del Catalogo</label>
                    <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}" id="nombre"
                        required>
                </div>

                <button type="submit" class="btn btn-primary"> Crear Familia</button>
            </form>
        </div>
    </div>
@endsection

