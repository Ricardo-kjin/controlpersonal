{{-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> --}}

@extends('layouts.panel')

@section('content')
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
                                <label for="nombre" class="ms-0">CLIENTE </label>
                                <select class="form-control" id="cliente" name="cliente">
                                    @foreach ($clientes as $cliente)
                                        <option value="{{ $cliente->id }}"> {{ $cliente->name }}</option>
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
            </div>
        </div>
    </div>


@endsection

@section('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var cont = 0;
        var detallesVenta = [];  // Cambiado el nombre de la variable para reflejar que ahora es un array de objetos

        // Definir la función eliminarFila en el ámbito global
        window.eliminarFila = function(index, subtotalProducto) {
            detallesVenta.splice(index, 1);
            actualizarTotal(); // Llama a la función para actualizar el total
        };

        // Asignar el evento click al botón
        document.getElementById("bt_add").addEventListener("click", agregarFila);

        // Definición de la función agregarFila
        function agregarFila() {
            var producto = document.getElementById("producto").options[document.getElementById("producto")
                .selectedIndex].text;
            var cantidad = document.getElementById("pcantidad").value;
            var precio = document.getElementById("precio").value;
            var subtotalProducto = cantidad * precio;

            // Validar que se haya seleccionado un producto y se haya ingresado una cantidad válida
            if (producto !== "" && cantidad !== "" && cantidad > 0 && precio !== "") {
                var fila = "<tr id='fila" + cont + "'>" +
                    "<td><button type='button' class='btn btn-warning' onclick='eliminarFila(" + cont + "," +
                    subtotalProducto + ")'>X</button></td>" +
                    "<td>" + producto + "</td>" +
                    "<td>" + cantidad + "</td>" +
                    "<td>" + precio + "</td>" +
                    "<td>" + subtotalProducto + "</td>" +
                    "</tr>";

                cont++;
                // Construir objeto con detalles de la fila
                var detalleFila = {
                    producto: producto,
                    cantidad: cantidad,
                    precio: precio,
                    subtotal: subtotalProducto
                };

                // Agrega detalleFila al array detallesVenta
                detallesVenta.push(detalleFila);

                // Actualiza la tabla y el total
                document.getElementById("detalles").getElementsByTagName('tbody')[0].insertAdjacentHTML(
                    'beforeend', fila);
                actualizarTotal();

                limpiar();
            } else {
                alert("Error al ingresar el detalle de la venta, revise los datos del producto");
            }
        }

        function actualizarTotal() {
            // Lógica para actualizar el total después de eliminar una fila
            // Obtener todos los subtotales actuales
            var subtotales = detallesVenta.map(function(detalle) {
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
        }

        function limpiar() {
            document.getElementById("pcantidad").value = "";
            document.getElementById("stock").value = "";
            document.getElementById("precio").value = "";
        }
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
    </script>
@endsection
