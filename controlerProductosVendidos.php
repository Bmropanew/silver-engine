<?php
session_start();
require_once("conexion/cls_conectar.php");

$obj = new conexion();
$filtro = isset($_GET['filtro']) ? $_GET['filtro'] : 'anio';
$tipo = isset($_GET['tipo']) ? $_GET['tipo'] : 'mas_vendidos';
$mes = isset($_GET['mes']) ? $_GET['mes'] : '01';


$condicion = "";
if ($filtro === 'dia') {
    $condicion = "WHERE MONTH(v.fecha_venta) = '$mes' AND YEAR(v.fecha_venta) = YEAR(CURDATE())";
} elseif ($filtro === 'mes') {
    $condicion = "WHERE MONTH(v.fecha_venta) = '$mes'";
} elseif ($filtro === 'anio') {
    $condicion = "WHERE YEAR(v.fecha_venta) = YEAR(CURDATE())";
}


$orden = $tipo === 'mas_vendidos' ? 'DESC' : 'ASC';


$query = "
    SELECT 
        r.nombre, 
        COALESCE(SUM(dv.cantidad), 0) AS total_cantidad
    FROM ropa r
    LEFT JOIN detalle_venta dv ON dv.id_ropa = r.id_ropa
    LEFT JOIN ventas v ON dv.id_ventas = v.id_ventas
    $condicion
    GROUP BY r.id_ropa, r.nombre
    ORDER BY total_cantidad $orden
    LIMIT 15
";

$cn = $obj->getConexion();
$result = mysqli_query($cn, $query);

$data = [];
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
}


$totalProductos = count($data);
if ($totalProductos < 15) {
    $productosFaltantes = 15 - $totalProductos;

    $queryFaltantes = "
        SELECT r.nombre 
        FROM ropa r
        WHERE r.id_ropa NOT IN (
            SELECT DISTINCT dv.id_ropa
            FROM detalle_venta dv
            LEFT JOIN ventas v ON dv.id_ventas = v.id_ventas
            $condicion
        )
        LIMIT $productosFaltantes
    ";
    $resultFaltantes = mysqli_query($cn, $queryFaltantes);

    if ($resultFaltantes) {
        while ($row = mysqli_fetch_assoc($resultFaltantes)) {
            $data[] = ['nombre' => $row['nombre'], 'total_cantidad' => 0];
        }
    }
}

echo json_encode($data);
?>