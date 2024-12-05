<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Iniciar Sesion</title>
    <link rel="stylesheet" href="iniciarsesion.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Concert+One&family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Concert+One&family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Roboto+Slab:wght@100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .error {
            border: 2px solid red !important;
        }

        .mensaje-error {
            color: white;
            background-color: red;
            padding: 5px;
            font-size: 14px;
            margin-top: 5px;
            border-radius: 5px;
            display: none;
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
            <form id="formLogin" action="controler_IniciarSesion.php" method="POST">
                <fieldset>
                    <h2>Iniciar Sesion</h2>
                    <p>EMAIL: </p>
                    <div class="tamañobarras">
                        <input type="email" placeholder="ejemplo.gmail.com" id="correo" name="correo">
                        <div id="correo-error" class="mensaje-error"></div>
                    </div>

                    <p>CONTRASEÑA:</p> 
                    <div class="tamañobarras">
                        <input type="password" placeholder="************" id="contraseña" name="contraseña">
                        <div id="contraseña-error" class="mensaje-error"></div>
                    </div>

                    <div>
                        <a class="olvidado" href="#"><span>¿Olvidaste tu Contraseña?</span></a>
                    </div>
                    <div class="tamañoboton">
                        <button type="submit" class="IniciarSesion" id="IniciarSesion" name="btnIniciarSesion">Iniciar Sesion</button>
                    </div><br>

                    <div class="registrate">
                        <h5>¿Todavía no tienes una cuenta? <a href="NuevoUsuario.php"> <span>¡Regístrate!</span></a></h5>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>

    <script>
        
        document.getElementById("formLogin").addEventListener("submit", function (e) {
            
            let correo = document.getElementById("correo").value;
            let contraseña = document.getElementById("contraseña").value;
            let expletras = /^[a-zA-Zñ\sáéíóúÁÉÍÓÚ]{3,30}$/;
            let expcorreo = /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/;

            document.getElementById("correo-error").style.display = "none";
            document.getElementById("contraseña-error").style.display = "none";
            document.getElementById("correo").classList.remove("error");
            document.getElementById("contraseña").classList.remove("error");

            let error = false; 

            if (correo == "") {
                document.getElementById("correo-error").innerText = "Debe proporcionar un correo electrónico";
                document.getElementById("correo-error").style.display = "block";
                document.getElementById("correo").classList.add("error");
                error = true;
            } else if (!expcorreo.test(correo)) {
                document.getElementById("correo-error").innerText = "Ingrese un correo válido";
                document.getElementById("correo-error").style.display = "block";
                document.getElementById("correo").classList.add("error");
                error = true;
            }

            if (contraseña == "") {
                document.getElementById("contraseña-error").innerText = "Debe ingresar una contraseña";
                document.getElementById("contraseña-error").style.display = "block";
                document.getElementById("contraseña").classList.add("error");
                error = true;
            }

            if (error) {
                e.preventDefault();
            }
        })
    </script>

    <div class="footer-container">
        <footer>
            <p>&copy; 2024 BM.com - Todos los derechos reservados.</p>
        </footer>
    </div>

</body>
</html>
