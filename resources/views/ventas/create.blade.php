{{-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> --}}

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
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-info shadow-info border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">NUEVA venta</h6>
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
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ url('/ventas') }}">
                        @csrf
                        <div class="form-control">
                            <div class="input-group input-group-static mb-4">
                                <label for="cliente" class="ms-0">CLIENTE </label>
                                <select class="form-control" id="cliente" name="cliente" data-live-search="true" onchange="updateClientInfo()">
                                    @foreach ($clientes as $cliente)
                                        <option value="{{ $cliente->id }}"
                                            data-phone="{{$cliente->phone}}"
                                            data-cedula="{{$cliente->cedula}}"
                                            data-email="{{$cliente->email}}">
                                            {{ $cliente->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-control d-flex">
                            <div class="input-group input-group-static mb-4 me-4">
                                <label for="tipopago" class="ms-0">TIPO DE PAGO </label>
                                <select class="form-control" id="tipopago" name="tipopago">
                                    @foreach ($tipopagos as $tipopago)
                                        <option value="{{ $tipopago->id }}"> {{ $tipopago->nombre_tipopago }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="input-group input-group-static mb-4">
                                <label for="promocion" class="ms-0">PROMOCION </label>
                                <select class="form-control" id="promocion" name="promocion">
                                    @foreach ($promociones as $promocion)
                                        <option value="{{ $promocion->id }}"> {{ $promocion->nombre_promocion }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-control d-flex">
                            <div class="input-group input-group-static mb-4 me-4">
                                <label for="nro_venta">nro_venta:</label>
                                <input type="text" name="nro_venta" class="form-control" value="{{ old('nro_venta') }}" id="nro_venta"
                                    required>
                            </div>
                            <div class="input-group input-group-static mb-4 me-4">
                                <label for="MonedaVenta" class="ms-0">MonedaVenta </label>
                                <select class="form-control" id="MonedaVenta" name="MonedaVenta">
                                        <option value="2">Bs</option>
                                        <option value="1"> $u$</option>
                                </select>
                            </div>
                            <div class="input-group input-group-static mb-4 me-4">
                                <label for="cedula">cedula:</label>
                                <input type="text" name="cedula" class="form-control" value="{{ old('cedula') }}" id="cedula"
                                    required>
                            </div>
                        </div>
                        <div class="form-group d-flex">
                            <div class="input-group input-group-static mb-4 me-4">
                                <label for="email">Email:</label>
                                <input type="text" name="email" class="form-control" value="{{ old('email') }}" id="email"
                                    required>
                            </div>
                            <div class="input-group input-group-static mb-4 me-4">
                                <label for="phone">Celular:</label>
                                <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" id="phone"
                                    required>
                            </div>
                            <div class="input-group input-group-static mb-4 me-4">
                                <label for="monto">Monto:</label>
                                <input type="text" name="monto" class="form-control" value="{{ old('monto') }}" id="monto"
                                    required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="panel panel-primary">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="input-group input-group-static my-3">
                                                <label for="producto" class="ms-0">PRODUCTO</label>
                                                <select name="producto" class="form-control" id="producto"
                                                    data-live-search="true" onchange="updateProductInfo()">
                                                    @foreach ($productos as $producto)
                                                        <option value="{{ $producto->id }}"
                                                            data-precio="{{ $producto->precio }}"
                                                            data-stock="{{ $producto->stock }}">
                                                            {{ $producto->nombre_producto }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="input-group input-group-static my-3">
                                                <label for="cantidad">Cantidad</label>
                                                {{-- <input type="number" name="pcantidad" id="pcantidad" class="form-control" placeholder="Cantidad... "> --}}
                                                <input type="number" name="pcantidad" id="pcantidad" class="form-control" placeholder="Cantidad... ">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="input-group input-group-static my-3">
                                                <label for="stock">Stock</label>
                                                <input type="number" name="stock" id="stock" disabled
                                                    class="form-control" placeholder="Stock... ">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="input-group input-group-static my-3">
                                                <label for="precio">Precio</label>
                                                <input type="number" name="precio" id="precio" disabled
                                                    class="form-control" placeholder="P. Venta... ">
                                            </div>
                                        </div>
                                    </div>


                                    <button type="button" id="bt_add" class="btn bg-gradient-info">Agregar</button>

                                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                                        <table class="table table-striped table-bordered table-condensed table-hover"
                                            id="detalles">
                                            <thead style="background-color:#A9D0F5">
                                                <th>Opciones</th>
                                                <th>Serie</th>
                                                <th>Id Producto</th>
                                                <th>Producto</th>
                                                <th>Cantidad</th>
                                                <th>Precio Venta</th>
                                                <th>Subtotal</th>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                            <tfoot>
                                                <th>Total</th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th>
                                                    <h4 id="total">S/. 0.00</h4><input type="hidden" name="total_venta"
                                                        id="total_venta">
                                                </th>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <input type="hidden" name="detalle_venta" id="detalle_venta">
                        <button type="submit" class="btn bg-gradient-primary">Guardar</button>
                        <a href="{{ url('/ventas') }}" type="button" class="btn btn-outline-success"
                            title="Regresar"><i class="material-icons">arrow_back</i> Regresar</a>

                    </form>

                </div>
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
        </div>
    </div>


@endsection

@section('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var cont = 0;
        var detallesVenta = [];

        window.eliminarFila = function (index) {
            detallesVenta.splice(index, 1);

            // Elimina la fila del DOM
            var fila = document.getElementById('fila' + index);
            var tbody = document.getElementById("detalles").getElementsByTagName('tbody')[0];

            // Asegúrate de que la fila exista antes de intentar eliminarla
            if (fila && tbody) {
                tbody.removeChild(fila);
            }

            // Actualiza el total visualmente
            actualizarTotalVisual(index);

            // Actualiza la serie después de eliminar una fila
            for (var i = index; i < detallesVenta.length; i++) {
                var serieElement = document.getElementById('detalles').rows[i + 1].cells[1]; // 1 es la posición de la columna Serie
                serieElement.textContent = i + 1;
            }

            // Actualiza el total lógico
            actualizarTotal();
        };

        // Asignar el evento click al botón
        document.getElementById("bt_add").addEventListener("click", agregarFila);

        // Definición de la función agregarFila
        function agregarFila() {
            var productoSelect = document.getElementById("producto");
            var producto = productoSelect.options[productoSelect.selectedIndex].text;
            var cantidad = parseFloat(document.getElementById("pcantidad").value);
            var precio = parseFloat(document.getElementById("precio").value);
            var subtotalProducto = cantidad * precio;

            // Obtener la serie y el ID del producto
            var serie = cont + 1;
            var idProducto = productoSelect.value; // Asumiendo que el valor del producto es el Id

            // Validar que se haya seleccionado un producto y se haya ingresado una cantidad válida
            if (producto !== "" && cantidad !== "" && cantidad > 0 && precio !== "") {
                // Crear elementos DOM en lugar de construir una cadena HTML
                var fila = document.createElement('tr');
                fila.id = 'fila' + cont;

                // Celda para el botón de eliminar
                var celdaEliminar = document.createElement('td');
                var botonEliminar = document.createElement('button');
                botonEliminar.type = 'button';
                botonEliminar.className = 'btn btn-warning';
                botonEliminar.textContent = 'X';
                botonEliminar.id = 'eliminarBtn' + cont;
                botonEliminar.addEventListener('click', function () {
                    var index = this.id.replace('eliminarBtn', '');
                    eliminarFila(index);
                });
                celdaEliminar.appendChild(botonEliminar);
                fila.appendChild(celdaEliminar);

                // Celdas para Serie, Id Producto y otros datos
                var celdaSerie = document.createElement('td');
                celdaSerie.textContent = serie;
                fila.appendChild(celdaSerie);

                var celdaIdProducto = document.createElement('td');
                celdaIdProducto.textContent = idProducto;
                fila.appendChild(celdaIdProducto);

                var celdaProducto = document.createElement('td');
                celdaProducto.textContent = producto;
                fila.appendChild(celdaProducto);

                var celdaCantidad = document.createElement('td');
                celdaCantidad.textContent = cantidad;
                fila.appendChild(celdaCantidad);

                var celdaPrecio = document.createElement('td');
                celdaPrecio.textContent = precio;
                fila.appendChild(celdaPrecio);

                var celdaSubtotal = document.createElement('td');
                celdaSubtotal.textContent = subtotalProducto;
                fila.appendChild(celdaSubtotal);

                // Agregar la fila al cuerpo de la tabla
                document.getElementById("detalles").getElementsByTagName('tbody')[0].appendChild(fila);

                // Construir objeto con detalles de la fila
                var detalleFila = {
                    serie: serie,
                    idProducto: idProducto,
                    producto: producto,
                    cantidad: cantidad,
                    precio: precio,
                    subtotal: subtotalProducto
                };

                // Agrega detalleFila al array detallesVenta
                detallesVenta.push(detalleFila);

                // Actualiza la serie visualmente y limpia los campos
                var serieElement = document.getElementById('detalles').rows[cont + 1].cells[1]; // 1 es la posición de la columna Serie
                serieElement.textContent = serie;
                actualizarTotal();
                limpiar();

                cont++;
            } else {
                alert("Error al ingresar el detalle de la venta, revise los datos del producto");
            }
        };

        function actualizarTotal() {
            // Lógica para actualizar el total después de eliminar una fila
            // Obtener todos los subtotales actuales
            var subtotales = detallesVenta.map(function (detalle) {
                return detalle.subtotal;
            });

            // Sumar los subtotales para obtener el nuevo total
            var nuevoTotal = subtotales.reduce((a, b) => a + b, 0);

            // Actualizar el elemento total en la interfaz
            document.getElementById("total").innerHTML = "S/. " + nuevoTotal;

            // Actualizar el campo de total_venta
            document.getElementById("total_venta").value = nuevoTotal;

            // Actualizar el campo detalle_venta
            document.getElementById("detalle_venta").value = JSON.stringify(detallesVenta);
        };

        function limpiar() {
            document.getElementById("pcantidad").value = "";
            document.getElementById("stock").value = "";
            document.getElementById("precio").value = "";
        };

        function actualizarTotalVisual(index) {
            // Obtener el elemento total en la interfaz
            var totalElement = document.getElementById("total");

            // Obtener el nuevo total después de eliminar la fila
            var nuevoTotal = parseFloat(totalElement.textContent.replace("S/. ", ""));

            // Restar el subtotal de la fila eliminada
            var subtotales = detallesVenta.map(function (detalle) {
                return detalle.subtotal;
            });
            var subtotalEliminado = subtotales[index];

            nuevoTotal -= subtotalEliminado;

            // Actualizar el elemento total en la interfaz
            totalElement.innerHTML = "S/. " + nuevoTotal;
        };
    });
</script>



    <script>
        function updateProductInfo() {
            var selectedProduct = document.getElementById('producto');
            var precioInput = document.getElementById('precio');
            var stockInput = document.getElementById('stock');

            // Obtener los atributos de datos del elemento seleccionado
            var precio = selectedProduct.options[selectedProduct.selectedIndex].getAttribute('data-precio');
            var stock = selectedProduct.options[selectedProduct.selectedIndex].getAttribute('data-stock');

            // Actualizar los campos de precio y stock
            precioInput.value = precio;
            stockInput.value = stock;
        }
        function updateClientInfo() {
            var selectedClient = document.getElementById('cliente');
            var emailInput = document.getElementById('email');
            var phoneInput = document.getElementById('phone');
            var cedulaInput = document.getElementById('cedula');

            // Obtener los atributos de datos del elemento seleccionado
            var email = selectedClient.options[selectedClient.selectedIndex].getAttribute('data-email');
            var phone = selectedClient.options[selectedClient.selectedIndex].getAttribute('data-phone');
            var cedula = selectedClient.options[selectedClient.selectedIndex].getAttribute('data-cedula');

            // Actualizar los campos de email, phone y cedula
            emailInput.value = email;
            phoneInput.value = phone;
            cedulaInput.value = cedula;
        }
    </script>
@endsection
