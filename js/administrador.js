function mostrarVentana(ventanaId) {
  var ventanas = document.getElementsByClassName('content');

  for (var i = 0; i < ventanas.length; i++) {
    ventanas[i].style.display = 'none';
  }

  var ventana = document.getElementById(ventanaId);
  ventana.style.display = 'block';
}

// Mostrar el formulario de inserción por defecto al cargar la página
