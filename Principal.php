

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
    <title>Inicio</title>




</head>
<script src="carrito.js"></script>

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

    <div class="slider-box">
        <ul>
            <li>
                <img src="img/inicio1.jpg" alt="">
                <div class="texto">
                    <h1>ENCUENTRA LO QUE BUSCAS</h1>
                    <h3>MANTENTE EN LA MODE CON PRECIOS SUPER ACCESIBLE CON ROPA DE BUENA CALIDAD</h3>
                </div>
            </li>
            <li>
                <img src="img/inicio2.jpg" alt="">
                <div class="texto">
                    <h1>ENCUENTRA LO QUE BUSCAS</h1>
                    <h3>MANTENTE EN LA MODE CON PRECIOS SUPER ACCESIBLE CON ROPA DE BUENA CALIDAD</h3>
                </div>
            </li>
            <li>
                <img src="img/inicio3.jpg" alt="">
                <div class="texto">
                    <h1>ENCUENTRA LO QUE BUSCAS</h1>
                    <h3>MANTENTE EN LA MODE CON PRECIOS SUPER ACCESIBLE CON ROPA DE BUENA CALIDAD</h3>
                </div>
            </li>
            <li>
                <img src="img/inicio4.jpg" alt="">
                <div class="texto">
                    <h1>ENCUENTRA LO QUE BUSCAS</h1>
                    <h3>MANTENTE EN LA MODE CON PRECIOS SUPER ACCESIBLE CON ROPA DE BUENA CALIDAD</h3>
                </div>
            </li>
        </ul>

    </div>


    <main>
    <div class="portada">
        <img src="img/friday.png" alt="">
    </div>


        <div class="ofertas-mes">
            <h1>OFERTAS CON 30% DE DESCUENTO</h1>
        </div>

            <!-- OFERTAS MUJERES Y NIÑAS -->

        <div class="mujeres-niñas">
            <h1>Mujeres:</h1>
        </div>


        <div class="grid-container">
            <!-- Película 1: La Vida es Bella -->

            <section id="Polera" class="grid-item">
                <h2>Polera</h2>
                <img src="img/polera-mujer.png" alt="Imagen descriptiva de la polera">
                 <h1>S/100.00</h1>
                
                <p><strong>Material:</strong> Es de algodón Pima, es lavable estampado con alto relieve.</p>
            </section>

            <!-- Pantalón de mujer ............ -->
            <section id="Pantalón" class="grid-item">
            <h2>Pantalones</h2>
                <img src="img/pantalon-mujer.png" alt="Imagen descriptiva de la polera">
                 <h1>S/120.00</h1>

                <p><strong>Material:</strong> Es de algodón Pima, es lavable estampado con alto relieve.</p>
            </section>

            <!-- Polo: ......... -->
            <section id="polo" class="grid-item">
            <h2>Polos</h2>
                <img src="img/polo-mujer.png" alt="Imagen descriptiva de la polera">
                 <h1>S/50.00</h1>
                
                <p><strong>Material:</strong> Es de algodón Pima, es lavable estampado con alto relieve.</p>             
            </section>
        </div>
        <div class="portada">
            <img src="img/fridayhombres.png" alt="">
        </div>
        

        <div class="hombres-niños">
            <h1>Hombres:</h1>
        </div>


        <div class="grid-container">
            <section id="polera" class="grid-item">
            <h2>Polera</h2>
                <img src="img/polera-hombre.png" alt="Imagen descriptiva de la polera">
                 <h1>S/50.00</h1>
                 <div class="carrito" id="polerahombre1">
                <p><strong>Material:</strong> Es de algodón Pima, es lavable estampado con alto relieve.</p>

            </section>

            <!-- Pantalón: ............ -->
            <section id="pantalon" class="grid-item">
            <h2>Pantalon</h2>
                <img src="img/pantalon-hombre.png" alt="Imagen descriptiva de la polera">
                 <h1>S/50.00</h1>
                
                <p><strong>Material:</strong> Es de algodón Pima, es lavable estampado con alto relieve.</p>

                
            </section>
            <!-- Polo: ......... -->
            <section id="polos" class="grid-item">
            <h2>Polos</h2>
                <img src="img/polo-hombr.png" alt="Imagen descriptiva de la polera">
                 <h1>S/50.00</h1>
                 
                <p><strong>Material:</strong> Es de algodón Pima, es lavable estampado con alto relieve.</p>

                
            </section>
        </div>


           

        </div>
    </main>
    <footer>
        <p>© 2024 Mi Sitio. Todos los derechos reservados.</p>
    </footer>

    <script type="text/javascript">
  (function(d, t) {
      var v = d.createElement(t), s = d.getElementsByTagName(t)[0];
      v.onload = function() {
        window.voiceflow.chat.load({
          verify: { projectID: '6738da830038a670b485648d' },
          url: 'https://general-runtime.voiceflow.com',
          versionID: 'production'
        });
      }
      v.src = "https://cdn.voiceflow.com/widget/bundle.mjs"; v.type = "text/javascript"; s.parentNode.insertBefore(v, s);
  })(document, 'script');
</script>
</body>

</html>