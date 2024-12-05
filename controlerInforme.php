<?php
session_start();  
require_once("conexion/cls_conectar.php");  


$obj = new conexion();


$filtro = isset($_GET['filtro']) ? $_GET['filtro'] : 'dia';


$query = '';


if (strpos($filtro, 'dia-') === 0) {
    
    $mes = substr($filtro, 4);
    $query = "SELECT DATE(fecha_venta) AS fecha, SUM(total) AS total_ventas
              FROM ventas
              WHERE MONTH(fecha_venta) = '$mes'
              GROUP BY DATE(fecha_venta)
              ORDER BY fecha";
} else {
    switch ($filtro) {
        case 'dia':
            $query = "SELECT DATE(fecha_venta) AS fecha, SUM(total) AS total_ventas
                      FROM ventas
                      GROUP BY DATE(fecha_venta)
                      ORDER BY fecha";
            break;
        case 'mes':
            $query = "SELECT DATE_FORMAT(fecha_venta, '%Y-%m') AS fecha, SUM(total) AS total_ventas
                      FROM ventas
                      GROUP BY DATE_FORMAT(fecha_venta, '%Y-%m')
                      ORDER BY fecha";
            break;
        case 'anio':
            $query = "SELECT YEAR(fecha_venta) AS fecha, SUM(total) AS total_ventas
                      FROM ventas
                      GROUP BY YEAR(fecha_venta)
                      ORDER BY fecha";
            break;
    }
}


$cn = $obj->getConexion();

$result = mysqli_query($cn, $query);

$data = [];
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
}

echo json_encode($data);
?>
