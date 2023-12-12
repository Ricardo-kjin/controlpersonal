<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
        <title>Pizarra Colaborativa</title>
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v5.15.3/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="{{asset('css/styles.css')}}" rel="stylesheet" />
    </head>
    <body>
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light" id="mainNav">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="index.html">OnLineEdu</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto py-4 py-lg-0">
                        @if (Route::has('login'))
                        @auth
                            <li class="nav-item">
                                <a href="{{ url('/home') }}" class="nav-link px-lg-3 py-3 py-lg-4">Home</a>
                            </li>
                        @else
                            {{-- @include('menuRegistros') --}}
                            <li class="nav-item">
                                <a href="{{ route('login') }}" class="nav-link px-lg-3 py-3 py-lg-4">Log in</a>
                            </li>
                            @if (Route::has('register'))
                                {{-- <li class="nav-item">
                                    <a href="{{ route('register') }}" class="nav-link px-lg-3 py-3 py-lg-4">Register</a>
                                </li> --}}
                                {{-- <ul class="navbar-nav align-items-center d-none d-md-flex">
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-menu-arrow "
                                            href="#" role="button" data-bs-toggle="dropdown" aria-expanded="true" id="navbarDropdown">
                                            <i class="ni ni-circle-08"></i>
                                            Registrate
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-arrow" aria-labelledby="navbarDropdown" data-bs-popper="static">
                                            <li>
                                                <a href="{{url('/propietarios/create')}}" class="dropdown-item">
                                                    <span>Propietario</span>
                                                </a>
                                            </li>
                                            <a href="{{url('/arrendatarios/create')}}" class="dropdown-item">
                                                <span>Arrendatario</span>
                                            </a>
                                            <a href="{{url('/clientes/create')}}" class="dropdown-item">
                                                <span>Cliente</span>
                                            </a>
                                        </ul>
                                    </li>
                                </ul> --}}
                            @endif
                        @endauth
                    @endif
                        {{-- <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="index.html">Login</a></li>
                        <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="about.html">Register</a></li> --}}
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Page Header-->
        <header class="masthead" style="background-image: url('{{asset('img/home-bc.png')}}')">
        {{-- <header class="masthead" style="background-image: url('https://i.etsystatic.com/22567541/r/il/fbbef1/4277198693/il_fullxfull.4277198693_8467.jpg')"> --}}
            <div class="container position-relative px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <div class="site-heading">
                            <h1>Control del Personal</h1>
                            <span class="subheading">Seguimiento del personal de Ventas</span>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Main Content-->
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <!-- Post preview-->
                    <div class="post-preview">
                        <a href="post.html">
                            <h2 class="post-title text-right">Seguimiento y control al personal de ventas!</h2>
                            <h3 class="post-subtitle text-right">Registro de Tu catalogo de productos.</h3>
                        </a>
                    </div>
                    <!-- Divider-->
                    <hr class="my-4" />
                </div>
            </div>
        </div>
        <!-- Footer-->
        <!-- Modal -->
        <div class="modal fade" id="terminosModal" tabindex="-1" aria-labelledby="terminosModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="terminosModalLabel">Términos y Condiciones de uso:</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>
                            Bienvenido a DevTop. Al utilizar nuestros servicios, aceptas los siguientes términos y condiciones.
                        </p>
                        <p>
                            1. Aceptas ser totalmente responsable de tu propio contenido.
                        </p>
                        <p>
                            2. Aseguras que toda la información proporcionada es precisa.
                        </p>
                        <p>
                            3. Aceptas no utilizar nuestros servicios para fines ilegales o no autorizados.
                        </p>
                        <!-- Agrega más términos y condiciones según sea necesario -->

                        <!-- Checkbox para aceptar los términos y condiciones -->
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="aceptoTerminos">
                            <label class="form-check-label" for="aceptoTerminos">
                                Acepto los términos y condiciones
                            </label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="btnAceptar" disabled>Aceptar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="{{asset('js/scripts.js')}}"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var myModal = new bootstrap.Modal(document.getElementById('terminosModal'), {
                    backdrop: 'static', // Evita el cierre haciendo clic fuera del modal
                    keyboard: false      // Evita el cierre al presionar la tecla Escape
                });

                // Habilita el botón de Aceptar cuando el checkbox está marcado
                document.getElementById('aceptoTerminos').addEventListener('change', function() {
                    document.getElementById('btnAceptar').disabled = !this.checked;
                });

                // Cierra el modal y realiza acciones adicionales al hacer clic en "Aceptar"
                document.getElementById('btnAceptar').addEventListener('click', function() {
                    myModal.hide(); // Cierra el modal
                    // Puedes agregar aquí cualquier acción adicional después de aceptar los términos
                });

                // Muestra el modal al cargar la página
                myModal.show();
            });
        </script>
    </body>
</html>
