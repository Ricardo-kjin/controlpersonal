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
          <h6 class="text-white text-capitalize ps-3">Nuevo Vendedor</h6>
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
          <form method="POST" action="{{ url('/vendedores') }}">
              @csrf
              <div class="form-control">
                  <div class="input-group input-group-dynamic mb-4">
                      <label for="name" class="form-label">NOMBRE ASESOR</label>
                      <input type="text" name="name" class="form-control" value="{{ old('name') }}" id="name" required>
                  </div>
              </div>
              <div class="form-control">
                  <div class="input-group input-group-dynamic mb-4">
                      <label for="email" class="form-label">CORREO ELECTRONICO</label>
                      <input type="text" name="email" class="form-control" id="email" value="{{ old('email') }}" required>
                    </div>
              </div>
              <div class="form-control">
                  <div class="input-group input-group-dynamic mb-4">
                      <label for="cedula" class="form-label">CEDULA</label>
                      <input type="text" name="cedula" class="form-control" id="cedula" value="{{ old('cedula') }}" >
                  </div>
              </div>
              <div class="form-control">
                  <div class="input-group input-group-dynamic mb-4">
                      <label for="address" class="form-label">DIRECCION</label>
                      <input type="text" name="address" class="form-control" id="address" value="{{ old('address') }}" >
                  </div>
              </div>
              <div class="form-control">
                  <div class="input-group input-group-dynamic mb-4">
                      <label for="phone" class="form-label">TELEFONO</label>
                      <input type="text" name="phone" class="form-control" id="phone" value="{{ old('phone') }}" >
                  </div>
              </div>

                  <div class="input-group input-group-static mb-4">
                      <label for="password" >CONTRASEÑA</label>
                      <input type="text" name="password" class="form-control" id="password"
                      value="{{ old('password', Str::random(8)) }}" readonly >
                  </div>
              <div>
                <button type="submit" class="btn bg-gradient-primary">Guardar</button>
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
                    <h3 class="mb-0">Nuevo vendedor</h3>
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
            <form action="{{ url('/vendedores') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Nombre del vendedor</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" id="name"
                        required>
                </div>
                <div class="form-group">
                    <label for="email">Correo Electronico</label>
                    <input type="text" name="email" class="form-control" id="email" value="{{ old('email') }}">
                </div>
                <div class="form-group">
                    <label for="cedula">Cedula</label>
                    <input type="text" name="cedula" class="form-control" id="cedula" value="{{ old('cedula') }}">
                </div>
                <div class="form-group">
                    <label for="address">Direccion</label>
                    <input type="text" name="address" class="form-control" id="address" value="{{ old('address') }}">
                </div>
                <div class="form-group">
                    <label for="phone">Telefono</label>
                    <input type="text" name="phone" class="form-control" id="phone" value="{{ old('phone') }}">
                </div>
                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input type="text" name="password" class="form-control" id="password"
                        value="{{ old('password', Str::random(8)) }}" readonly>
                </div>
                <div class="form-group" hidden>
                    <label for="role">Rol</label>
                    <input type="text" name="role" class="form-control" id="role" value="vendedor">
                </div>
                <button type="submit" class="btn btn-primary"> Crear vendedor</button>
            </form>
        </div>
    </div>
@endsection
