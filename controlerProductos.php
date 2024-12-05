<?php
require_once("conexion/cls_conectar.php");

function obtenerProductos()
{
    try {
        $obj = new conexion();
        $conn = $obj->getConexion();
        $query = "SELECT id_ropa, nombre, precio_venta, img_ruta FROM ropa";
        $result = $conn->query($query);
        $productos = $result->fetch_all(MYSQLI_ASSOC);
        echo json_encode($productos);
    } catch (Exception $e) {
        echo json_encode(["error" => $e->getMessage()]);
    }
}

if (isset($_GET['action']) && $_GET['action'] === 'getProducts') {
    obtenerProductos();
}
?>
