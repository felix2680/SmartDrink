const opc = document.getElementById("opc");
const barraLateral = document.querySelector(".barra-lateral");
const spans = document.querySelectorAll("span");
const palanca = document.querySelector(".switch");
const circulo = document.querySelector(".circulo");
const main = document.querySelector("main");
const menu_principal = document.getElementById("menu-principal");
const cambiar_datos = document.getElementById("cambiar-datos");
const div_principal = document.getElementById("div-principal");
const div_cambiar_datos = document.getElementById("div-cambiar-datos");
const busqueda = document.getElementById("busqueda");

palanca.addEventListener("click", () => {
    let body = document.body;
    body.classList.toggle("dark-mode");
    circulo.classList.toggle("prendido");
});

opc.addEventListener("click", () => {
    barraLateral.classList.toggle("mini-barra-lateral");
    main.classList.toggle("min-main");
    spans.forEach((span) => {
        span.classList.toggle("oculto");
    });
});

menu_principal.addEventListener("click",()=>{
    div_principal.style.display="flex";
    busqueda.style.display="inline-flex";
    div_cambiar_datos.style.display="none";
})

cambiar_datos.addEventListener("click",()=>{
    div_principal.style.display="none";
    busqueda.style.display="none";
    div_cambiar_datos.style.display="flex";
})