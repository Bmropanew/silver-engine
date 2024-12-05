<!-- modalCarrito.php -->

<!-- Modal del Carrito -->
<div id="modal-carrito" class="modal">
    <div class="modal-content">
        <span class="close-btn">&times;</span>
        <h2>Carrito de Compras</h2>
        <div id="contenido-carrito">
            <!-- Aquí se mostrará el contenido del carrito -->
        </div>
        <button id="btn-vaciar-carrito">Vaciar Carrito</button>
    </div>
</div>

<!-- Estilos para el Modal -->
<style>
    /* Estilo del Modal */
    .modal {
        display: none; /* El modal estará oculto por defecto */
        position: fixed;
        z-index: 1; /* Se asegura que el modal esté por encima de otros elementos */
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.4); /* Fondo oscuro con opacidad */
        padding-top: 60px;
    }

    .modal-content {
        background-color: white;
        margin: 5% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
        max-width: 500px;
        position: relative;
        border-radius: 8px;
    }

    .close-btn {
        color: #aaa;
        font-size: 28px;
        font-weight: bold;
        position: absolute;
        top: 10px;
        right: 20px;
        cursor: pointer;
    }

    .close-btn:hover,
    .close-btn:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }

    /* Estilo del contenido del carrito */
    #contenido-carrito {
        max-height: 300px;
        overflow-y: auto;
    }

    button {
        padding: 10px 15px;
        background-color: #ff6347;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    button:hover {
        background-color: #ff4500;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
      
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('modal') && urlParams.get('modal') === 'carrito') {
        
            const modal = document.getElementById('modal-carrito');
            modal.style.display = "block";

            fetch('controlerCarrito.php?action=mostrar')
                .then(response => response.text())
                .then(data => {
                    document.getElementById('contenido-carrito').innerHTML = data;
                })
                .catch(error => {
                    console.error("Error al cargar el carrito:", error);
                    document.getElementById('contenido-carrito').innerHTML = "<p>Error al cargar el carrito. Intenta más tarde.</p>";
                });
        }

        const closeBtn = document.querySelector('.close-btn');
        closeBtn.addEventListener('click', function() {
            const modal = document.getElementById('modal-carrito');
            modal.style.display = "none";
        });

        window.addEventListener('click', function(event) {
            const modal = document.getElementById('modal-carrito');
            if (event.target === modal) {
                modal.style.display = "none";
            }
        });

        const btnVaciarCarrito = document.getElementById('btn-vaciar-carrito');
        if (btnVaciarCarrito) {
            btnVaciarCarrito.addEventListener('click', function() {
                fetch('controlerCarrito.php?action=vaciar')
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            document.getElementById('contenido-carrito').innerHTML = "<p>El carrito ha sido vaciado.</p>";
                        }
                    })
                    .catch(error => {
                        console.error("Error al vaciar el carrito:", error);
                    });
            });
        }
    });
</script>
