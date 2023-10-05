<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombreUsuario = $_POST['nombreUsuario'];
    $productos = $_POST['productos'];
    $cantidades = $_POST['cantidades'];

    // Procesa los datos, por ejemplo, mostrarlos o almacenarlos en una base de datos
    echo "<h2>Datos del Usuario:</h2>";
    echo "Nombre de usuario: $nombreUsuario<br>";

    echo "<h2>Productos y Cantidades:</h2>";
    for ($i = 0; $i < count($productos); $i++) {
        $producto = $productos[$i];
        $cantidad = $cantidades[$i];
        echo "Producto $i: $producto, Cantidad: $cantidad<br>";
    }
}
?>
