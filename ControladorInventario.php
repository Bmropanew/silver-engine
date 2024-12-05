<?php
session_start();
require_once("conexion/cls_conectar.php");
$obj = new conexion();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tipo = $_POST['tipo'];

    if ($tipo === 'insertar') {
       
        $nombre = $_POST['nombre'];
        $color = $_POST['color'];
        $descripcion = $_POST['descripcion'];
        $cuidado = $_POST['cuidado'];
        $materiales = $_POST['materiales'];
        $precio_compra = $_POST['precioCompra'];
        $precio_venta = $_POST['precioVenta'];
        $stock = $_POST['stock'];
        $id_categoria = $_POST['categoria'];
        $id_marca = $_POST['marca'];
        $id_talla = $_POST['talla'];
        $img_ruta = $_POST['img_ruta'];

      
        $sql = "INSERT INTO ropa (nombre, color, descripcion, cuidado, materiales, precio_compra, precio_venta, stock, id_categoria, id_marca, id_talla, img_ruta)
                VALUES ('$nombre', '$color', '$descripcion', '$cuidado', '$materiales', '$precio_compra', '$precio_venta', '$stock', '$id_categoria', '$id_marca', '$id_talla', '$img_ruta')";
        mysqli_query($obj->getConexion(), $sql);

        header("Location: inventario.php");
    } elseif ($tipo === 'editar') {
       
        $id_ropa = $_POST['id_ropa'];
        $nombre = $_POST['nombre'];
        $color = $_POST['color'];
        $descripcion = $_POST['descripcion'];
        $cuidado = $_POST['cuidado'];
        $materiales = $_POST['materiales'];
        $precio_compra = $_POST['precio_compra'];
        $precio_venta = $_POST['precio_venta'];
        $stock = $_POST['stock'];
        $id_categoria = $_POST['categoria'];
        $id_marca = $_POST['marca'];
        $id_talla = $_POST['talla'];
        $img_ruta = $_POST['img_ruta'];

    
        $sql = "UPDATE ropa 
                SET nombre = '$nombre', color = '$color', descripcion = '$descripcion', cuidado = '$cuidado', materiales = '$materiales',
                    precio_compra = '$precio_compra', precio_venta = '$precio_venta', stock = '$stock', id_categoria = '$id_categoria', 
                    id_marca = '$id_marca', id_talla = '$id_talla', img_ruta = '$img_ruta' 
                WHERE id_ropa = '$id_ropa'";

        mysqli_query($obj->getConexion(), $sql);

        header("Location: inventario.php");
    } elseif ($tipo === 'eliminar') {
        
        if (isset($_GET['id_ropa'])) {
            $id_ropa = $_GET['id_ropa'];
    
         
            $sql = "DELETE FROM ropa WHERE id_ropa = '$id_ropa'";
            if (mysqli_query($obj->getConexion(), $sql)) {
                echo "Prenda eliminada correctamente";
            } else {
                echo "Error al eliminar la prenda: " . mysqli_error($obj->getConexion());
            }
    
            
            header("Location: inventario.php");
            exit; 
        } else {
            echo "ID de prenda no especificado.";
        }
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['tipo']) && $_GET['tipo'] === 'obtener') {
   
    $id_ropa = $_GET['id_ropa'];

    $sql = "SELECT r.id_ropa, r.nombre, r.color, r.descripcion, r.cuidado, r.materiales, r.precio_compra, r.precio_venta, r.stock, 
            r.id_categoria, r.id_marca, r.id_talla, r.img_ruta
            FROM ropa r
            WHERE r.id_ropa = '$id_ropa'";

    $result = mysqli_query($obj->getConexion(), $sql);
    $row = mysqli_fetch_assoc($result);

    
    echo json_encode($row);
}
?>
