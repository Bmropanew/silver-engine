<?php
require_once("conexion/cls_conectar.php");
$obj = new conexion();
$conexion = $obj->getConexion();

$data = json_decode(file_get_contents("php://input"), true);

// Recibir los datos
$nombre = mysqli_real_escape_string($conexion, $data['nombre']);
$apellido = mysqli_real_escape_string($conexion, $data['apellido']);
$correo = mysqli_real_escape_string($conexion, $data['correo']);
$telefono = mysqli_real_escape_string($conexion, $data['telefono']);
$direccion = mysqli_real_escape_string($conexion, $data['direccion']);
$fecha = mysqli_real_escape_string($conexion, $data['fecha_nacimiento']);
$genero = mysqli_real_escape_string($conexion, $data['genero']);
$contraseña = mysqli_real_escape_string($conexion, password_hash($data['contraseña'], PASSWORD_DEFAULT));

// Comprobar si el correo ya existe
$sql = "SELECT * FROM usuario WHERE correo = '$correo'";
$result = mysqli_query($conexion, $sql);

if (mysqli_num_rows($result) > 0) {
    echo json_encode(['success' => false, 'message' => 'El correo ya está registrado']);
    exit();
}

// Insertar en la base de datos
$sql_insert = "INSERT INTO usuario (nombre, apellido, correo, telefono, direccion, fecha_nacimiento, genero, contraseña) 
               VALUES ('$nombre', '$apellido', '$correo', '$telefono', '$direccion', '$fecha', '$genero', '$contraseña')";

if (mysqli_query($conexion, $sql_insert)) {
    echo json_encode(['success' => true, 'redirect' => 'Principal.php']);
} else {
    echo json_encode(['success' => false, 'message' => 'Hubo un error al registrar el usuario']);
}
?>
