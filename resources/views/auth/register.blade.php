@extends('layouts.form')

@section('content')
    <div class="container my-auto">
        <div class="row">
            <div class="col-lg-4 col-md-8 col-12 mx-auto">
                <div class="card z-index-0 fadeIn3 fadeInBottom">

                    <div class="card-body">
                        <div class="card card-plain">
                            @if ($errors->any())
                                <div class="text-center text-muted mb-2">
                                    <h4>Se encontró el siguiente error:</h4>
                                </div>
                                <div class="alert alert-danger text-white mb-3" role="alert">
                                    {{ $errors->first() }}
                                </div>
                            @else
                                <div class="card-header text-center">
                                    <h4 class="font-weight-bolder">Regístrate</h4>
                                    <p class="mb-0">Llene los campos correspondientes:</p>
                                </div>
                            @endif

                            <div class="card-body">
                                <form role="form" method="POST" action="{{ route('register') }}">
                                    @csrf
                                    <div class="input-group input-group-outline mb-3">
                                        <input type="text" placeholder="Nombre" class="form-control" name="name"
                                            value="{{ old('name') }}" required autocomplete="name" autofocus>
                                    </div>
                                    <div class="input-group input-group-outline mb-3">
                                        <input type="email" placeholder="Correo Electronico" class="form-control"
                                            name="email" value="{{ old('email') }}" required autocomplete="email">
                                    </div>
                                    <div class="input-group input-group-outline mb-3">
                                        <input type="password" placeholder="Contraseña" class="form-control" name="password"
                                            required autocomplete="new-password">
                                    </div>
                                    <div class="input-group input-group-outline mb-3">
                                        <input type="password" placeholder="Repetir Contraseña" class="form-control"
                                            name="password_confirmation" required autocomplete="new-password">
                                    </div>

                                    <div class="text-center">
                                        <button type="submit"
                                            class="btn btn-lg bg-gradient-info btn-lg w-100 mt-4 mb-0">Registrarse</button>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                <p class="mb-2 text-sm mx-auto">
                                    Tiene una cuenta activa?
                                    <a href="{{ route('login') }}"
                                        class="text-success text-gradient font-weight-bold">Iniciar sesión</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
