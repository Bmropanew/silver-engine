<!DOCTYPE html>
<html lang="es">
<?php
session_start(); 
ini_set('display_errors', 0); 
error_reporting(0); 
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="Todo.css">
    <title>Productos disponibles</title>
</head>
<style>

#modal-carrito #total-carrito {
    margin-top: 20px;
    font-size: 18px;
    font-weight: bold;
    color: #333 !important; /* Color de texto oscuro */
    background-color: #f8f8f8; /* Fondo claro */
    padding: 10px;
    border-radius: 5px;
    text-align: center;
}

#modal-carrito #total-carrito strong {
    color: #f00 !important; /* Color rojo para el total */
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

    <main>
        <section class="hero">
            <div class="search-container">
                <input type="text" placeholder="Buscar ropa..." />
                <button><i class="fas fa-search"></i> Buscar</button>
                
                <ul>
                    <li><a href="#" id="abrir-carrito"><i class="fas fa-shopping-cart"></i> Carrito</a></li>  
                </ul>
            </div>
        </section>

        <section>
            <div id="productos" class="grid-container"></div>
            <div id="paginacion" style="text-align: center; margin-top: 20px;"></div> 
        </section>
    </main>

    <!-- Modal del Carrito -->
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
                    <th>Subtotal</th> <!-- Cambiado de Total a Subtotal -->
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="contenido-carrito">
                <!-- Aquí se cargan los productos con JavaScript -->
            </tbody>
        </table>
        <!-- Mostrar el subtotal total fuera de la tabla -->
        <div id="total-carrito">
            <strong>Total: S/ 0.00</strong> <!-- Este será el total de los subtotales -->
        </div>
        <button id="btn-vaciar-carrito">Vaciar Carrito</button>
        <button id="btn-comprar" style="display: none;">Comprar</button> <!-- Botón de compra -->
    </div>
</div>
    <!-- Script para manejar el modal y los productos -->
    <script>
        let paginaActual = 1;
        const productosPorPagina = 18;
        

        function cargarProductos() {
    fetch('controlerProductos.php?action=getProducts')
        .then(response => response.json())
        .then(data => {
            const contenedor = document.getElementById('productos');
            const inicio = (paginaActual - 1) * productosPorPagina;
            const fin = inicio + productosPorPagina;
            const productos = data.slice(inicio, fin);

            if (productos.length === 0 && paginaActual === 1) {
                contenedor.innerHTML = `<p>No hay productos disponibles.</p>`;
            } else {
                contenedor.innerHTML = productos.map(producto => `
                    <div class="grid-item">
                        <a href="detallesProducto.php?id=${producto.id_ropa}">
                            <img src="${producto.img_ruta}" alt="${producto.nombre}" />
                        </a>
                        <h2>${producto.nombre}</h2>
                        <h1>S/${producto.precio_venta}</h1>
                        <div class="carrito">
                            <label for="cantidad-${producto.id_ropa}">Cantidad:</label>
                            <input type="number" id="cantidad-${producto.id_ropa}" min="1" value="1">
                            <button onclick="agregarAlCarrito(${producto.id_ropa}, '${producto.nombre}', ${producto.precio_venta}, document.getElementById('cantidad-${producto.id_ropa}').value)">
                                Agregar al carrito
                            </button>
                        </div>
                    </div>
                `).join('');
                crearPaginacion(data.length);
            }
        })
        .catch(error => {
            console.error('Error al obtener productos:', error);
            document.getElementById('productos').innerHTML = `<p>Error al cargar los productos. Inténtalo más tarde.</p>`;
        });
}


        function crearPaginacion(totalProductos) {
            const paginacion = document.getElementById('paginacion');
            const totalPaginas = Math.ceil(totalProductos / productosPorPagina);

            let paginasHTML = '';
            for (let i = 1; i <= totalPaginas; i++) {
                paginasHTML += `<a href="#" class="${i === paginaActual ? 'active' : ''}" onclick="irAPagina(${i})">${i}</a>`;
            }
            paginacion.innerHTML = paginasHTML;
        }

        function irAPagina(pagina) {
            paginaActual = pagina;
            cargarProductos();
        }

        cargarProductos();

        let carrito = []; // Array para manejar el contenido del carrito en la sesión actual.

        // Función para agregar productos al carrito
        function agregarAlCarrito(id_ropa, nombre, precio, cantidad) {
    cantidad = parseInt(cantidad);
    if (cantidad <= 0) {
        mostrarPopUp('La cantidad debe ser mayor a 0.', true);
        return;
    }

    // Datos a enviar al servidor, incluyendo el id_ropa
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
        } else {
            mostrarPopUp('Error al agregar el producto al carrito.', true);
        }
        actualizarTablaCarrito();
    })
    .catch(error => {
        console.error('Error al agregar al carrito:', error);
        mostrarPopUp('Error al procesar la solicitud.', true);
    });
}

        // Función para mostrar el carrito en la tabla
        function actualizarTablaCarrito() {
    fetch('controlerCarrito.php?action=mostrar')
        .then(response => response.json())
        .then(data => {
            carrito = data;
            const tablaCarrito = document.getElementById('contenido-carrito');
            const totalCarrito = document.getElementById('total-carrito');
            const btnComprar = document.getElementById('btn-comprar');
            
            // Si el carrito está vacío
            if (carrito.length === 0) {
                tablaCarrito.innerHTML = '<tr><td colspan="5">El carrito está vacío.</td></tr>';
                totalCarrito.innerHTML = '<strong>Total: S/ 0.00</strong>';
                btnComprar.style.display = 'none'; // Ocultar el botón de compra
                return;
            }

            let total = 0; // Acumulador para el total de los subtotales

            // Llenar la tabla con los productos y calcular los subtotales
            tablaCarrito.innerHTML = carrito.map((producto, index) => {
                const subtotal = producto.precio * producto.cantidad; // Calcular el subtotal
                total += subtotal; // Sumar al total
                return `
                    <tr>
                        <td>${producto.nombre}</td>
                        <td>S/${producto.precio.toFixed(2)}</td>
                        <td>${producto.cantidad}</td>
                        <td>S/${subtotal.toFixed(2)}</td> <!-- Mostrar subtotal -->
                        <td>
                            <button onclick="eliminarProducto(${index})">Eliminar</button>
                        </td>
                    </tr>
                `;
            }).join('');

            // Mostrar el total de los subtotales
            totalCarrito.innerHTML = `<strong>Total: S/${total.toFixed(2)}</strong>`;

            // Mostrar el botón de compra si el carrito tiene productos
            btnComprar.style.display = 'block';
        })
        .catch(error => {
            console.error('Error al obtener el carrito:', error);
        });
}

// Función para eliminar un producto del carrito
function eliminarProducto(indice) {
    const idProducto = carrito[indice].nombre; // Usamos el nombre como identificador
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

// Función para vaciar el carrito
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

// Mostrar el modal del carrito
document.getElementById('abrir-carrito').addEventListener('click', function(event) {
    event.preventDefault();
    actualizarTablaCarrito(); // Cargar los productos y mostrar el total
    document.getElementById('modal-carrito').style.display = 'block';
});

// Cerrar el modal
document.querySelector('.close-btn').addEventListener('click', function() {
    document.getElementById('modal-carrito').style.display = 'none';
});
        function mostrarPopUp(mensaje, error = false) {
    const popUp = document.getElementById('popUp');
    
    // Establecer el texto del pop-up
    popUp.innerText = mensaje;
    
    // Si es un error, agregar la clase 'error' para cambiar el color
    if (error) {
        popUp.classList.add('error');
    } else {
        popUp.classList.remove('error');
    }

    // Mostrar el pop-up
    popUp.style.display = 'block'; 

    // Después de 3 segundos, ocultar el pop-up
    setTimeout(() => {
        popUp.style.display = 'none';
    }, 3000); // Cambiar tiempo si necesitas mostrar más o menos tiempo
}

document.getElementById('btn-comprar').addEventListener('click', function() {
    fetch('controlerCarrito.php?action=comprar', {
        method: 'POST',
    })
        .then(response => response.json())
        .then(data => {
            mostrarPopUp(data.message, !data.success);
            if (data.success) {
                actualizarTablaCarrito(); // Actualizar el carrito (vaciarlo)
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
