

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="venta.css">
	<link rel="stylesheet" href="styles.css">
    <title>Ventas</title>
</head>
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

	
<?php 
    
    require_once("conexion/cls_conectar.php");
    $obj = new conexion();
    $sql = $_SESSION["query"] ?? "SELECT 
        v.id_ventas,
        v.id_usuario,
        u.nombre,
        u.apellidos,
        v.fecha_venta,
        v.total,
        v.metodo_pago,
        v.estado
    FROM ventas v
    INNER JOIN usuario u ON v.id_usuario = u.id_usuario
    ORDER BY 
	v.id_ventas";
$rsMed = mysqli_query($obj->getConexion(), $sql);
?>
    <div class="contenedor">
        <div class="container">
            <h2 class="text-center mt-2">Listado de ventas</h2>

          
            <form method="post" action="ControladorVenta.php">
                <input type="hidden" name="tipo" value="buscar">
                <div class="row mb-3">
                    <div class="col-md-3">
                        <input type="text" class="form-control" name="id" placeholder="Buscar por ID">
                    </div>
                    <div class="col-md-3">
                        <input type="text" class="form-control" name="id_usuario" placeholder="Buscar por ID Usuario">
                    </div>
                    <div class="col-md-3">
                        <input type="date" class="form-control" name="fecha">
                    </div>
                    <div class="col-md-3">
                        <input type="text" class="form-control" name="estado" placeholder="Buscar por Estado">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mb-3">Buscar</button>
            </form>

          
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>ID Usuario</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Fecha</th>
                        <th>Total</th>
                        <th>Método Pago</th>
                        <th>Estado</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_array($rsMed)) { ?>
                        <tr>
                            <td><?php echo $row['id_ventas']; ?></td>
                            <td><?php echo $row['id_usuario']; ?></td>
                            <td><?php echo $row['nombre']; ?></td>
                            <td><?php echo $row['apellidos']; ?></td>
                            <td><?php echo $row['fecha_venta']; ?></td>
                            <td><?php echo $row['total']; ?></td>
                            <td><?php echo $row['metodo_pago']; ?></td>
                            <td><?php echo $row['estado']; ?></td>
                            <td>
                                <form method="post" action="ControladorVenta.php" style="display:inline;">
                                    <input type="hidden" name="tipo" value="eliminar">
                                    <input type="hidden" name="codigo" value="<?php echo $row['id_ventas']; ?>">
                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
