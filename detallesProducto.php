<?php
session_start();
ini_set('display_errors', 0);
error_reporting(0);
?>
<?php
require_once("controlerDetalleProducto.php");

if (!isset($_GET['id'])) {
    echo "Error: ID de producto no proporcionado.";
    exit;
}

$id_ropa = intval($_GET['id']);
$producto = obtenerDetalleProducto($id_ropa);
$producto['id_ropa']=$id_ropa;

if (isset($producto['error'])) {
    echo "<p>Error: " . $producto['error'] . "</p>";
    exit;
}
?>
<?php include('modalCarrito.php'); ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="DetalleProducto.css">
    <link rel="stylesheet" href="Todo.css">
    <title><?php echo $producto['nombre']; ?></title>
    <style>
        #modal-carrito #total-carrito {
            margin-top: 20px;
            font-size: 18px;
            font-weight: bold;
            color: #333 !important;
            background-color: #f8f8f8;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
        }

        #modal-carrito #total-carrito strong {
            color: #f00 !important;
        }
    </style>
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
    <section class="hero">
        <div class="search-container">
            <ul>
                <li><a href="#" id="abrir-carrito"><i class="fas fa-shopping-cart"></i> Carrito</a></li>
            </ul>
        </div>
    </section>

    <div id="modal-carrito" class="modal">
        <div class="modal-content">
            <span class="close-btn">&times;</span>
            <h2>Carrito de Compras</h2>
            <table id="tabla-carrito">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Subtotal</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="contenido-carrito"></tbody>
            </table>
            <div id="total-carrito">
                <strong>Total: S/ 0.00</strong>
            </div>
            <button id="btn-vaciar-carrito">Vaciar Carrito</button>
            <button id="btn-comprar" style="display: none;">Comprar</button>
        </div>
    </div>

    <main>
        <div class="producto-detalle">
            <div class="imagen-container">
                <h1><?php echo $producto['nombre']; ?></h1>
                <img src="<?php echo $producto['img_ruta']; ?>" alt="<?php echo $producto['nombre']; ?>">
            </div>

            <div class="detalles-container">
                <p><strong>Descripción:</strong> <?php echo $producto['descripcion']; ?></p>
                <p><strong>Cuidado:</strong> <?php echo $producto['cuidado']; ?></p>
                <p><strong>Materiales:</strong> <?php echo $producto['materiales']; ?></p>
                <p><strong>Precio:</strong> S/ <?php echo $producto['precio_venta']; ?></p>
                <p><strong>Categoría:</strong> <?php echo $producto['categoria']; ?></p>
                <p><strong>Marca:</strong> <?php echo $producto['marca']; ?></p>
                <p><strong>Talla:</strong> <?php echo $producto['talla']; ?></p>
                <p><strong>Stock:</strong> <?php echo $producto['stock']; ?></p>

                <div class="carrito">
                    <label for="cantidad-<?php echo $producto['id_ropa']; ?>">Cantidad:</label>
                    <input type="number" id="cantidad-<?php echo $producto['id_ropa']; ?>" min="1" value="1">
                    <button onclick="agregarAlCarrito(<?php echo $producto['id_ropa']; ?>, '<?php echo $producto['nombre']; ?>', <?php echo $producto['precio_venta']; ?>, document.getElementById('cantidad-<?php echo $producto['id_ropa']; ?>').value)">
                        Agregar al carrito
                    </button>
                </div>
            </div>
        </div>
    </main>

    <footer>
        <p>© 2024 Mi Sitio. Todos los derechos reservados.</p>
    </footer>

    <script>
        let carrito = [];

        function agregarAlCarrito(id_ropa, nombre, precio, cantidad) {
            cantidad = parseInt(cantidad);
            if (cantidad <= 0) {
                mostrarPopUp('La cantidad debe ser mayor a 0.', true);
                return;
            }

            const producto = { id_ropa, nombre, precio, cantidad };

            fetch('controlerCarrito.php?action=agregar', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(producto),
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        mostrarPopUp(`${cantidad} ${nombre}(s) agregado(s) al carrito.`);
                        actualizarTablaCarrito();
                    } else {
                        mostrarPopUp('Error al agregar el producto al carrito.', true);
                    }
                })
                .catch(error => {
                    console.error('Error al agregar al carrito:', error);
                    mostrarPopUp('Error al procesar la solicitud.', true);
                });
        }

        function actualizarTablaCarrito() {
            fetch('controlerCarrito.php?action=mostrar')
                .then(response => response.json())
                .then(data => {
                    carrito = data;
                    const tablaCarrito = document.getElementById('contenido-carrito');
                    const totalCarrito = document.getElementById('total-carrito');
                    const btnComprar = document.getElementById('btn-comprar');

                    if (carrito.length === 0) {
                        tablaCarrito.innerHTML = '<tr><td colspan="5">El carrito está vacío.</td></tr>';
                        totalCarrito.innerHTML = '<strong>Total: S/ 0.00</strong>';
                        btnComprar.style.display = 'none';
                        return;
                    }

                    let total = 0;
                    tablaCarrito.innerHTML = carrito.map((producto, index) => {
                        const subtotal = producto.precio * producto.cantidad;
                        total += subtotal;
                        return `
                        <tr>
                            <td>${producto.nombre}</td>
                            <td>S/${producto.precio.toFixed(2)}</td>
                            <td>${producto.cantidad}</td>
                            <td>S/${subtotal.toFixed(2)}</td>
                            <td>
                                <button onclick="eliminarProducto(${index})">Eliminar</button>
                            </td>
                        </tr>
                    `;
                    }).join('');

                    totalCarrito.innerHTML = `<strong>Total: S/${total.toFixed(2)}</strong>`;
                    btnComprar.style.display = 'block';
                })
                .catch(error => {
                    console.error('Error al obtener el carrito:', error);
                });
        }

        document.getElementById('abrir-carrito').addEventListener('click', function (event) {
            event.preventDefault();
            actualizarTablaCarrito();
            document.getElementById('modal-carrito').style.display = 'block';
        });

        document.querySelector('.close-btn').addEventListener('click', function () {
            document.getElementById('modal-carrito').style.display = 'none';
        });

        function eliminarProducto(indice) {
    const idProducto = carrito[indice].nombre; 
    fetch('controlerCarrito.php?action=eliminar', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ id_producto: idProducto }),
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                mostrarPopUp('Producto eliminado del carrito.');
                carrito.splice(indice, 1);
                actualizarTablaCarrito();
            } else {
                mostrarPopUp('No se pudo eliminar el producto.', true);
            }
        })
        .catch(error => {
            console.error('Error al eliminar el producto:', error);
            mostrarPopUp('Error al eliminar el producto.', true);
        });
}

function mostrarPopUp(mensaje, error = false) {
    const popUp = document.getElementById('popUp');
    
    popUp.innerText = mensaje;
    
    if (error) {
        popUp.classList.add('error');
    } else {
        popUp.classList.remove('error');
    }

    popUp.style.display = 'block'; 

    setTimeout(() => {
        popUp.style.display = 'none';
    }, 3000); 
}

        document.getElementById('btn-vaciar-carrito').addEventListener('click', function () {
            fetch('controlerCarrito.php?action=vaciar')
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        carrito = [];
                        actualizarTablaCarrito();
                    }
                });
        });

        document.getElementById('btn-vaciar-carrito').addEventListener('click', function() {
    fetch('controlerCarrito.php?action=vaciar')
        .then(response => response.json())
        .then(data => {
            mostrarPopUp(data.message);
            carrito = [];
            actualizarTablaCarrito();
        })
        .catch(error => {
            console.error('Error al vaciar el carrito:', error);
            mostrarPopUp('Error al vaciar el carrito.', true);
        });
});

document.getElementById('btn-comprar').addEventListener('click', function() {
    fetch('controlerCarrito.php?action=comprar', {
        method: 'POST',
    })
        .then(response => response.json())
        .then(data => {
            mostrarPopUp(data.message, !data.success);
            if (data.success) {
                actualizarTablaCarrito(); 
            }
        })
        .catch(error => {
            console.error('Error al realizar la compra:', error);
            mostrarPopUp('Error al procesar la compra.', true);
        });
});
    </script>

<div id="popUp" class="pop-up"></div>
</body>

</html>
