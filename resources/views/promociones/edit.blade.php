@extends('layouts.panel')

@section('content')
<div class="row">
  <div class="col-12">
      <div class="card my-4">
          <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-info shadow-info border-radius-lg pt-4 pb-3">
                  <h6 class="text-white text-capitalize ps-3">ACTUALIZAR PROMOCION {{$promocion->nombre_promocion}}</h6>
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
              <form action="{{ url('/promociones/'.$promocion->id) }}" method="POST">
                @method('PUT')
                @csrf
                  <div class="form-control">
                      <div class="input-group input-group-static mb-4">
                          <label for="nombre" class="ms-0">NOMBRE </label>
                          <input type="text" name="nombre" class="form-control" value="{{ old('nombre',$promocion->nombre_promocion) }}"
                              id="nombre" required>
                      </div>
                  </div>
                  <div class="form-control">
                      <div class="input-group input-group-static mb-4">
                          <label for="monto" class="ms-0">MONTO MINIMO </label>
                          <input type="text" name="monto" class="form-control" value="{{ old('monto',$promocion->monto) }}"
                              id="monto" required>
                      </div>
                  </div>
                  <div class="form-control">
                      <div class="input-group input-group-static mb-4">
                          <label for="descuento" class="ms-0">DESCUENTO </label>
                          <input type="text" name="descuento" class="form-control" value="{{ old('descuento',$promocion->descuento) }}"
                              id="descuento" required>
                      </div>
                  </div>
                  <div>
                      <button type="submit" class="btn bg-gradient-primary">Guardar</button>
                      <a href="{{ url('/promociones') }}" type="button" class="btn btn-outline-success"
                          title="Regresar"><i class="material-icons">arrow_back</i> Regresar</a>
                  </div>
              </form>
          </div>
      </div>
  </div>
</div>

@endsection

