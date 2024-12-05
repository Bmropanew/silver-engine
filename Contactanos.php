<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Hombreinvierno">
    <title>Contactanos</title>
    <link rel="stylesheet" href="contactanos.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Abel&family=Concert+One&family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Dosis:wght@200..800&family=Edu+AU+VIC+WA+NT+Pre:wght@400..700&family=Italianno&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Roboto+Slab:wght@100..900&display=swap" rel="stylesheet">
    
</head>
<body>
    
        <header>
                <div class="logo">
                    <img src="img/el_logo_BM.jpg" alt="Logo">                    
                </div>
        </header>
    <nav>
        <ul>
            
            <li><a href="Principal.php"><i class="fas fa-home"></i> Inicio</a></li>
            <li><a href="Nosotros.php"><i class="fas fa-user"></i> Nosotros</a></li>

        </ul>
    </nav>
        </header>

    <section class="tit-drama">
        <h1>Contactanos para solucionar inconvenientes</h1>
        <div class="pag-te">
            <p> Somos una empresa que piensa en la buena experiencia que nuestros
                clientes deben de tener, por ellos no dudes en comunicarte.</p>
        </div>
    </section>
        <section class="contacto">   
            <div class="texto-ayuda">
                <h2>Aquí estamos para poder ayudarte</h2>
               <strong> <p>En BM IMPORTACIONES DE ROPA, estamos aquí para ayudarte en lo que necesites. Contamos con múltiples canales de atención, como chat en vivo, correo electrónico y teléfono, para que puedas comunicarte con nosotros de la manera que te resulte más conveniente. Nuestro equipo está listo para responder tus preguntas y ofrecerte el soporte que mereces. Tu satisfacción es nuestra prioridad, ¡no dudes en contactarnos!
             
                <br><BR></BR>
                 ENVIAMOS TU PROBLEMA MEDIENTE EL SIGUIENTE FORMULARIO:</p>  </strong> 
            </div>
                <div class="formulario-container">
                    <form>
                        <h2>Formulario de Contacto</h2>
                        <label for="nombre">Nombre:</label>
                        <input type="text" id="nombre" name="nombre" required>
        
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" required>
        
                        <label for="mensaje">Mensaje:</label>
                        <textarea id="mensaje" name="mensaje" required></textarea>
        
                        <label for="tipoConsulta">Tipo de consulta:</label>
                        <select id="tipoConsulta" name="tipoConsulta">
                            <option value="consultaGeneral">Consulta General</option>
                            <option value="comentarios">Comentarios</option>
                            <option value="sugerencias">Sugerencias</option>
                        </select>
                        <button type="submit">Enviar</button>
                    </form>
                </div>
        </section>
    </main>

    <footer>
        <p>&copy; Joselyn Brigitte Montoya Cabrera </p>
    </footer>
</body>
</html>
