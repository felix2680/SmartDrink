const opc = document.getElementById("opc");
const barraLateral = document.querySelector(".barra-lateral");
const spans = document.querySelectorAll("span");
const palanca = document.querySelector(".switch");
const circulo = document.querySelector(".circulo");
//let imagen = document.getElementById("imagenUsuario");
/* lo que esta comentado es por si agregamos la funcionalidad
   adelante*/
palanca.addEventListener("click", () => {
    let body = document.body;
    body.classList.toggle("dark-mode");
    circulo.classList.toggle("prendido");

 /*   if (body.classList.contains("dark-mode")) {
       // imagen.src = "/img/usuario darkmode.png";
    } else {
        imagen.src = "/img/usuario.png";
    }*/
});

opc.addEventListener("click", () => {
    barraLateral.classList.toggle("mini-barra-lateral");

    spans.forEach((span) => {
        span.classList.toggle("oculto");
    });

});