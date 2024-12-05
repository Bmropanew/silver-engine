<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Registrate</title>
    <link rel="stylesheet" href="nuevousuario.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Concert+One&family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Roboto+Slab:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Estilo para las advertencias */
        .advertencia {
            color: white; /* Cambiar color a blanco */
            font-size: 12px;
            margin-top: 5px;
            white-space: nowrap; /* Evita que el texto se rompa en varias líneas */
        }
    </style>
</head>

<body>
    <header>
        <div class="logo">
            <img src="img/el_logo_BM.jpg" alt="Logo">                    
        </div>
        <nav>
            <ul>         
                <li><a href="Principal.php"><i class="fas fa-home"></i> Inicio</a></li>
                <li><a href="Nosotros.php"><i class="fas fa-user"></i> Nosotros</a></li>
                <li><a href="Contactanos.php"><i class="fas fa-envelope"></i>Contactanos</a></li>
            </ul>
        </nav>
    </header>
    <div id="contenedor2">
        <div class="formulario">
            <form id="form-registro">
                <fieldset>
                    <h2>Crear Cuenta</h2>

                    <p>Nombre </p>
                    <div class="tamañobarras">
                        <input type="text" placeholder="nombre" id="nombre" name="nombre">
                        <div id="nombre-advertencia" class="advertencia"></div>
                    </div>

                    <p>Apellidos </p>
                    <div class="tamañobarras">
                        <input type="text" placeholder="apellido" id="apellido" name="apellido">
                        <div id="apellido-advertencia" class="advertencia"></div>
                    </div>

                    <p>correo electronico:</p>
                    <div class="tamañobarras">
                        <input type="email" placeholder="ejemplo@gmail.com" id="correo" name="correo">
                        <div id="correo-advertencia" class="advertencia"></div>
                    </div>

                    <p>Numero de telefono movil</p>
                    <div class="tamañobarras">
                        <input type="text" placeholder="123456789" id="telefono" name="telefono">
                        <div id="telefono-advertencia" class="advertencia"></div>
                    </div>

                    <p>Direccion de envio</p>
                    <div class="tamañobarras">
                        <input type="text" placeholder="ejemplo: 7042 Av. Universitaria Comas, Provincia de Lima" id="direccion" name="direccion">
                        <div id="direccion-advertencia" class="advertencia"></div>
                    </div>

                    <p>Fecha de nacimiento</p>
                    <div class="tamañobarras">
                        <input type="date" placeholder="dia del mes del año" id="fecha_nacimiento" name="fecha_nacimiento">
                        <div id="fecha_nacimiento-advertencia" class="advertencia"></div>
                    </div>

                    <p>Genero</p>
                    <div class="tamañoselect">
                        <select name="genero" id="genero">
                            <option value="seleccionar">seleccionar</option>
                            <option value="hombre">hombre</option>
                            <option value="mujer">mujer</option>
                            <option value="nd">prefiero no decirlo</option>
                        </select>
                        <div id="genero-advertencia" class="advertencia"></div>
                    </div>

                    <p>Contraseña:</p>
                    <div class="tamañobarras">
                        <input type="password" placeholder="Contraseña" id="contraseña" name="contraseña">
                        <div id="contraseña-advertencia" class="advertencia"></div>
                    </div>

                    <div class="tamañoboton">
                        <button type="button" class="registrar" id="boton_registrar">Registrar</button>
                    </div><br>

                    <div class="texto-blanco">
                        <input class="aceptar" type="checkbox" id="politica"> Al crear una cuenta, aceptas las 
                        <a href="#"> 
                            <span>Condiciones de Uso</span>
                        </a> y el <a href="#">
                            <span>Aviso de Privacidad</span>
                        </a> de BM.com<br>
                    </div>

                    <p class="texto-pequeño">Ya tienes una cuenta en nuestra pagina?, entonces <a href="IniciarSesion.php"> 
                    <span>Inicia Sesion</span></a></p>

                </fieldset>
            </form>
        </div>
    </div>

    <div class="footer-container">
        <footer>
            <p>&copy; 2024 BM.com - Todos los derechos reservados.</p>
        </footer>
    </div>

    <script>
        document.getElementById("boton_registrar").addEventListener("click", function (event) {
            event.preventDefault();

            let nom = document.getElementById("nombre").value;
            let ape = document.getElementById("apellido").value;
            let corre = document.getElementById("correo").value;
            let fono = document.getElementById("telefono").value;
            let direc = document.getElementById("direccion").value;
            let naci = document.getElementById("fecha_nacimiento").value;
            let gene = document.getElementById("genero").value;
            let contra = document.getElementById("contraseña").value;
            let poli = document.getElementById("politica").checked;

            let expletras = /^[a-zA-Zñ\sáéíóúÁÉÍÓÚ]{3,30}$/;
            let exptelefono = /^[0-9]{9}$/;
            let expdireccion = /^[a-zA-Zñ\sáéíóúÁÉÍÓÚ0-9,.-]{10,100}$/;
            let expcontraseña = /^(?=.*\d)(?=.*[a-z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,15}$/;
            let expcorreo = /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/;

            // Limpiar mensajes previos
            document.querySelectorAll('.advertencia').forEach(function(advertencia) {
                advertencia.innerHTML = '';
            });

            let error = false;

            //validación de nombre
            if (nom == "") {
                document.getElementById("nombre-advertencia").innerHTML = "Debe proporcionar un nombre";
                error = true;
            } else if (!expletras.test(nom)) {
                document.getElementById("nombre-advertencia").innerHTML = "Ingrese valores reales en el campo nombre";
                error = true;
            }

            //validación de apellido
            if (ape == "") {
                document.getElementById("apellido-advertencia").innerHTML = "Debe proporcionar un apellido";
                error = true;
            } else if (!expletras.test(ape)) {
                document.getElementById("apellido-advertencia").innerHTML = "Ingrese valores reales en el campo apellido";
                error = true;
            }

            //validación de correo
            if (corre == "") {
                document.getElementById("correo-advertencia").innerHTML = "Debe proporcionar un correo electrónico";
                error = true;
            } else if (!expcorreo.test(corre)) {
                document.getElementById("correo-advertencia").innerHTML = "Ingrese un correo electrónico válido";
                error = true;
            }

            //validación de teléfono
            if (fono == "") {
                document.getElementById("telefono-advertencia").innerHTML = "Debe proporcionar un número de teléfono";
                error = true;
            } else if (!exptelefono.test(fono)) {
                document.getElementById("telefono-advertencia").innerHTML = "Ingrese un teléfono válido";
                error = true;
            }

            //validación de dirección
            if (direc == "") {
                document.getElementById("direccion-advertencia").innerHTML = "Debe proporcionar una dirección";
                error = true;
            } else if (!expdireccion.test(direc)) {
                document.getElementById("direccion-advertencia").innerHTML = "Ingrese una dirección válida";
                error = true;
            }

            //validación de fecha de nacimiento
            if (naci == "") {
                document.getElementById("fecha_nacimiento-advertencia").innerHTML = "Debe proporcionar una fecha de nacimiento";
                error = true;
            }

            //validación de género
            if (gene == "seleccionar") {
                document.getElementById("genero-advertencia").innerHTML = "Debe seleccionar un género";
                error = true;
            }

            //validación de contraseña
            if (contra == "") {
                document.getElementById("contraseña-advertencia").innerHTML = "Debe proporcionar una contraseña";
                error = true;
            } else if (!expcontraseña.test(contra)) {
                document.getElementById("contraseña-advertencia").innerHTML = "La contraseña debe tener al menos 8 caracteres, incluyendo un número y un carácter especial.";
                error = true;
            }

            //validación de aceptación de política
            if (!poli) {
                alert("Debe aceptar las políticas de privacidad");
                error = true;
            }

            if (!error) {
                fetch('newUsuario.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        nombre: nom,
                        apellido: ape,
                        correo: corre,
                        telefono: fono,
                        direccion: direc,
                        fecha_nacimiento: naci,
                        genero: gene,
                        contraseña: contra
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        window.location.href = data.redirect;
                    } else {
                        document.getElementById("correo-advertencia").innerHTML = data.message;
                    }
                })
                .catch(error => {
                    console.error('Error en el registro:', error);
                });
            }
        });
    </script>
</body>

</html>
