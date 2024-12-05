
let carrito = [];


function agregarAlCarrito(nombreProducto, precio, cantidad) {

    let productoExistente = carrito.find(item => item.nombre === nombreProducto);

    if (productoExistente) {

        productoExistente.cantidad += parseInt(cantidad);
    } else {

        carrito.push({
            nombre: nombreProducto,
            precio: precio,
            cantidad: parseInt(cantidad),
        });
    }


    alert(`${nombreProducto} se ha agregado al carrito.`);
    

    console.log(carrito);
}

function mostrarCarrito() {
    if (carrito.length > 0) {
        let total = 0;
        let contenidoCarrito = "Carrito de compras:\n";

        carrito.forEach(item => {
            contenidoCarrito += `${item.nombre} - S/${item.precio} x ${item.cantidad} = S/${item.precio * item.cantidad}\n`;
            total += item.precio * item.cantidad;
        });

        contenidoCarrito += `\nTotal: S/${total}`;
        alert(contenidoCarrito);
    } else {
        alert("El carrito está vacío.");
    }
}


function vaciarCarrito() {
    carrito = [];
    alert("El carrito ha sido vaciado.");
}


document.querySelectorAll('.carrito button').forEach(button => {
    button.addEventListener('click', function() {
        const cantidadInput = this.previousElementSibling;
        const productoNombre = this.previousElementSibling.previousElementSibling.previousElementSibling.textContent.trim();
        const precioProducto = parseInt(this.previousElementSibling.previousElementSibling.textContent.replace("S/", "").trim());
        
        agregarAlCarrito(productoNombre, precioProducto, cantidadInput.value);
    });
});

