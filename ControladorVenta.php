<?php 
session_start();
require_once("conexion/cls_conectar.php");
$obj = new conexion();

$tipo = $_POST["tipo"] ?? null;

if ($tipo == "eliminar") {
    
    $cod = $_POST["codigo"];
    $sql = "DELETE FROM ventas WHERE id_ventas = '$cod'";
    $rsMed = mysqli_query($obj->getConexion(), $sql);
    $_SESSION["Mensaje"] = 3; 
    header("location:venta.php");
} elseif ($tipo == "buscar") {
    
    $id = $_POST["id"] ?? null;
    $id_usuario = $_POST["id_usuario"] ?? null;
    $fecha = $_POST["fecha"] ?? null;
    $estado = $_POST["estado"] ?? null;

   
    $sql = "SELECT v.id_ventas, v.id_usuario, u.nombre, u.apellidos, 
                   v.fecha_venta, v.total, v.metodo_pago, v.estado
            FROM ventas v
            INNER JOIN usuario u ON v.id_usuario = u.id_usuario
            WHERE 1 = 1";

    
    if (!empty($id)) {
        $sql .= " AND v.id_ventas = '$id'";
    }
    if (!empty($id_usuario)) {
        $sql .= " AND v.id_usuario = '$id_usuario'";
    }
    if (!empty($fecha)) {
        $sql .= " AND v.fecha_venta = '$fecha'";
    }
    if (!empty($estado)) {
        $sql .= " AND v.estado LIKE '%$estado%'";
    }

    
    $_SESSION["query"] = $sql;
    header("location:venta.php");
}
?>
