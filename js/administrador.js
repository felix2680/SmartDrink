function mostrarVentana(ventanaId) {
    // Oculta todas las ventanas
    var ventanas = document.getElementsByClassName('content');
    for (var i = 0; i < ventanas.length; i++) {
      ventanas[i].style.display = 'none';
    }
  
    // Muestra la ventana correspondiente
    var ventana = document.getElementById(ventanaId);
    ventana.style.display = 'block';
  }
  