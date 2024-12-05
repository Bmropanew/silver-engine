<?php
require_once("conexion/cls_conectar.php");
$obj = new conexion();

if ($_POST["tipo"] == "crud") {
    $codigo = $_POST["codigo"];
    $roles = $_POST["roles"];
    $estado = $_POST["estado"];

  
    $sql = "UPDATE usuario SET rol='$roles', estado='$estado' WHERE id_usuario=$codigo";

    if (mysqli_query($obj->getConexion(), $sql)) {
        echo json_encode(["success" => true, "message" => "Usuario actualizado correctamente."]);
    } else {
        echo json_encode(["success" => false, "message" => "No se pudo actualizar el usuario."]);
    }
    exit;
} elseif ($_POST["tipo"] == "eliminar") {
    $codigo = $_POST["codigo"];
    $sql = "DELETE FROM usuario WHERE id_usuario=$codigo";
    if (mysqli_query($obj->getConexion(), $sql)) {
        echo json_encode(["success" => true, "message" => "Usuario eliminado correctamente."]);
    } else {
        echo json_encode(["success" => false, "message" => "No se pudo eliminar el usuario."]);
    }
    exit;
} elseif ($_POST["tipo"] == "buscar") {
    $codigo = $_POST["codigo"];
    $correo = $_POST["correo"];
    $rol = $_POST["rol"];
    $estado = $_POST["estado"];
    
    $conditions = [];
    if (!empty($codigo)) {
        $conditions[] = "id_usuario LIKE '%$codigo%'";
    }
    if (!empty($correo)) {
        $conditions[] = "correo LIKE '%$correo%'";
    }
    if (!empty($rol)) {
        $conditions[] = "rol LIKE '%$rol%'";
    }
    if (!empty($estado)) {
        $conditions[] = "estado LIKE '%$estado%'";
    }

    $sql = "SELECT * FROM usuario";
    if (count($conditions) > 0) {
        $sql .= " WHERE " . implode(" AND ", $conditions);
    }

    $rsMed = mysqli_query($obj->getConexion(), $sql);
    $usuarios = [];
    while ($row = mysqli_fetch_array($rsMed)) {
        $usuarios[] = $row;
    }

    echo json_encode(["usuarios" => $usuarios]);
    exit;
} elseif ($_POST["tipo"] == "obtener_usuario") {
    $codigo = $_POST["codigo"];
    $sql = "SELECT * FROM usuario WHERE id_usuario = $codigo";
    $rsMed = mysqli_query($obj->getConexion(), $sql);
    $usuario = mysqli_fetch_array($rsMed);
    echo json_encode(["usuario" => $usuario]);
    exit;
}
?>
