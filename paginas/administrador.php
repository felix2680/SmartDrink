<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/administrador.css">
    <title>Ventanas con Botones</title>
</head>

<body>
    <div class="button-container">
        <button onclick="mostrarVentana('Insertar')">Insertar</button>
        <button onclick="mostrarVentana('Modificar')">Modificar</button>
        <button onclick="mostrarVentana('Eliminar')">Eliminar</button>
        <button onclick="mostrarVentana('Buscar')">Buscar</button>
    </div>

    <div class="form-container">
        <form id="Insertar" class="content" method="post">
            <h2 class="mensaje">Insertar bebidas</h2>
            <input type="text" name="nombre" placeholder="Nombre">
            <input type="text" name="categoria" placeholder="Categoria">
            <input type="text" name="estacion" placeholder="Estación">
            <input type="text" name="elaboracion" placeholder="Elaboración">
            <input type="text" name="ingredientes" placeholder="Ingredientes">
            <input type="file" name="imagen">
            <input type="text" name="region" placeholder="Región">
            <input type="text" name="tipo" placeholder="Tipo">
            <input type="submit" name="insertar-bebida" value="Insertar Bebida">
            <!-- Contenido del formulario para la ventana de Insertar -->
        </form>

        <form id="Modificar" class="content">
            <h2>Ventana 2</h2>
            <p>Contenido de la Ventana 2.</p>
            <!-- Contenido del formulario para la ventana de Modificar -->
        </form>

        <form id="Eliminar" class="content">
            <h2>Ventana 3</h2>
            <p>Contenido de la Ventana 3.</p>
            <!-- Contenido del formulario para la ventana de Eliminar -->
        </form>

        <form id="Buscar" class="content">
            <h2>Ventana 4</h2>
            <p>Contenido de la Ventana 4.</p>
            <!-- Contenido del formulario para la ventana de Buscar -->
        </form>
    </div>

    <script src="../js/administrador.js"></script>
    <?php
    $mensaje_alerta = "";
    include("../BD/sql.php");
    ?>
    <script>
        <?php
        // Mostrar mensaje de alerta si es necesario
        if (!empty($mensaje_alerta)) {
            echo "alert('$mensaje_alerta');";
        }
        ?>
    </script>
</body>

</html>