<?php 
    require_once("conexion/cls_conectar.php");
    $obj = new conexion();

    // Obtención de parámetros de búsqueda
    $codigo = isset($_GET['codigo']) ? $_GET['codigo'] : '';
    $nombre = isset($_GET['nombre']) ? $_GET['nombre'] : '';
    $categoria = isset($_GET['categoria']) ? $_GET['categoria'] : '';
    $marca = isset($_GET['marca']) ? $_GET['marca'] : '';
    $talla = isset($_GET['talla']) ? $_GET['talla'] : '';

    // Construcción de la consulta con los filtros
    $sql = "SELECT 
                r.id_ropa, 
                r.nombre AS ropa_nombre, 
                r.color, 
                r.descripcion, 
                r.cuidado, 
                r.materiales, 
                r.precio_compra, 
                r.precio_venta, 
                r.stock, 
                c.nombre AS categoria_nombre, 
                m.nombre AS marca_nombre, 
                t.talla, 
                r.img_ruta
            FROM 
                ropa r
            INNER JOIN 
                categoria c ON r.id_categoria = c.id_categoria
            INNER JOIN 
                marca m ON r.id_marca = m.id_marca
            INNER JOIN 
                talla t ON r.id_talla = t.id_talla
            WHERE
                r.id_ropa LIKE '%$codigo%' AND
                r.nombre LIKE '%$nombre%' AND
                c.id_categoria LIKE '%$categoria%' AND
                m.id_marca LIKE '%$marca%' AND
                t.id_talla LIKE '%$talla%'
            ORDER BY 
                r.id_ropa";

    $rsMed = mysqli_query($obj->getConexion(), $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="inventario.css">
    <link rel="stylesheet" href="styles.css">
    <title>Inventario</title>
</head>
<style>
    .modal-title {
        color:black; 
    }
    .modal-body label {
        color: black; 
    }
</style> 

<body>

<header>
    <div class="logo">
        <img src="img/el_logo_BM.jpg" alt="Logo" width="50">
    </div>
    <nav>
        <ul>
            <?php include("menu.php"); ?>
        </ul>
    </nav>
</header>

<div class="contenedor">
    <div class="container">
        <h2 class="text-center mt-2">Listado de inventario</h2>
        
        <!-- Barra de búsqueda -->
        <div class="d-flex mb-3">
            <input type="text" id="codigo" class="form-control me-2" placeholder="Buscar por código" value="<?php echo $codigo; ?>">
            <input type="text" id="nombre" class="form-control me-2" placeholder="Buscar por nombre" value="<?php echo $nombre; ?>">
            
            <select id="categoria" class="form-select me-2">
                <option value="">Seleccionar Categoría</option>
                <?php
                $sql_categoria = "SELECT id_categoria, nombre FROM categoria";
                $result_categoria = mysqli_query($obj->getConexion(), $sql_categoria);
                while ($row_categoria = mysqli_fetch_assoc($result_categoria)) {
                    echo "<option value='" . $row_categoria['id_categoria'] . "' " . ($row_categoria['id_categoria'] == $categoria ? 'selected' : '') . ">" . $row_categoria['nombre'] . "</option>";
                }
                ?>
            </select>
            
            <select id="marca" class="form-select me-2">
                <option value="">Seleccionar Marca</option>
                <?php
                $sql_marca = "SELECT id_marca, nombre FROM marca";
                $result_marca = mysqli_query($obj->getConexion(), $sql_marca);
                while ($row_marca = mysqli_fetch_assoc($result_marca)) {
                    echo "<option value='" . $row_marca['id_marca'] . "' " . ($row_marca['id_marca'] == $marca ? 'selected' : '') . ">" . $row_marca['nombre'] . "</option>";
                }
                ?>
            </select>

            <select id="talla" class="form-select me-2">
                <option value="">Seleccionar Talla</option>
                <?php
                $sql_talla = "SELECT id_talla, talla FROM talla";
                $result_talla = mysqli_query($obj->getConexion(), $sql_talla);
                while ($row_talla = mysqli_fetch_assoc($result_talla)) {
                    echo "<option value='" . $row_talla['id_talla'] . "' " . ($row_talla['id_talla'] == $talla ? 'selected' : '') . ">" . $row_talla['talla'] . "</option>";
                }
                ?>
            </select>

            <button type="button" class="btn btn-primary" onclick="search()">Buscar</button>
        </div>

         <!-- Botón para abrir el modal de nueva prenda -->
         <button type="button" class="btn btn-primary" onclick="openCreateModal()">
            Nueva prenda
        </button>

        <!-- Modal para nueva prenda -->
        <div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalLabel">Nueva Prenda</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="ControladorInventario.php" method="POST" id="productForm">
                            <input type="hidden" name="tipo" id="formTipo" value="insertar">
                           
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" required>
                            </div>
                            <div class="mb-3">
                                <label for="color" class="form-label">Color</label>
                                <input class="form-control" id="color" name="color" required>
                            </div>
                            <div class="mb-3">
                                <label for="descripcion" class="form-label">Descripción</label>
                                <textarea class="form-control" id="descripcion" name="descripcion" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="cuidado" class="form-label">Cuidado</label>
                                <textarea class="form-control" id="cuidado" name="cuidado" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="materiales" class="form-label">Materiales</label>
                                <textarea class="form-control" id="materiales" name="materiales" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="precioCompra" class="form-label">Precio Compra</label>
                                <input type="number" class="form-control" id="precioCompra" name="precioCompra" min="0" step="0.01" required>
                            </div>
                            <div class="mb-3">
                                <label for="precioVenta" class="form-label">Precio Venta</label>
                                <input type="number" class="form-control" id="precioVenta" name="precioVenta" min="0" step="0.01" required>
                            </div>
                            <div class="mb-3">
                                <label for="stock" class="form-label">Stock</label>
                                <input type="number" class="form-control" id="stock" name="stock" min="0" required>
                            </div>
                            <div class="mb-3">
                                <label for="categoria" class="form-label">Categoría</label>
                                <select class="form-control" id="categoria" name="categoria" required>
                                    <?php
                                    $sql_categoria = "SELECT id_categoria, nombre FROM categoria";
                                    $result_categoria = mysqli_query($obj->getConexion(), $sql_categoria);
                                    while ($row_categoria = mysqli_fetch_assoc($result_categoria)) {
                                        echo "<option value='" . $row_categoria['id_categoria'] . "'>" . $row_categoria['nombre'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="marca" class="form-label">Marca</label>
                                <select class="form-control" id="marca" name="marca" required>
                                    <?php
                                    $sql_marca = "SELECT id_marca, nombre FROM marca";
                                    $result_marca = mysqli_query($obj->getConexion(), $sql_marca);
                                    while ($row_marca = mysqli_fetch_assoc($result_marca)) {
                                        echo "<option value='" . $row_marca['id_marca'] . "'>" . $row_marca['nombre'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="talla" class="form-label">Talla</label>
                                <select class="form-control" id="talla" name="talla" required>
                                    <?php
                                    $sql_talla = "SELECT id_talla, talla FROM talla";
                                    $result_talla = mysqli_query($obj->getConexion(), $sql_talla);
                                    while ($row_talla = mysqli_fetch_assoc($result_talla)) {
                                        echo "<option value='" . $row_talla['id_talla'] . "'>" . $row_talla['talla'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="ruta" class="form-label">Ruta de imagen</label>
                                <input type="text" class="form-control" id="ruta" name="ruta" required>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal exclusivo para editar prenda -->
<div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editModalLabel">Editar Prenda</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="ControladorInventario.php" method="POST" id="editProductForm">
                    <!-- Tipo de operación -->
                    <input type="hidden" name="tipo" value="editar">
                    <!-- ID de la prenda -->
                    <input type="hidden" name="id_ropa" id="edit_id_ropa">
                    
                    <!-- Nombre -->
                    <div class="mb-3">
                        <label for="edit_nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="edit_nombre" name="nombre" required>
                    </div>

                    <!-- Color -->
                    <div class="mb-3">
                        <label for="edit_color" class="form-label">Color</label>
                        <input type="text" class="form-control" id="edit_color" name="color" required>
                    </div>

                    <!-- Descripción -->
                    <div class="mb-3">
                        <label for="edit_descripcion" class="form-label">Descripción</label>
                        <textarea class="form-control" id="edit_descripcion" name="descripcion" rows="3" required></textarea>
                    </div>

                    <!-- Cuidado -->
                    <div class="mb-3">
                        <label for="edit_cuidado" class="form-label">Cuidado</label>
                        <input type="text" class="form-control" id="edit_cuidado" name="cuidado" required>
                    </div>

                    <!-- Materiales -->
                    <div class="mb-3">
                        <label for="edit_materiales" class="form-label">Materiales</label>
                        <input type="text" class="form-control" id="edit_materiales" name="materiales" required>
                    </div>

                    <!-- Precio de compra -->
                    <div class="mb-3">
                        <label for="edit_precio_compra" class="form-label">Precio de Compra</label>
                        <input type="number" step="0.01" class="form-control" id="edit_precio_compra" name="precio_compra" required>
                    </div>

                    <!-- Precio de venta -->
                    <div class="mb-3">
                        <label for="edit_precio_venta" class="form-label">Precio de Venta</label>
                        <input type="number" step="0.01" class="form-control" id="edit_precio_venta" name="precio_venta" required>
                    </div>

                    <!-- Stock -->
                    <div class="mb-3">
                        <label for="edit_stock" class="form-label">Stock</label>
                        <input type="number" class="form-control" id="edit_stock" name="stock" required>
                    </div>

                    <!-- Categoría -->
                    <div class="mb-3">
                                <label for="categoria" class="form-label">Categoría</label>
                                <select class="form-control" id="categoria" name="categoria" required>
                                    <?php
                                    $sql_categoria = "SELECT id_categoria, nombre FROM categoria";
                                    $result_categoria = mysqli_query($obj->getConexion(), $sql_categoria);
                                    while ($row_categoria = mysqli_fetch_assoc($result_categoria)) {
                                        echo "<option value='" . $row_categoria['id_categoria'] . "'>" . $row_categoria['nombre'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="marca" class="form-label">Marca</label>
                                <select class="form-control" id="marca" name="marca" required>
                                    <?php
                                    $sql_marca = "SELECT id_marca, nombre FROM marca";
                                    $result_marca = mysqli_query($obj->getConexion(), $sql_marca);
                                    while ($row_marca = mysqli_fetch_assoc($result_marca)) {
                                        echo "<option value='" . $row_marca['id_marca'] . "'>" . $row_marca['nombre'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="talla" class="form-label">Talla</label>
                                <select class="form-control" id="talla" name="talla" required>
                                    <?php
                                    $sql_talla = "SELECT id_talla, talla FROM talla";
                                    $result_talla = mysqli_query($obj->getConexion(), $sql_talla);
                                    while ($row_talla = mysqli_fetch_assoc($result_talla)) {
                                        echo "<option value='" . $row_talla['id_talla'] . "'>" . $row_talla['talla'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                    <!-- Imagen -->
                    <div class="mb-3">
                        <label for="edit_img_ruta" class="form-label">Ruta de la Imagen</label>
                        <input type="text" class="form-control" id="edit_img_ruta" name="img_ruta">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary" form="editProductForm">Guardar Cambios</button>
            </div>
        </div>
    </div>
</div>


        <!-- Tabla de inventario -->
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Color</th>
                    <th>Descripcion</th>
                    <th>Cuidado</th>
                    <th>Materiales</th>
                    <th>Precio Compra</th>
                    <th>Precio Venta</th>
                    <th>Stock</th>
                    <th>Categoria</th>
                    <th>Marca</th>
                    <th>Talla</th>
                    <th>Ruta img</th>
                    <th>Accion</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_array($rsMed)) { ?>
                    <tr>
                        <td><?php echo $row['id_ropa'] ?></td>
                        <td><?php echo $row['ropa_nombre'] ?></td>
                        <td><?php echo $row['color'] ?></td>
                        <td><?php echo $row['descripcion'] ?></td>
                        <td><?php echo $row['cuidado'] ?></td>
                        <td><?php echo $row['materiales'] ?></td>
                        <td><?php echo $row['precio_compra'] ?></td>
                        <td><?php echo $row['precio_venta'] ?></td>
                        <td><?php echo $row['stock'] ?></td>
                        <td><?php echo $row['categoria_nombre'] ?></td>
                        <td><?php echo $row['marca_nombre'] ?></td>
                        <td><?php echo $row['talla'] ?></td>
                        <td><?php echo $row['img_ruta'] ?></td>
                        <td>
                            <button class="btn btn-warning" onclick="openEditModal(<?php echo $row['id_ropa']; ?>)">Editar</button>
                            <button class="btn btn-danger" onclick="deleteProduct(<?php echo $row['id_ropa']; ?>)">Eliminar</button>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<script>
function openCreateModal() {
    const modal = new bootstrap.Modal(document.getElementById("productModal"));
    modal.show();
}

function search() {
    const codigo = document.getElementById("codigo").value;
    const nombre = document.getElementById("nombre").value;
    const categoria = document.getElementById("categoria").value;
    const marca = document.getElementById("marca").value;
    const talla = document.getElementById("talla").value;
    
    const url = `inventario.php?codigo=${codigo}&nombre=${nombre}&categoria=${categoria}&marca=${marca}&talla=${talla}`;
    window.location.href = url;
}

function openEditModal(id_ropa) {
    fetch(`ControladorInventario.php?tipo=obtener&id_ropa=${id_ropa}`)
        .then(response => response.json())
        .then(data => {
            document.getElementById("edit_id_ropa").value = data.id_ropa;
            document.getElementById("edit_nombre").value = data.nombre;
            document.getElementById("edit_color").value = data.color;
            document.getElementById("edit_descripcion").value = data.descripcion;
            document.getElementById("edit_cuidado").value = data.cuidado;
            document.getElementById("edit_materiales").value = data.materiales;
            document.getElementById("edit_precio_compra").value = data.precio_compra;
            document.getElementById("edit_precio_venta").value = data.precio_venta;
            document.getElementById("edit_stock").value = data.stock;
            document.getElementById("categoria").value = data.id_categoria;  // Selección de categoría
            document.getElementById("marca").value = data.id_marca;  // Selección de marca
            document.getElementById("talla").value = data.id_talla;  // Selección de talla
            document.getElementById("edit_img_ruta").value = data.img_ruta;
        });

    const modal = new bootstrap.Modal(document.getElementById("editProductModal"));
    modal.show();
}

function deleteProduct(id_ropa) {
    if (confirm("¿Estás seguro de que deseas eliminar esta prenda?")) {
        window.location.href = `ControladorInventario.php?tipo=eliminar&id_ropa=${id_ropa}`;
    }
}
</script>
</body>
</html>
