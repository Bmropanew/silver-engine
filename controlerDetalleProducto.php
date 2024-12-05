<?php
require_once("conexion/cls_conectar.php");

function obtenerDetalleProducto($id_ropa) {
    try {
        $obj = new conexion();
        $conn = $obj->getConexion();

        $query = "
            SELECT 
                ropa.id_ropa,
                ropa.nombre,
                ropa.descripcion,
                ropa.cuidado,
                ropa.materiales,
                ropa.precio_venta,
                ropa.img_ruta,
                categoria.nombre AS categoria,
                marca.nombre AS marca,
                talla.talla AS talla,
                ropa.stock
            FROM ropa
            INNER JOIN categoria ON ropa.id_categoria = categoria.id_categoria
            INNER JOIN marca ON ropa.id_marca = marca.id_marca
            INNER JOIN talla ON ropa.id_talla = talla.id_talla
            WHERE ropa.id_ropa = ?";
        
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $id_ropa);
        $stmt->execute();
        $result = $stmt->get_result();
        $producto = $result->fetch_assoc();

        if (!$producto) {
            return ["error" => "Producto no encontrado."];
        }

        return $producto;
    } catch (Exception $e) {
        return ["error" => $e->getMessage()];
    }
}
