function sendMessage() {
  const userInput = document.getElementById("user-input").value;
  const selectedOption = document.getElementById('opciones').value;
  const chatContent = document.getElementById("chat-content");

  let responseMessage = "";


  if (userInput.trim() !== "") {

    const userMessage = document.createElement("p");
    userMessage.textContent = "Tú: " + userInput;
    chatContent.appendChild(userMessage);

    responseMessage = generateResponse(userInput);
  }

  else if (selectedOption !== "") {
   
    if (selectedOption === 'opcion1') {
        responseMessage = "Los envíos tardan entre 3 y 5 días hábiles dependiendo de la ubicación.";
    } else if (selectedOption === 'opcion2') {
        responseMessage = "Para cancelar el pedido, por favor comuníquese con el soporte.";
    } else if (selectedOption === 'opcion3') {
        responseMessage = "Las ofertas actuales son: 30% de descuento en productos seleccionados hasta el 30 de noviembre.";
    }
  } 
  else {
    responseMessage = "Por favor, selecciona una opción o escribe un mensaje.";
  }


  const botResponse = document.createElement("p");
  botResponse.textContent = "Bot: " + responseMessage;
  chatContent.appendChild(botResponse);


  document.getElementById("user-input").value = "";
  document.getElementById('opciones').selectedIndex = 0;
  chatContent.scrollTop = chatContent.scrollHeight;
}

function generateResponse(input) {
  input = input.trim().toLowerCase();

  if (input.includes("hola")) {
    return "¡Hola! ¿Cómo puedo ayudarte hoy?";
  } else if (input.includes("precio")) {
    return "Los precios de nuestros productos varían. ¿De qué producto te gustaría saber más?";
  } else if (input.includes("poleras")) {
    return "Los precios de nuestras poleras varían en un rango de 80-150 soles.";
  } else if (input.includes("polos")) {
    return "Los precios de nuestros polos varían en un rango de 50-100 soles.";
  } else if (input.includes("gracias")) {
    return "¡De nada! Si necesitas algo más, solo pregúntame.";
  } else if (input.includes("pantalones")) {
    return "Los precios de nuestros pantalones varían en un rango de 90-200 soles.";
  } else {
    return "Lo siento, no entiendo esa solicitud.";
  }
}