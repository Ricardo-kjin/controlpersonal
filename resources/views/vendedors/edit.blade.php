<?php
use Illuminate\Support\Str;
?>

@extends('layouts.panel')

@section('content')

<div class="row">
  <div class="col-12">
    <div class="card my-4">
      <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
        <div class="bg-gradient-info shadow-info border-radius-lg pt-4 pb-3">
          <h6 class="text-white text-capitalize ps-3">Actualizar Vendedor: {{$vendedor->name}}</h6>
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
                  <span class="alert-text"><strong>Por favor!!</strong> {{$error}}</span>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              @endforeach
          @else

          @endif
          <form action="{{ url('/vendedores/'.$vendedor->id) }}" method="POST">
            @csrf
            @method('PUT')
              <div class="form-control">
                  <div class="input-group input-group-static mb-4">
                      <label for="name" >NOMBRE ASESOR</label>
                      <input type="text" name="name" class="form-control" value="{{ old('name',$vendedor->name) }}" id="name" required>
                  </div>
              </div>
              <div class="form-control">
                  <div class="input-group input-group-static mb-4">
                      <label for="email" >CORREO ELECTRONICO</label>
                      <input type="text" name="email" class="form-control" id="email" value="{{ old('email',$vendedor->email) }}" required>
                    </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                    <div class="input-group input-group-static mb-4">
                        <label for="cedula" >CEDULA</label>
                        <input type="text" name="cedula" class="form-control" id="cedula" value="{{ old('cedula',$vendedor->cedula) }}" >
                    </div>
                </div>
                <div class="col-md-6">
                  <div class="input-group input-group-static mb-4">
                    <label for="phone" >TELEFONO</label>
                    <input type="text" name="phone" class="form-control" id="phone" value="{{ old('phone',$vendedor->phone) }}" >
                  </div>
                </div>
              </div>
              <div class="form-control">
                  <div class="input-group input-group-static mb-4">
                      <label for="address" >DIRECCION</label>
                      <input type="text" name="address" class="form-control" id="address" value="{{ old('address',$vendedor->address) }}" >
                  </div>
              </div>
                  <div class="input-group input-group-static mb-4">
                      <label for="password" >CONTRASEÑA</label>
                      <input type="text" name="password" class="form-control" id="password">
                      <small class="text-danger">Solo llene el campo si desea cambiar la contraseña</small>
                  </div>
              <div>
                <button type="submit" class="btn bg-gradient-primary">Actualizar</button>
                <a href="{{url('/vendedores')}}" type="button" class="btn btn-outline-success" title="Regresar"><i class="material-icons">arrow_back</i> Regresar</a>
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
                    <h3 class="mb-0">Actualizar vendedor</h3>
                </div>
                <div class="col text-right">
                    <a href="{{ url('/vendedores') }}" class="btn btn-sm btn-success">
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
            <form action="{{ url('/vendedores/'.$vendedor->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Nombre del vendedor</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name',$vendedor->name) }}" id="name"
                        required>
                </div>
                <div class="form-group">
                    <label for="email">Correo Electronico</label>
                    <input type="text" name="email" class="form-control" id="email" value="{{ old('email',$vendedor->email) }}">
                </div>
                <div class="form-group">
                    <label for="cedula">Cedula</label>
                    <input type="text" name="cedula" class="form-control" id="cedula" value="{{ old('cedula',$vendedor->cedula) }}">
                </div>
                <div class="form-group">
                    <label for="address">Direccion</label>
                    <input type="text" name="address" class="form-control" id="address" value="{{ old('address',$vendedor->address) }}">
                </div>
                <div class="form-group">
                    <label for="phone">Telefono</label>
                    <input type="text" name="phone" class="form-control" id="phone" value="{{ old('phone',$vendedor->phone) }}">
                </div>
                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input type="text" name="password" class="form-control" id="password" >
                    <small class="text-warning">Solo llene el campo si desea cambiar la contraseña</small>
                </div>
                <button type="submit" class="btn btn-primary"> Guardar cambios</button>
            </form>
        </div>
    </div>
@endsection
