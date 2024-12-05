<?php
session_start();
require_once("conexion/cls_conectar.php");

$obj = new conexion();
$cn = $obj->getConexion();

if (isset($_GET['filtro'])) {
    $filtro = $_GET['filtro'];

    $sql = "
        SELECT 
            SUM(dv.cantidad * r.precio_venta) AS venta_total,
            SUM(dv.cantidad * (r.precio_venta - r.precio_compra)) AS ganancia_neta,
            SUM(dv.cantidad * r.precio_compra) AS inversion
        FROM ventas v
        JOIN detalle_venta dv ON v.id_ventas = dv.id_ventas
        JOIN ropa r ON dv.id_ropa = r.id_ropa
        WHERE 1 ";

    if ($filtro === 'dia') {
        $sql .= "AND DATE(v.fecha_venta) = CURDATE() ";
    } elseif ($filtro === 'mes') {
        $sql .= "AND MONTH(v.fecha_venta) = MONTH(CURRENT_DATE()) ";
    } elseif ($filtro === 'anio') {
        $sql .= "AND YEAR(v.fecha_venta) = YEAR(CURRENT_DATE()) ";
    }


    $result = $cn->query($sql);


    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();


        echo json_encode($data);
    } else {
        echo json_encode(['error' => 'No se encontraron datos para los filtros seleccionados.']);
    }
} else {
    echo json_encode(['error' => 'No se recibió el filtro.']);
}
?>