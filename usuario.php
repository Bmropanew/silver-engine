<?php 
	
    require_once("conexion/cls_conectar.php");
    $obj=new conexion();
    $sql="select * from usuario";
    $rsMed=mysqli_query($obj->getConexion(),$sql);
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="usuario.css">
    <title>Listado de Usuarios</title>
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

<div class="container">
    <h2 class="text-center mt-2">Listado de Usuarios</h2>


    <div class="d-flex mb-3">
        <div class="me-2">
            <label for="searchCodigo" class="form-label">Código</label>
            <input type="text" id="searchCodigo" class="form-control" placeholder="Buscar por código...">
        </div>
        <div class="me-2">
            <label for="searchCorreo" class="form-label">Correo</label>
            <input type="text" id="searchCorreo" class="form-control" placeholder="Buscar por correo...">
        </div>
        <div class="me-2">
            <label for="searchRol" class="form-label">Rol</label>
            <input type="text" id="searchRol" class="form-control" placeholder="Buscar por rol...">
        </div>
        <div class="me-2">
            <label for="searchEstado" class="form-label">Estado</label>
            <input type="text" id="searchEstado" class="form-control" placeholder="Buscar por estado...">
        </div>
        <button id="buscarUsuarios" class="btn btn-primary">Buscar</button>
    </div>

   
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Usuario</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formEditar">
                        <input type="hidden" name="tipo" value="crud">
                        <input type="hidden" name="codigo" id="u-codigo">
                        <div class="mb-3">
                            <label for="u-nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" name="nombre" id="u-nombre" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="u-apellido" class="form-label">Apellido</label>
                            <input type="text" class="form-control" name="apellido" id="u-apellido" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="u-correo" class="form-label">Correo</label>
                            <input type="email" class="form-control" name="correo" id="u-correo" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="u-telefono" class="form-label">Teléfono</label>
                            <input type="text" class="form-control" name="telefono" id="u-telefono" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="u-direccion" class="form-label">Dirección</label>
                            <input type="text" class="form-control" name="direccion" id="u-direccion" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="u-fecha" class="form-label">Fecha</label>
                            <input type="date" class="form-control" name="fecha" id="u-fecha" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="u-genero" class="form-label">Género</label>
                            <input type="text" class="form-control" name="genero" id="u-genero" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="u-roles" class="form-label">Roles</label>
                            <input type="text" class="form-control" name="roles" id="u-roles">
                        </div>
                        <div class="mb-3">
                            <label for="u-estado" class="form-label">Estado</label>
                            <input type="text" class="form-control" name="estado" id="u-estado">
                        </div>
                        <button type="button" class="btn btn-primary" id="guardar">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

   
    <table class="table" id="tablaUsuarios">
        <thead>
            <tr>
                <th>Código</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Correo</th>
                <th>Teléfono</th>
                <th>Dirección</th>
                <th>Fecha</th>
                <th>Género</th>
                <th>Rol</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
           
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        buscarUsuarios();

     
        $('#buscarUsuarios').click(function() {
            buscarUsuarios();
        });

       
        $('#tablaUsuarios').on('click', '.editar', function() {
            var id = $(this).data('id');
            $.ajax({
                url: 'ControladorUsuarios.php',
                method: 'POST',
                data: {
                    tipo: 'obtener_usuario',
                    codigo: id
                },
                success: function(response) {
                    var data = JSON.parse(response);
                    var usuario = data.usuario;
                   
                    $('#u-codigo').val(usuario.id_usuario);
                    $('#u-nombre').val(usuario.nombre);
                    $('#u-apellido').val(usuario.apellidos);
                    $('#u-correo').val(usuario.correo);
                    $('#u-telefono').val(usuario.telefono);
                    $('#u-direccion').val(usuario.direccion);
                    $('#u-fecha').val(usuario.fecha);
                    $('#u-genero').val(usuario.genero);
                    $('#u-roles').val(usuario.rol);
                    $('#u-estado').val(usuario.estado);
                   
                    $('#exampleModal').modal('show');
                }
            });
        });

       
        $('#guardar').click(function() {
            var formData = $('#formEditar').serialize();
            $.ajax({
                url: 'ControladorUsuarios.php',
                method: 'POST',
                data: formData,
                success: function(response) {
                    var data = JSON.parse(response);
                    if (data.success) {
                        alert(data.message);
                        $('#exampleModal').modal('hide');
                        buscarUsuarios();
                    } else {
                        alert(data.message);
                    }
                }
            });
        });

        
        function buscarUsuarios() {
            var codigo = $('#searchCodigo').val();
            var correo = $('#searchCorreo').val();
            var rol = $('#searchRol').val();
            var estado = $('#searchEstado').val();

            $.ajax({
                url: 'ControladorUsuarios.php',
                method: 'POST',
                data: {
                    tipo: 'buscar',
                    codigo: codigo,
                    correo: correo,
                    rol: rol,
                    estado: estado
                },
                success: function(response) {
                    var data = JSON.parse(response);
                    var rows = '';
                    data.usuarios.forEach(function(usuario) {
                        rows += '<tr data-id="' + usuario.id_usuario + '">';
                        rows += '<td>' + usuario.id_usuario + '</td>';
                        rows += '<td>' + usuario.nombre + '</td>';
                        rows += '<td>' + usuario.apellidos + '</td>';
                        rows += '<td>' + usuario.correo + '</td>';
                        rows += '<td>' + usuario.telefono + '</td>';
                        rows += '<td>' + usuario.direccion + '</td>';
                        rows += '<td>' + usuario.fecha + '</td>';
                        rows += '<td>' + usuario.genero + '</td>';
                        rows += '<td>' + usuario.rol + '</td>';
                        rows += '<td>' + usuario.estado + '</td>';
                        rows += '<td>';
                        rows += '<button class="btn btn-warning editar" data-id="' + usuario.id_usuario + '">Editar</button>';
                        rows += '<button class="btn btn-danger eliminar" data-id="' + usuario.id_usuario + '">Eliminar</button>';
                        rows += '</td>';
                        rows += '</tr>';
                    });
                    $('#tablaUsuarios tbody').html(rows);
                }
            });
        }
    });
</script>

</body>
</html>
