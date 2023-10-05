<?php
include_once "../includes/db.php";

$codigoBarras = $_GET['codigo'];

$sql = "SELECT codigo, producto, existencia, venta FROM inventario WHERE codigo = '$codigoBarras'";
$result = $conexion->query($sql);

if ($result->num_rows > 0) {
    $producto = $result->fetch_assoc();
    echo json_encode($producto);
} else {
    echo json_encode(null);
}

$conexion->close();
?>



