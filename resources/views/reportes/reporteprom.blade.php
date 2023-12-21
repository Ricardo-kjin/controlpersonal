@extends('layouts.panel')

@section('content')
<style>
    /* Estilos para el contenedor col */
    .col {
        text-align: center; /* Centra el contenido dentro del contenedor */
    }

    /* Estilos para el h5 */
    #contadorVisitas {
        display: inline-block; /* Convierte el h5 en un bloque en línea */
        padding: 10px 20px; /* Ajusta el espaciado interno para que parezca un botón */
        border: 2px solid #00ff00; /* Establece un borde verde */
        margin: 0; /* Elimina el margen predeterminado del h5 */
        color: #006600; /* Verde oscuro para el texto inicial */
        background-color: #b3ffb3; /* Fondo verde claro */
        cursor: pointer; /* Cambia el cursor al pasar el ratón */
        transition: background-color 0.3s; /* Transición suave solo para el fondo */
    }

    /* Cambio de color de fondo al pasar el ratón */
    #contadorVisitas:hover {
        background-color: #80ff80; /* Verde más claro al pasar el ratón */
    }
</style>
    <div class="card shadow">
        <h1>Reporte del Promedio de Días de Visita de Vendedores</h1>
        <table>
            <thead>
                <tr>
                    <th>Vendedor</th>
                    <th>Promedio de Días de Visita</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($vendedores as $vendedor)
                    <tr>
                        <td>{{ $vendedor->name }}</td>
                        <td>{{ $vendedor->promedio_dias_visita }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Código para el gráfico utilizando Chart.js -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <canvas id="graficoPromedioDias"></canvas>

        <script>
            var ctx = document.getElementById('graficoPromedioDias').getContext('2d');
            var nombresVendedores = @json($vendedores->pluck('name'));
            var promediosDias = @json($vendedores->pluck('promedio_dias_visita'));

            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: nombresVendedores,
                    datasets: [{
                        label: 'Promedio de Días de Visita',
                        data: promediosDias,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
        <div class="col">
            <h6 class="mb-0" id="contadorVisitas">Cargando contador...</h6>
        </div>
        <script>
            // Obtener la clave única para la página actual
            var paginaClave = 'pagina_visitas_{{ request()->path() }}';

            // Obtener el contador de visitas actual almacenado en localStorage
            var contadorVisitas = localStorage.getItem(paginaClave);

            // Incrementar el contador de visitas o inicializarlo si no existe
            contadorVisitas = contadorVisitas ? parseInt(contadorVisitas) + 1 : 1;

            // Actualizar el contador de visitas en localStorage
            localStorage.setItem(paginaClave, contadorVisitas);

            // Mostrar el contador de visitas en la etiqueta con id "contadorVisitas"
            document.getElementById('contadorVisitas').innerText = 'Visita # ' + contadorVisitas + '.';
        </script>
    </div>
@endsection
