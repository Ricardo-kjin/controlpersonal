{{-- MENU DEL DASHBOARD --}}
<h6 class="navbar-heading text-muted">
    @if (auth()->user()->role == 'admin')
        Gestión de Usuario
    @else
        Menú
    @endif

</h6>
<ul class="navbar-nav">
    {{-- <li class="nav-item active">
        <a class="nav-link active" href="#">
            <i class="ni ni-tv-2 text-danger"></i> Gestion de Usuario
        </a>
    </li> --}}
    @if (auth()->user()->role=='admin' || auth()->user()->role=='vendedor' )
        <li class="nav-item">
            <a class="nav-link " href="{{ url('/vendedores') }}">
                <i class="fas fa-user-tie text-warning"></i> Vendedores
            </a>
        </li>
    @endif
    @if (auth()->user()->role=='admin')
        <li class="nav-item">
            <a class="nav-link " href="{{ url('/monitores') }}">
                <i class="fas fa-user-cog text-danger"></i> Encargado Monitoreo
            </a>
        </li>
    @endif
    @if (auth()->user()->role=='admin' || auth()->user()->role=='cliente' )
        <li class="nav-item">
            <a class="nav-link " href="{{ url('/clientes') }}">
                <i class="fas fa-user text-success"></i> Cliente
            </a>
        </li>
    @endif
    <li class="nav-item">
        <a class="nav-link" href="{{ route('logout') }}"
            onclick="event.preventDefault(); document.getElementById('form-logout').submit();">
            <i class="fas fa-sign-in-alt"></i> Cerrar Sesión
        </a>
        <form action="{{ route('logout') }}" method="POST" style="display: none" id="form-logout">
            @csrf
        </form>
    </li>
</ul>
@if (auth()->user()->role=='admin' )

    <!-- Divider -->
    <hr class="my-1">
    <!-- Heading -->
    <h6 class="navbar-heading text-muted">GESTION DE PRODUCTO</h6>
    <!-- Navigation -->
    <ul class="navbar-nav mb-md-3" >
        <li class="nav-item">
            <a class="nav-link" href="{{url('/familias')}}">
                <i class="ni ni-bullet-list-67 text-primary"></i>Familia
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{url('/grupos')}}">
                <i class="ni ni-building text-info" ></i> Grupo
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{url('/subgrupos')}}">
                <i class="ni ni-basket text-blue"></i> Subgrupo
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{url('/productos')}}">
                <i class="fas fa-car-battery"></i>Producto
            </a>
        </li>
    </ul>
@endif
@if (auth()->user()->role=='admin' || auth()->user()->role=='vendedor' )

    <hr class="my-1">
    <!-- Heading -->
    <h6 class="navbar-heading text-muted">GESTION DE RUTA</h6>
    <!-- Navigation -->
    <ul class="navbar-nav mb-md-3" >
        <li class="nav-item">
            <a class="nav-link" href="{{url('/rutas')}}">
                <i class="fas fa-route text-primary"></i>RUTAS
            </a>
        </li>
        @if (auth()->user()->role=='admin')
            <li class="nav-item">
                <a class="nav-link" href="/vermaps">
                    <i class="fas fa-clock text-danger"></i> MONITOREO DE VENDEDOR
                </a>
            </li>
        @endif
</ul>
@endif
@if (auth()->user()->role=='admin' )
    <hr class="my-1">
    <!-- Heading -->
    <h6 class="navbar-heading text-muted">REPORTES</h6>
    <!-- Navigation -->
    <ul class="navbar-nav mb-md-3" >
        <li class="nav-item">
            <a class="nav-link" href="{{url('/reportesprom')}}">
                <i class="fas fa-route text-primary"></i>Vendedores Promedio de visita
            </a>
        </li>

    </ul>

@endif



{{-- PARA EJEMPLO Y INFORMACION DE LA PAGINA DE PLANTILLA --}}
<h6 class="navbar-heading text-muted" style="display: none">GESTION DE PRODUCTO</h6>
<!-- Navigation -->
<ul class="navbar-nav mb-md-3" style="display: none">
    <li class="nav-item">
        <a class="nav-link" href="https://demos.creative-tim.com/argon-dashboard/docs/getting-started/overview.html">
            <i class="ni ni-spaceship"></i> Getting started
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="https://demos.creative-tim.com/argon-dashboard/docs/foundation/colors.html">
            <i class="ni ni-palette"></i> Foundation
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="https://demos.creative-tim.com/argon-dashboard/docs/components/alerts.html">
            <i class="ni ni-ui-04"></i> Components
        </a>
    </li>
</ul>
