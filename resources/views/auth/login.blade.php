@extends('layouts.form')

@section('content')
    <div class="container my-auto">
        <div class="row">
            <div class="col-lg-4 col-md-8 col-12 mx-auto">
                <div class="card z-index-0 fadeIn3 fadeInBottom">

                    <div class="card-body">
                        @if ($errors->any())
                            <div class="text-center text-muted mb-2">
                                <h4>Se encontró el siguiente error:</h4>
                            </div>
                            <div class="alert alert-danger text-white mb-3" role="alert">
                                {{ $errors->first() }}
                            </div>
                        @else
                          <div class="card-header text-center">
                              <h4 class="font-weight-bolder">Inicie Sesión</h4>
                              <p class="mb-0">ingrese sus credenciales:</p>
                          </div>
                        @endif
                        <form role="form" method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group">
                                <div class="input-group input-group-alternative my-3">
                                    <input placeholder="Correo Electrónico" type="email" class="form-control" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fas fa-envelope opacity-6 text-dark me-1"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group input-group-alternative mb-3">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text"> <i class="fas fa-lock opacity-6 text-dark me-1"></i></span>
                                    </div>
                                    <input type="password" placeholder="Contraseña" class="form-control" name="password" required autocomplete="current-password">
                                </div>
                            </div>

                            <div class="form-check form-switch d-flex align-items-center mb-3">
                                <input name="remember" class="form-check-input" type="checkbox" id="remember"
                                    {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label mb-0 ms-3" for="remember">Recordar sesión</label>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn bg-gradient-secondary w-100 my-4 mb-2">Iniciar
                                    Sesión</button>
                            </div>
                            <p class="mt-4 text-sm text-center">
                                <a href="{{ route('password.request') }}">Olvidaste tu contraseña?</a>
                                <a href="{{ route('register') }}"
                                    class="text-info text-gradient font-weight-bold">Registrarse</a>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
