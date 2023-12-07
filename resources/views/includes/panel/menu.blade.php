<ul class="navbar-nav">

    {{-- Gestion personal --}}
    <li class="nav-item">
        <a class="nav-link text-white" data-bs-toggle="collapse" href="#gruposMenu" role="button" aria-expanded="false">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="material-icons">people</i>
            </div>
            {{-- <span class="nav-link-text ms-1">Gestion del Personal</span> --}}
            <h6 class="text-uppercase text-xs text-white font-weight-bolder opacity-8">Control del Personal</h6>
        </a>
        <div class="collapse" id="gruposMenu">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ url('/vendedores') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            {{-- <i class="material-icons opacity-10">person_outline</i> --}}
                            <i class="fas fa-user-tie"></i>
                        </div>
                        <span class="nav-link-text ms-1">Vendedores</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ url('/vendedores') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            {{-- <i class="material-icons opacity-10">group_work</i> --}}
                            <i class="fas fa-user-cog"></i>
                        </div>
                        <span class="nav-link-text ms-1">Supervisores</span>
                    </a>
                </li>
            </ul>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link text-white" data-bs-toggle="collapse" href="#gestionclientes" role="button"
            aria-expanded="false">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                {{-- <i class="material-icons opacity-10">person</i> --}}
                <i class="fas fa-user"></i>
            </div>
            {{-- <span class="nav-link-text ms-1">Gestion del Personal</span> --}}
            <h6 class="text-uppercase text-xs text-white font-weight-bolder opacity-8">Control de Clientes</h6>
        </a>
        <div class="collapse" id="gestionclientes">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ url('/clientes') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            {{-- <i class="material-icons opacity-10">person_outline</i> --}}
                            <i class="fas fa-user-md"></i>
                        </div>
                        <span class="nav-link-text ms-1">Clientes</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ url('/clientes/create') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            {{-- <i class="material-icons opacity-10">group_work</i> --}}
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <span class="nav-link-text ms-1">Agregar</span>
                    </a>
                </li>
            </ul>
        </div>
    </li>
    {{-- Gestion de Productos --}}
    <li class="nav-item">
        <a class="nav-link text-white" data-bs-toggle="collapse" href="#gestionproductos" role="button"
            aria-expanded="false">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                {{-- <i class="material-icons opacity-10">person</i> --}}
                <i class="fas fa-shopping-bag"></i>
            </div>
            {{-- <span class="nav-link-text ms-1">Gestion del Personal</span> --}}
            <h6 class="text-uppercase text-xs text-white font-weight-bolder opacity-8">Gestion de Productos</h6>
        </a>
        <div class="collapse" id="gestionproductos">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ url('/familias') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            {{-- <i class="material-icons opacity-10">person_outline</i> --}}
                            <i class="fas fa-cube"></i> <i class="fas fa-users"></i>
                        </div>
                        <span class="nav-link-text ms-1">Familia</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ url('/grupos') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            {{-- <i class="material-icons opacity-10">group_work</i> --}}
                            <i class="fas fa-cube"></i> <i class="fas fa-circle"></i>
                        </div>
                        <span class="nav-link-text ms-1">Grupo</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ url('/subgrupos') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            {{-- <i class="material-icons opacity-10">group_work</i> --}}
                            <i class="fas fa-cube"></i> <i class="fas fa-circle-notch"></i>
                        </div>
                        <span class="nav-link-text ms-1">Sub Grupo</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ url('/productos') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            {{-- <i class="material-icons opacity-10">group_work</i> --}}
                            <i class="fas fa-battery-full">-</i><i class="fas fa-cogs"></i>
                        </div>
                        <span class="nav-link-text ms-1">Productos</span>
                    </a>
                </li>
            </ul>
        </div>
    </li>
    {{-- Gestioon de ruta --}}
    <li class="nav-item">
        <a class="nav-link text-white" data-bs-toggle="collapse" href="#gestionrutas" role="button"
            aria-expanded="false">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                {{-- <i class="material-icons opacity-10">map</i> --}}
                <i class="fas fa-map"></i>
            </div>
            {{-- <span class="nav-link-text ms-1">Gestion del Personal</span> --}}
            <h6 class="text-uppercase text-xs text-white font-weight-bolder opacity-8">Gestion de Rutas</h6>
        </a>
        <div class="collapse" id="gestionrutas">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ url('/rutas') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            {{-- <i class="material-icons opacity-10">person_outline</i> --}}
                            <i class="fas fa-route"></i>
                        </div>
                        <span class="nav-link-text ms-1">Rutas</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ url('/vermaps') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            {{-- <i class="material-icons opacity-10">group_work</i> --}}
                            <i class="fas fa-map-marked-alt"></i>
                        </div>
                        <span class="nav-link-text ms-1">Monitoreo</span>
                    </a>
                </li>
            </ul>
        </div>
    </li>

    {{-- Gestioon de Reportes --}}
    <li class="nav-item">
        <a class="nav-link text-white" data-bs-toggle="collapse" href="#reportes" role="button"
            aria-expanded="false">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                {{-- <i class="material-icons">insert_chart</i> --}}
                <i class="fas fa-chart-bar"></i>
            </div>
            {{-- <span class="nav-link-text ms-1">Gestion del Personal</span> --}}
            <h6 class="text-uppercase text-xs text-white font-weight-bolder opacity-8">Reportes</h6>
        </a>
        <div class="collapse" id="reportes">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ url('/reportesprom') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            {{-- <i class="material-icons opacity-10">person_outline</i> --}}
                            <i class="material-icons opacity-10">multiline_chart</i>
                            {{-- <i class="fas fa-file-alt"></i> --}}
                        </div>
                        <span class="nav-link-text ms-1">Promedio de visita</span>
                    </a>
                </li>
            </ul>
        </div>
    </li>

    {{-- Gestioon de Reportes --}}
    <li class="nav-item">
        <a class="nav-link text-white" data-bs-toggle="collapse" href="#cuentas" role="button"
            aria-expanded="false">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                {{-- <i class="material-icons opacity-10">person</i> --}}
                <i class="fas fa-cogs"></i>
            </div>
            {{-- <span class="nav-link-text ms-1">Gestion del Personal</span> --}}
            <h6 class="text-uppercase text-xs text-white font-weight-bolder opacity-8">Gestionar Cuentas</h6>
        </a>
        <div class="collapse" id="cuentas">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link text-white" href="#">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            {{-- <i class="material-icons opacity-10">person_outline</i> --}}
                            <i class="fas fa-credit-card"></i>
                        </div>
                        <span class="nav-link-text ms-1">Cuentas</span>
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link text-white" href="#">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons">attach_money</i>
                        </div>
                        <span class="nav-link-text ms-1">Transacciones</span>
                    </a>
                </li>
            </ul>
        </div>
    </li>

    {{-- Gestioon de Reportes --}}
    <li class="nav-item">
        <a class="nav-link text-white" data-bs-toggle="collapse" href="#catalogo" role="button"
            aria-expanded="false">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fas fa-book"></i>
            </div>
            {{-- <span class="nav-link-text ms-1">Gestion del Personal</span> --}}
            <h6 class="text-uppercase text-xs text-white font-weight-bolder opacity-8">Catalogo Promocion</h6>
        </a>
        <div class="collapse" id="catalogo">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link text-white" href="#">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            {{-- <i class="material-icons opacity-10">person_outline</i> --}}
                            <i class="material-icons">list</i>
                        </div>
                        <span class="nav-link-text ms-1">Catalogo</span>
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link text-white" href="#">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            {{-- <i class="material-icons opacity-10">person_outline</i> --}}
                            <i class="fas fa-tags"></i>
                        </div>
                        <span class="nav-link-text ms-1">Promociones</span>
                    </a>
                </li>
            </ul>
        </div>
    </li>

    <li class="nav-item mt-3">
        <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Control de Visitas</h6>
    </li>
    <li class="nav-item">
        <a class="nav-link text-white " href="{{url('/imagenes/create/'.auth()->user()->id)}}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="material-icons opacity-10">person</i>
            </div>
            <span class="nav-link-text ms-1">Añadir una imagen al perfil</span>
        </a>
    </li>

    {{-- Perfil --}}
    <li class="nav-item mt-3">
        <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Gestionar Perfil</h6>
    </li>
    <li class="nav-item">
        <a class="nav-link text-white " href="#">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="material-icons opacity-10">person</i>
            </div>
            <span class="nav-link-text ms-1">Perfil</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link text-white " href="{{ route('logout') }}"
            onclick="event.preventDefault(); document.getElementById('formLogout').submit();">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="material-icons opacity-10">exit_to_app</i>
            </div>
            <span class="nav-link-text ms-1">Cerrar sesión</span>
            <form action="{{ route('logout') }}" method="POST" style="display: none;" id="formLogout">
                @csrf
            </form>
        </a>
    </li>
