<?php
session_start();
header('Content-Type: application/json');
require_once("conexion/cls_conectar.php");

switch ($_GET['action'] ?? '') {

    case 'agregar':
        $data = json_decode(file_get_contents('php://input'), true);
        $id_ropa = $data['id_ropa'];
        $nombre = $data['nombre'];
        $precio = $data['precio'];
        $cantidad = $data['cantidad'];

        if (!isset($_SESSION['carrito'])) {
            $_SESSION['carrito'] = [];
        }


        $productoExistente = false;
        foreach ($_SESSION['carrito'] as &$producto) {
            if ($producto['id_ropa'] === $id_ropa) {
                $producto['cantidad'] += $cantidad;
                $productoExistente = true;
                break;
            }
        }


        if (!$productoExistente) {
            $_SESSION['carrito'][] = [
                'id_ropa' => $id_ropa,
                'nombre' => $nombre,
                'precio' => $precio,
                'cantidad' => $cantidad
            ];
        }

        echo json_encode(['success' => true]);
        break;

    case 'mostrar':
        if (!empty($_SESSION['carrito'])) {
            $carrito = [];
            foreach ($_SESSION['carrito'] as $producto) {
                $carrito[] = [
                    'nombre' => $producto['nombre'],
                    'precio' => $producto['precio'],
                    'cantidad' => $producto['cantidad'],
                    'total' => $producto['precio'] * $producto['cantidad'],
                ];
            }
            echo json_encode($carrito);
        } else {
            echo json_encode([]);
        }
        break;

    case 'eliminar':
        $data = json_decode(file_get_contents('php://input'), true);
        $idProducto = $data['id_producto'];
        foreach ($_SESSION['carrito'] as $key => $producto) {
            if ($producto['nombre'] === $idProducto) {
                unset($_SESSION['carrito'][$key]);
                break;
            }
        }
        echo json_encode(['success' => true]);
        break;

    case 'vaciar':
        $_SESSION['carrito'] = [];
        echo json_encode(['message' => 'Carrito vacío']);
        break;

    case 'comprar':

        if (empty($_SESSION['carrito'])) {
            echo json_encode(['success' => false, 'message' => 'El carrito está vacío.']);
            exit;
        }


        if (isset($_SESSION['correo'])) {
            $correo = $_SESSION['correo'];


            $obj = new conexion();
            $conexion = $obj->getConexion();

            try {

                $stmt_usuario = $conexion->prepare("SELECT id_usuario FROM usuario WHERE correo = ?");
                $stmt_usuario->bind_param("s", $correo);
                $stmt_usuario->execute();
                $stmt_usuario->bind_result($id_usuario);
                $stmt_usuario->fetch();
                $stmt_usuario->close();

                if (!$id_usuario) {
                    echo json_encode(['success' => false, 'message' => 'Usuario no encontrado.']);
                    exit;
                }

                $fecha_venta = date('Y-m-d');
                $total = array_reduce($_SESSION['carrito'], function ($carry, $item) {
                    return $carry + ($item['precio'] * $item['cantidad']);
                }, 0);

                $conexion->begin_transaction();


                $stmt_venta = $conexion->prepare("INSERT INTO ventas (id_usuario, fecha_venta, total) VALUES (?, NOW(), ?)");
                $stmt_venta->bind_param("id", $id_usuario, $total);
                $stmt_venta->execute();
                $id_venta = $conexion->insert_id;


                $stmt_detalle = $conexion->prepare("INSERT INTO detalle_venta (id_ventas, id_ropa, cantidad, precio, subtotal) VALUES (?, ?, ?, ?, ?)");
                $stmt_update_stock = $conexion->prepare("UPDATE ropa SET stock = stock - ? WHERE id_ropa = ?");

                foreach ($_SESSION['carrito'] as $producto) {
                    $id_ropa = $producto['id_ropa'];
                    $cantidad = $producto['cantidad'];
                    $precio = $producto['precio'];
                    $subtotal = $cantidad * $precio;


                    $stmt_detalle->bind_param("iiidd", $id_venta, $id_ropa, $cantidad, $precio, $subtotal);
                    $stmt_detalle->execute();


                    $stmt_update_stock->bind_param("ii", $cantidad, $id_ropa);
                    $stmt_update_stock->execute();
                }

                $conexion->commit();


                $_SESSION['carrito'] = [];
                echo json_encode(['success' => true, 'message' => 'Compra realizada con éxito.']);
            } catch (Exception $e) {
                $conexion->rollback();
                echo json_encode(['success' => false, 'message' => 'Error al realizar la compra: ' . $e->getMessage()]);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'No se ha encontrado el correo en la sesión.']);
        }
        break;



    default:
        echo json_encode(['message' => 'Acción no válida']);
        break;
}
?>