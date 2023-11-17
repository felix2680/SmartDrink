const opc = document.getElementById("opc");
const barraLateral = document.querySelector(".barra-lateral");
const spans = document.querySelectorAll("span");

opc.addEventListener("click",() =>{
    barraLateral.classList.toggle("mini-barra-lateral");
    
    spans.forEach((span)=>{
        span.classList.toggle("oculto");
    });

});