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
    <title>Enviar Correo</title>
    <style>
       
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .modal-content {
            background: white;
            padding: 20px;
            border-radius: 10px;
            max-width: 600px;
            width: 90%;
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-header h2 {
            margin: 0;
        }

        .modal-footer {
            display: flex;
            justify-content: space-between;
        }

        .close-btn,
        .accept-btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .close-btn {
            background-color: #dc3545;
            color: white;
        }

        .accept-btn {
            background-color: #28a745;
            color: white;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th,
        table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        table th {
            background-color: #f4f4f4;
        }

        table td input[type="checkbox"] {
            display: block;
            margin: 0 auto;
        }
        nav ul {
            list-style: none;
            padding: 0;
            display: flex;
            background-color: #333;
        }

        nav ul li {
            margin: 0 15px;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
            padding: 10px;
            display: block;
        }

        nav ul li a:hover {
            background-color: #575757;
        }

        form {
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 10px;
            max-width: 600px;
            margin: 20px auto;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .form-label {
            display: block;
            font-weight: bold;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
            margin-bottom: 15px;
        }

        .btn {
            background-color: #28a745;
            color: white;
            font-weight: bold;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn i {
            margin-right: 8px;
        }

        .mensaje {
            margin: 20px auto;
            padding: 10px;
            border-radius: 5px;
            font-size: 16px;
            text-align: center;
            width: 80%;
            max-width: 600px;
        }

        .mensaje.exito {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .mensaje.error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        .form-label {
    color: black;
  }
  table th,
table td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
    color: black;
}

table th {
    background-color: #f4f4f4;
}

table td {
    background-color: white; 
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

    <main>
        <div id="mensaje"></div>

        <button id="openModal" class="btn">Seleccionar Usuarios</button>

        <div id="userModal" class="modal">
            <div class="modal-content">
                <div class="modal-header">
                    <h2>Seleccionar Usuarios</h2>
                    <button id="closeModal" class="close-btn">Cerrar</button>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Correo</th>
                            <th>Seleccionar</th>
                        </tr>
                    </thead>
                    <tbody id="tablaUsuarios"></tbody>
                </table>
                <div class="modal-footer">
                    <button id="acceptModal" class="accept-btn">Aceptar</button>
                </div>
            </div>
        </div>

        <form id="formCorreo" enctype="multipart/form-data">
            <div>
                <label class="form-label" for="destinatario">Destinatario</label>
                <input type="text" class="form-control" name="destinatario" id="destinatario" placeholder="Ejemplo@gmail.com" required>
            </div>
            <div>
                <label class="form-label" for="asunto">Asunto del correo</label>
                <input type="text" class="form-control" name="asunto" id="asunto" placeholder="El asunto del correo electrónico" required>
            </div>
            <div>
                <label class="form-label" for="contenido">Mensaje</label>
                <textarea class="form-control" name="contenido" id="contenido" rows="5" placeholder="Escribe aquí..." required></textarea>
            </div>
            <div>
                <label class="form-label" for="archivo">Adjuntar archivo</label>
                <input type="file" class="form-control" name="archivo" id="archivo">
            </div>
            <button class="btn" type="submit">
                <i class="fas fa-paper-plane"></i> Enviar correo
            </button>
        </form>
    </main>

    <footer>
        <p>© 2024 Mi Sitio. Todos los derechos reservados.</p>
    </footer>

    <script>
        const modal = document.getElementById('userModal');
        const openModalBtn = document.getElementById('openModal');
        const closeModalBtn = document.getElementById('closeModal');
        const acceptModalBtn = document.getElementById('acceptModal');
        const tablaUsuarios = document.getElementById('tablaUsuarios');

        openModalBtn.addEventListener('click', () => {modal.style.display = 'flex';
    
        const checkboxes = document.querySelectorAll('input[type="checkbox"]');
    checkboxes.forEach(checkbox => {
        checkbox.checked = false;
    });
    });
        closeModalBtn.addEventListener('click', () => modal.style.display = 'none');
        acceptModalBtn.addEventListener('click', () => modal.style.display = 'none');

        fetch('controlerCorreo.php?action=getUsers')
            .then(response => response.json())
            .then(data => {
                tablaUsuarios.innerHTML = data.map(user => `
                    <tr>
                        <td>${user.id_usuario}</td>
                        <td>${user.nombre}</td>
                        <td>${user.apellidos}</td>
                        <td>${user.correo}</td>
                        <td>
                    <input type="checkbox" data-id="${user.id_usuario}" data-email="${user.correo}">
                        </td>
                    </tr>
                `).join('');
            });


            document.getElementById('formCorreo').addEventListener('submit', function (e) {
    e.preventDefault();

    const mensajeDiv = document.getElementById('mensaje');
    const formData = new FormData(this);

    fetch('controlerCorreo.php', {
        method: 'POST',
        body: formData
    })
        .then((response) => response.text())
        .then((data) => {
            if (data.includes('Correo enviado con éxito')) {
                mensajeDiv.innerHTML = `<div class="mensaje exito">${data}</div>`;
                document.getElementById('formCorreo').reset(); 
            } else {
                mensajeDiv.innerHTML = `<div class="mensaje error">${data}</div>`;
            }
        })
        .catch((error) => {
            mensajeDiv.innerHTML = `<div class="mensaje error">Error al procesar la solicitud.</div>`;
        });
});

    acceptModalBtn.addEventListener('click', () => {
    const selectedCheckboxes = document.querySelectorAll('input[type="checkbox"]:checked');
    const emails = [];
    selectedCheckboxes.forEach(checkbox => {
        const email = checkbox.getAttribute('data-email');
        emails.push(email);  
    });
    const destinatariosFinal = emails.join(', ').trim();  
    document.getElementById('destinatario').value = destinatariosFinal;   
    modal.style.display = 'none';
});


    </script>
</body>

</html>
