// Seleccionamos el título "Anuncios publicados"
const titulo = document.querySelector("h3");

// Variable para controlar el estado del título (ampliado o no)
let isEnlarged = false;

// Evento de clic al título
titulo.addEventListener("click", () => {
    if (!isEnlarged) {
        titulo.style.fontSize = "2.5em"; // Aumenta el tamaño de la fuente
        titulo.style.transition = "font-size 0.3s"; // Transición suave
        isEnlarged = true;
    } else {
        titulo.style.fontSize = "2em"; // Restablece el tamaño original de la fuente
        isEnlarged = false;
    }
});
