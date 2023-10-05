<?php
include_once "../includes/db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $codigoProducto = $_POST['codigo'];
    $cantidadVendida = $_POST['cantidadVendida'];

    // Actualizar la cantidad en la base de datos
    $sql = "UPDATE inventario SET existencia = existencia - $cantidadVendida WHERE codigo = '$codigoProducto'";
    if ($conexion->query($sql) === TRUE) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al actualizar la cantidad en la base de datos']);
    }
}

$conexion->close();
?>
