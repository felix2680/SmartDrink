const opc = document.getElementById("opc");
const barraLateral = document.querySelector(".barra-lateral");
const spans = document.querySelectorAll("span");
const palanca = document.querySelector(".switch");
const circulo = document.querySelector(".circulo");
const main = document.querySelector("main");
const menu_principal = document.getElementById("menu-principal");
const cambiar_datos = document.getElementById("cambiar-datos");
const div_principal = document.getElementById("bebidas-principal");
const div_cambiar_datos = document.getElementById("modificar-datos");
const busqueda = document.getElementById("busqueda");
const menu = document.querySelector(".menu");

menu.addEventListener("click", () => {
    barraLateral.classList.toggle("max-barra-lateral")
})
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

menu_principal.addEventListener("click", () => {
    div_principal.style.display = "flex";
    busqueda.style.display = "inline-flex";
    div_cambiar_datos.style.display = "none";
})

cambiar_datos.addEventListener("click", () => {
    div_principal.style.display = "none";
    busqueda.style.display = "none";
    div_cambiar_datos.style.display = "flex";
})

document.getElementById('foto-perfil').addEventListener('change', function (event) {
    var imagenPreview = document.getElementById('imagen-preview');
    var iconoImagen = document.getElementById('icono-imagen');
    var archivo = event.target.files[0];

    if (archivo) {
        var lector = new FileReader();
        lector.onload = function (e) {
            imagenPreview.src = e.target.result;
            iconoImagen.style.display = 'none';
            imagenPreview.style.display = 'block';
        };
        lector.readAsDataURL(archivo);
    } else {
        imagenPreview.src = '';
        iconoImagen.style.display = 'block';
        imagenPreview.style.display = 'none';
    }
});