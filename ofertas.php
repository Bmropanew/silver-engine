<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Hombreinvierno">
    <title>Contactanos</title>
    <link rel="stylesheet" href="ofertas.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- fuentes-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    
</head>

<script src="carrito.js"></script>
<body>
    
        <header>
            
                <div class="logo">
                    <img src="img/el_logo_BM.jpg
                    " alt="Logo">                    
                </div>
          
        </header>


    <nav>
        <ul>
            
            <li><a href="Principal.php"><i class="fas fa-home"></i> Inicio</a></li>
            <li><a href="Contactanos.php"><i class="fas fa-envelope"></i>Contactanos</a></li>
            <li><a href="Nosotros.php"><i class="fas fa-user"></i> Nosotros</a></li>
            <li><a href="javascript:void(0);" onclick="mostrarCarrito()"><i class="fas fa-shopping-cart"></i> Carrito</a></li>            

        </ul>
        

    </nav>
    <div class="slider-box">
        <ul>
            <li>
                <img src="img/ofertas.jpg" alt="">
                <div class="texto">
                    <h1>LA ROPA ES ARTE</h1>
                    <P>PORQUE SABER VESTIRSE BIEN ES PARTE DE TU PERSONALIDAD</P>
                </div>
            </li>
            <li>
                <img src="img/carrusel1.jpg" alt="">
                <div class="texto">
                    <h1>LA ROPA ES ARTE</h1>
                    <P>PORQUE SABER VESTIRSE BIEN ES PARTE DE TU PERSONALIDAD</P>
                </div>
            </li>
            <li>
                <img src="img/carrusel2.jpg" alt="">
                <div class="texto">
                    <h1>LA ROPA ES ARTE</h1>
                    <P>PORQUE SABER VESTIRSE BIEN ES PARTE DE TU PERSONALIDAD</P>
                </div>
            </li>
            <li>
                <img src="img/carrusel3.jpg" alt="">
                <div class="texto">
                    <h1>LA ROPA ES ARTE</h1>
                    <P>PORQUE SABER VESTIRSE BIEN ES PARTE DE TU PERSONALIDAD</P>
                </div>
            </li>
        </ul>

    </div>
    


    <main>




       

        <div class="ofertas-mes">
            <h1>OFERTAS DEL MES</h1>
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
                 <div class="carrito" id="poleramujer1">
                     <label for="cantidad-poleramujer1">Cantidad:</label>
                     <input type="number" class="cantidad-polera" id="cantidad-poleramujer1" min="1" value="1">
                    <button onclick="agregarAlCarrito('Polera Mujer Rosada', 100, document.getElementById('cantidad-poleramujer1').value)">Agregar al carrito</button>
                </div>
                <p><strong>Material:</strong> Es de algodón Pima, es lavable estampado con alto relieve.</p>

                <h2>Polera</h2>
                <img src="img/polera2-mujer.png" alt="Imagen descriptiva de la polera">
                 <h1>S/90.00</h1>
                 <div class="carrito" id="poleramujer2">
                    <label for="cantidad-poleramujer2">Cantidad:</label>
                    <input type="number" class="cantidad-polera" id="cantidad-poleramujer2" min="1" value="1">
                    <button onclick="agregarAlCarrito('Polera Mujer Nirvana', 90, document.getElementById('cantidad-poleramujer2').value)">Agregar al carrito</button>
                </div>
            </section>

            <!-- Pantalón de mujer ............ -->
            <section id="Pantalón" class="grid-item">
            <h2>Pantalones</h2>
                <img src="img/pantalon-mujer.png" alt="Imagen descriptiva de la polera">
                 <h1>S/120.00</h1>
                 <div class="carrito" id="pantalonmujer1">
                     <label for="cantidad-pantalonmujer1">Cantidad:</label>
                     <input type="number" class="cantidad-polera" id="cantidad-pantalonmujer1" min="1" value="1">
                    <button onclick="agregarAlCarrito('Jeans celeste', 100, document.getElementById('cantidad-pantalonmujer1').value)">Agregar al carrito</button>
                </div>
                <p><strong>Material:</strong> Es de algodón Pima, es lavable estampado con alto relieve.</p>

                <h2>Pantalones</h2>
                <img src="img/pantalon2-mujer.png" alt="Imagen descriptiva de la polera">
                 <h1>S/100.00</h1>
                 <div class="carrito" id="pantalonmujer2">
                    <label for="cantidad-pantalonmujer2">Cantidad:</label>
                    <input type="number" class="cantidad-polera" id="cantidad-pantalonmujer2" min="1" value="1">
                    <button onclick="agregarAlCarrito('Jeans skinny', 90, document.getElementById('cantidad-pantalonmujer2').value)">Agregar al carrito</button>
                </div>
            </section>

            <!-- Polo: ......... -->
            <section id="polo" class="grid-item">
            <h2>Polos</h2>
                <img src="img/polo-mujer.png" alt="Imagen descriptiva de la polera">
                 <h1>S/50.00</h1>
                 <div class="carrito" id="polomujer1">
                     <label for="cantidad-polomujer1">Cantidad:</label>
                     <input type="number" class="cantidad-polera" id="cantidad-polomujer1" min="1" value="1">
                    <button onclick="agregarAlCarrito('Polo rosado', 100, document.getElementById('cantidad-polomujer1').value)">Agregar al carrito</button>
                </div>
                <p><strong>Material:</strong> Es de algodón Pima, es lavable estampado con alto relieve.</p>

                <h2>Polos</h2>
                <img src="img/polo2-mujer.png" alt="Imagen descriptiva de la polera">
                 <h1>S/60.00</h1>
                 <div class="carrito" id="polomujer2">
                    <label for="cantidad-polomujer2">Cantidad:</label>
                    <input type="number" class="cantidad-polera" id="cantidad-polomujer2" min="1" value="1">
                    <button onclick="agregarAlCarrito('Polo negro PUMP', 90, document.getElementById('cantidad-polomujer2').value)">Agregar al carrito</button>
                </div>
            </section>
        </div>

        <div class="mujeres-niñas">
            <h1> Niñas:</h1>
        </div>


        <div class="grid-container">
            <!-- Película 1: La Vida es Bella -->
            <section id="polera" class="grid-item">
            <h2>Poleras</h2>
                <img src="img/polera-niña.png" alt="Imagen descriptiva de la polera">
                 <h1>S/50.00</h1>
                 <div class="carrito" id="poleraniña1">
                     <label for="cantidad-poleraniña1">Cantidad:</label>
                     <input type="number" class="cantidad-polera" id="cantidad-poleraniña1" min="1" value="1">
                    <button onclick="agregarAlCarrito('Polera rosada de niña', 100, document.getElementById('cantidad-poleraniña1').value)">Agregar al carrito</button>
                </div>
                <p><strong>Material:</strong> Es de algodón Pima, es lavable estampado con alto relieve.</p>

                <h2>Poleras</h2>
                <img src="img/polera2-niña.png" alt="Imagen descriptiva de la polera">
                 <h1>S/60.00</h1>
                 <div class="carrito" id="poleranniña2">
                    <label for="cantidad-poleraniña2">Cantidad:</label>
                    <input type="number" class="cantidad-polera" id="cantidad-poleraniña2" min="1" value="1">
                    <button onclick="agregarAlCarrito('Polera de niña morada', 90, document.getElementById('cantidad-poleraniña2').value)">Agregar al carrito</button>
                </div>
            </section>


            <!-- Polo: ......... -->
            <section id="pantalon" class="grid-item">
            <h2>pantalon</h2>
                <img src="img/pantalon-niña.png" alt="Imagen descriptiva de la polera">
                 <h1>S/50.00</h1>
                 <div class="carrito" id="pantalonniña1">
                     <label for="cantidad-pantalonniña1">Cantidad:</label>
                     <input type="number"  class="cantidad-polera" id="cantidad-pantalonniña1" min="1" value="1">
                    <button onclick="agregarAlCarrito('Pantalon verde', 100, document.getElementById('cantidad-pantalonniña1').value)">Agregar al carrito</button>
                </div>
                <p><strong>Material:</strong> Es de algodón Pima, es lavable estampado con alto relieve.</p>

                <h2>Pantalon</h2>
                <img src="img/pantalon2-niña.png" alt="Imagen descriptiva de la polera">
                 <h1>S/60.00</h1>
                 <div class="carrito" id="pantalonniña2">
                    <label for="cantidad-pantalonniña2">Cantidad:</label>
                    <input type="number" class="cantidad-polera" id="cantidad-pantalonniña2" min="1" value="1">
                    <button onclick="agregarAlCarrito('Pantalon mostaza de niña', 90, document.getElementById('cantidad-pantalonniña2').value)">Agregar al carrito</button>
                </div>
            </section>
            <!-- Palo: ......... -->
            <section id="polos" class="grid-item">
            <h2>Polos</h2>
                <img src="img/polo-niña.png" alt="Imagen descriptiva de la polera">
                 <h1>S/50.00</h1>
                 <div class="carrito" id="polonniña1">
                     <label for="cantidad-poloniña1">Cantidad:</label>
                     <input type="number"  class="cantidad-polera" id="cantidad-poloniña1" min="1" value="1">
                    <button onclick="agregarAlCarrito('Polo rosado de niña', 100, document.getElementById('cantidad-poloniña1').value)">Agregar al carrito</button>
                </div>
                <p><strong>Material:</strong> Es de algodón Pima, es lavable estampado con alto relieve.</p>

                <h2>Polos</h2>
                <img src="img/polo2-niña.png" alt="Imagen descriptiva de la polera">
                 <h1>S/60.00</h1>
                 <div class="carrito" id="polonniña2">
                    <label for="cantidad-poloniña2">Cantidad:</label>
                    <input type="number" class="cantidad-polera" id="cantidad-poloniña2" min="1" value="1">
                    <button onclick="agregarAlCarrito('Polo blanco de niña', 90, document.getElementById('cantidad-poloniña2').value)">Agregar al carrito</button>
                </div>
            </section>

        </div>
    <!-- OFERTAS HOMBRES Y NIÑOS -->


        <div class="hombres-niños">
            <h1>Hombres:</h1>
        </div>


        <div class="grid-container">
            <section id="polera" class="grid-item">
            <h2>Polera</h2>
                <img src="img/polera-hombre.png" alt="Imagen descriptiva de la polera">
                 <h1>S/50.00</h1>
                 <div class="carrito" id="polerahombre1">
                     <label for="cantidad-polerahombre1">Cantidad:</label>
                     <input type="number" class="cantidad-polera" id="cantidad-polerahombre1" min="1" value="1">
                    <button onclick="agregarAlCarrito('Polera Blanca', 100, document.getElementById('cantidad-polerahombre1').value)">Agregar al carrito</button>
                </div>
                <p><strong>Material:</strong> Es de algodón Pima, es lavable estampado con alto relieve.</p>

                <h2>Polera</h2>
                <img src="img/polera2-hombre.png" alt="Imagen descriptiva de la polera">
                 <h1>S/60.00</h1>
                 <div class="carrito" id="polerahombre2">
                    <label for="cantidad-polerahombre2">Cantidad:</label>
                    <input type="number" class="cantidad-polera" id="cantidad-polerahombre2" min="1" value="1">
                    <button onclick="agregarAlCarrito('Polera mostaza con negro', 90, document.getElementById('cantidad-polerahombre2').value)">Agregar al carrito</button>
                </div>
            </section>

            <!-- Pantalón: ............ -->
            <section id="pantalon" class="grid-item">
            <h2>Pantalon</h2>
                <img src="img/pantalon-hombre.png" alt="Imagen descriptiva de la polera">
                 <h1>S/50.00</h1>
                 <div class="carrito" id="pantalonhombre1">
                     <label for="cantidad-pantalonhombre1">Cantidad:</label>
                     <input type="number" class="cantidad-polera" id="cantidad-pantalonhombre1" min="1" value="1">
                    <button onclick="agregarAlCarrito('Jean rasgado', 100, document.getElementById('cantidad-pantalonhombre1').value)">Agregar al carrito</button>
                </div>
                <p><strong>Material:</strong> Es de algodón Pima, es lavable estampado con alto relieve.</p>

                <h2>Pantalones</h2>
                <img src="img/pantalon2-hombre.png" alt="Imagen descriptiva de la polera">
                 <h1>S/60.00</h1>
                 <div class="carrito" id="pantalonhombre2">
                    <label for="cantidad-pantalonhombre2">Cantidad:</label>
                    <input type="number" class="cantidad-polera" id="cantidad-pantalonhombre2" min="1" value="1">
                    <button onclick="agregarAlCarrito('jeans azulado rasgado', 90, document.getElementById('cantidad-pantalonhombre2').value)">Agregar al carrito</button>
                </div>
            </section>
            <!-- Polo: ......... -->
            <section id="polos" class="grid-item">
            <h2>Polos</h2>
                <img src="img/polo-hombr.png" alt="Imagen descriptiva de la polera">
                 <h1>S/50.00</h1>
                 <div class="carrito" id="polohombre1"> 
                     <label for="cantidad-polohombre1">Cantidad:</label>
                     <input type="number" class="cantidad-polera" id="cantidad-polohombre1" min="1" value="1">
                    <button onclick="agregarAlCarrito('Polos negro', 100, document.getElementById('cantidad-polohombre1').value)">Agregar al carrito</button>
                </div>
                <p><strong>Material:</strong> Es de algodón Pima, es lavable estampado con alto relieve.</p>

                <h2>Polos</h2>
                <img src="img/polo2-hombre.png" alt="Imagen descriptiva de la polera">
                 <h1>S/60.00</h1>
                 <div class="carrito" id="polohombre2">
                    <label for="cantidad-polohombre2">Cantidad:</label>
                    <input type="number" class="cantidad-polera" id="cantidad-polohombre2" min="1" value="1">
                    <button onclick="agregarAlCarrito('Polo apretado azul', 90, document.getElementById('cantidad-polohombre2').value)">Agregar al carrito</button>
                </div>
            </section>
        </div>

        <div class="hombres-niños">
            <h1>Niños:</h1>
        </div>


        <div class="grid-container">
            <!-- Película 1: La Vida es Bella -->
            <section  class="grid-item">
            <h2> Poleras</h2>
                <img src="img/polera-niño.png" alt="Imagen descriptiva de la polera">
                 <h1>S/50.00</h1>
                 <div class="carrito" id="poleraniño1">
                     <label for="cantidad-poleraniño1">Cantidad:</label>
                     <input type="number" class="cantidad-polera" id="cantidad-poleraniño1" min="1" value="1">
                    <button onclick="agregarAlCarrito('Polera celeste', 100, document.getElementById('cantidad-poleraniño1').value)">Agregar al carrito</button>
                </div>
                <p><strong>Material:</strong> Es de algodón Pima, es lavable estampado con alto relieve.</p>

                <h2>Poleras</h2>
                <img src="img/polera2-niño.png" alt="Imagen descriptiva de la polera">
                 <h1>S/60.00</h1>
                 <div class="carrito" id="poleranniño2">
                    <label for="cantidad-poleraniño2">Cantidad:</label>
                    <input type="number" class="cantidad-polera" id="ccantidad-poleraniño2" min="1" value="1">
                    <button onclick="agregarAlCarrito('Polera roja', 90, document.getElementById('cantidad-poleraniño2').value)">Agregar al carrito</button>
                </div>
            </section>

            <!-- Pantalón: ............ -->
            <section  class="grid-item">
            <h2>Pantalones</h2>
                <img src="img/pantalon-niño.png" alt="Imagen descriptiva de la polera">
                 <h1>S/50.00</h1>
                 <div class="carrito" id="pantalonniño1">
                     <label for="cantidad-pantalonniño1">Cantidad:</label>
                     <input type="number" class="cantidad-polera" id="cantidad-pantalonniño1" min="1" value="1">
                    <button onclick="agregarAlCarrito('jeans celestes', 100, document.getElementById('cantidad-pantalonniño1').value)">Agregar al carrito</button>
                </div>
                <p><strong>Material:</strong> Es de algodón Pima, es lavable estampado con alto relieve.</p>

                <h2>Pantalones</h2>
                <img src="img/pantalon2-niño.png" alt="Imagen descriptiva de la polera">
                 <h1>S/60.00</h1>
                 <div class="carrito" id="pantalonniño2">
                    <label for="cantidad-pantalonniño2">Cantidad:</label>
                    <input type="number" class="cantidad-polera" id="cantidad-pantalonniño" min="1" value="1">
                    <button onclick="agregarAlCarrito('Pantalon mostaza', 90, document.getElementById('cantidad-pantalonniño2').value)">Agregar al carrito</button>
                </div>
            </section>
            <!-- Polo: ......... -->
            <section  class="grid-item">
            <h2>Polos</h2>
                <img src="img/polo-niño.png" alt="Imagen descriptiva de la polera">
                 <h1>S/50.00</h1>
                 <div class="carrito" id="Poloniño2">
                     <label for="cantidad-poloniño1">Cantidad:</label>
                     <input type="number" class="cantidad-polera" id="cantidad-poloniño1" min="1" value="1">
                    <button onclick="agregarAlCarrito('Polo mostaza', 100, document.getElementById('cantidad-poloniño1').value)">Agregar al carrito</button>
                </div>
           
                <p><strong>Material:</strong> Es de algodón Pima, es lavable estampado con alto relieve.</p>

                <h2>Polos</h2>
                <img src="img/polo2-niño.png" alt="Imagen descriptiva de la polera">
                 <h1>S/60.00</h1>
                 <div class="carrito" data-id="Poloniño2">
                    <label for="cantidad-poloniño2">Cantidad:</label>
                    <input type="number" class="cantidad-polera" id="cantidad-poloniño2" min="1" value="1">
                    <button onclick="agregarAlCarrito('Polo rosado', 90, document.getElementById('cantidad-poloniño2').value)">Agregar al carrito</button>
                </div>
            </section>
        </div>
  
    </main>

    <div id="chatbox">
      <div id="chat-content">
        <p>¡Hola! Soy tu asistente. ¿En qué puedo ayudarte?</p>
        <label for="opciones">Elige una opción:</label>
        <select id="opciones" name="opciones">
            <option value="opcion1">Envios</option>
            <option value="opcion2">Cancelar Pedido</option>
            <option value="opcion3">Ofertas</option>
        </select>
      </div>
      
      <input type="text" id="user-input" placeholder="Escribe aquí..." />
      <button id="INFO" onclick="sendMessage()">Enviar</button>
    </div>

    <script src="script.js"></script>



    <footer>
        <p>&copy; Joselyn Brigitte Montoya Cabrera </p>
    </footer>
</body>
</html>
