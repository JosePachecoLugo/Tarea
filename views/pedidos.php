<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario de Usuarios y Productos</title>
</head>
<body>
    <h1>Formulario de Usuarios y Productos</h1>

    <form action="procesar_formulario.php" method="POST">
        <h2>Datos del Usuario</h2>
        <label for="nombreUsuario">Nombre de usuario:</label>
        <input type="text" id="nombreUsuario" name="nombreUsuario" required>

        <h2>Productos y Cantidad</h2>
        <div id="productosContainer">
            <div class="producto">
                <label for="producto1">Producto 1:</label>
                <input type="text" id="producto1" name="productos[]" required>

                <label for="cantidad1">Cantidad:</label>
                <input type="number" id="cantidad1" name="cantidades[]" required>
            </div>
        </div>

        <button type="button" onclick="agregarProducto()">Agregar Producto</button>

        <br><br>

        <input type="submit" value="Enviar">
    </form>

    <script>
        let productoCounter = 1;

        function agregarProducto() {
            productoCounter++;

            const nuevoProducto = `
                <div class="producto">
                    <label for="producto${productoCounter}">Producto ${productoCounter}:</label>
                    <input type="text" id="producto${productoCounter}" name="productos[]" required>

                    <label for="cantidad${productoCounter}">Cantidad:</label>
                    <input type="number" id="cantidad${productoCounter}" name="cantidades[]" required>
                </div>
            `;

            document.getElementById('productosContainer').insertAdjacentHTML('beforeend', nuevoProducto);
        }
    </script>
</body>
</html>
