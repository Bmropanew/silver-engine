<?php
include_once("conexion/cls_conectar.php");

session_start(); 
$obj = new conexion();
$conexion = $obj->getConexion();

if (isset($_SESSION['correo'])) {
    $correo = $_SESSION['correo'];
    $rolmenu = true;

    $queryrol = mysqli_query($conexion, "SELECT rol FROM usuario WHERE correo = '$correo'");

    if ($queryrol) {
        $rolData = mysqli_fetch_assoc($queryrol);
        $rol = $rolData['rol'];

        switch ($rol) {
            case 1:
                $query = "SELECT * FROM rol WHERE rol='1'";
                break;
            case 2:
                $query = "SELECT * FROM rol WHERE rol='2'";
                break;
            case 3:
                $query = "SELECT * FROM rol WHERE rol='3'";
                break;
        }

        $result = mysqli_query($conexion, $query);
        echo "<html><nav><ul>";

        while ($row = mysqli_fetch_assoc($result)) {
            echo '<li><a href="' . htmlspecialchars($row['enlace']) . '">' . htmlspecialchars($row['nombre']) . '</a></li>';
        }

        echo "</ul></nav></html>";
    } else {
        echo "Error en la consulta de rol: " . mysqli_error($conexion);
    }
} else {
    $query = "SELECT * FROM rol WHERE rol='0'";
    $result = mysqli_query($conexion, $query);
    echo "<html><nav><ul>";

    while ($row = mysqli_fetch_assoc($result)) {
        echo '<li><a href="' . htmlspecialchars($row['enlace']) . '">' . htmlspecialchars($row['nombre']) . '</a></li>';
    }

    echo "</ul></nav></html>";
}

mysqli_close($conexion);
?>
