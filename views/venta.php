<?php
include_once "../includes/header.php";
?>

<!-- Incluir la biblioteca jQuery y jQuery UI Autocomplete -->

<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/smoothness/jquery-ui.css">
<script src="../js/jquery-ui.js"></script>

<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <h4 class="text-center">Datos del Cliente</h4>
            </div>
            <div class="card">
                <div class="card-body">
                    <form method="post" name="form_new_cliente_venta" id="form_new_cliente_venta">

                        <div class="row" id="datosCliente">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Nombre</label>
                                    <input type="text" name="cliente" id="cliente" class="form-control" required>
                                </div>
                            </div>

                            <!-- este es el id del cliente oculto -->
                            <input type="hidden" name="id_cliente" id="id" class="form-control">

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Teléfono</label>
                                    <input type="number" name="telefono" id="telefono" class="form-control" disabled required>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Dirección</label>
                                    <input type="text" name="direccion" id="direccion" class="form-control" disabled required>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
            <br>

            <h4 class="text-center">Datos Venta</h4>
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label><i class="fas fa-user"></i> VENDEDOR</label>
                        <p style="font-size: 16px; text-transform: uppercase; color: blue;"><?php echo $_SESSION['usuario']; ?></p>
                    </div>
                </div>

            </div>
            <!-- BUSCADOR VENTA -->
            <form method="post" action="agregarAlCarrito.php" id="formBusqueda">
                <label for="codigo">Código de barras:</label>
                <input autocomplete="off" width="100%" autofocus class="form-control" name="codigo" required type="text" id="codigo" placeholder="Escanea o Escribe el código...">
            </form>
            <br>

            <div class="table-responsive">
                <table class="table table-striped" id="table_id" width="100%">
                    <thead>
                        <tr class="bg-dark" style="color: white;">
                            <th>Código</th>
                            <th>Descripción</th>
                            <th>Stock</th>
                            <th>Precio de venta</th>
                            <th>Cantidad</th>
                            
                            <th>Quitar</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody id="resultadoBusqueda">
                        <!-- Aquí se mostrarán los productos encontrados -->
                        <script src="script.js"></script>
                    </tbody>
                </table>
            </div>



            <br>
            <h3>Total General: $<span id="granTotal">0.00</span></h3>
            <div id="formularioVenta"></div>
            <button type="button" class="btn btn-success mt-3" id="procesarVenta">Procesar Venta</button>

<!-- Resto del contenido ... -->

<script>

// Resto del código ...

document.getElementById('procesarVenta').addEventListener('click', function() {
    // Obtener el gran total
    const granTotal = parseFloat(document.getElementById('granTotal').innerText);

    // Crear un formulario para mostrar el gran total y el proceso de venta
    const formHTML = `
        <form id="ventaForm" class="mt-3" action="terminarVenta.php" method="POST">
            <div class="form-group">
                
                <label for="granTotal">Gran Total:</label>
                <input type="text" class="form-control" id="granTotal" value="$${granTotal.toFixed(2)}" readonly>
            </div>
            <div class="form-group">
                <label for="cantidadPagada">El cliente pagó con:</label>
                <input type="number" class="form-control" id="cantidadPagada" placeholder="Ingrese la cantidad">
            </div>
            <div class="form-group">
                <label for="cambio">Cambio:</label>
                <input type="text" class="form-control" id="cambio" readonly>
            </div>
            <button type="submit" class="btn btn-primary" id="confirmarVenta">Confirmar</button>
        </form>
    `;

    // Mostrar el formulario en un elemento con un ID específico (aquí se asume que tienes un elemento con el ID "formularioVenta")
    document.getElementById('formularioVenta').innerHTML = formHTML;

    // Calcular el cambio cuando la cantidad pagada cambia
    document.getElementById('cantidadPagada').addEventListener('input', function() {
        const cantidadPagada = parseFloat(this.value) || 0;
        const cambio = cantidadPagada - granTotal;
        document.getElementById('cambio').value = `$${cambio.toFixed(2)}`;
    });

    // Cuando se confirma la venta
    document.getElementById('confirmarVenta').addEventListener('click', function(event) {
    event.preventDefault();

    const cantidadVendida = parseFloat(document.getElementById('cantidadVendida').value) || 0;
    const codigo = document.getElementById('codigo').value;

    // Actualizar la cantidad vendida en la base de datos
    actualizarCantidadEnBD(codigo, cantidadVendida);

    // Mostrar un mensaje de éxito
    alert("Venta realizada con éxito");

    // Recargar la página para volver a la página de inicio
    location.reload();
});

function actualizarCantidadEnBD(codigo, cantidadVendida) {
    // Aquí deberías hacer una solicitud AJAX para enviar la cantidad vendida al servidor y actualizar la base de datos.
    // Puedes usar fetch() u otras librerías como Axios para hacer la solicitud al servidor.
    // Aquí se muestra un ejemplo simple utilizando fetch().
    const formData = new FormData();
    formData.append('codigo', codigo);
    formData.append('cantidadVendida', cantidadVendida);

    fetch('actualizarCantidadEnBD.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        // Puedes realizar acciones adicionales si es necesario
    })
    .catch(error => console.error('Error:', error));
}

});

// Resto del código ...

</script>


        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->


<!--Aqui se obtiene el cliente-->
<script src="../js/searchcliente.js"></script>

<?php include "../includes/footer.php"; ?>
