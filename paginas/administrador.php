<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/administrador.css">
    <link rel="shortcut icon" href="../img/favicon-16x16.png" type="image/x-icon">
    <title>Administrador</title>
</head>

<body>

    <script src="../js/administrador.js"></script>
    <?php
    $mensaje_alerta = "";
    $ventana = "";
    include("../BD/sql.php");
    ?>
    <script>
        <?php
        // Mostrar mensaje de alerta si es necesario
        if (!empty($mensaje_alerta)) {
            echo "alert('$mensaje_alerta');";

        }
        echo "window.onload = function () {
            mostrarVentana('$ventana');
          }";
        ?>
    </script>

    <div class="button-container">
        <button onclick="mostrarVentana('Insertar')">Insertar</button>
        <button onclick="mostrarVentana('Modificar')">Modificar</button>
        <button onclick="mostrarVentana('Eliminar')">Eliminar</button>
        <a href="login.php"><button>Cerrar Sesión</button></a>
        <!--<button onclick="mostrarVentana('Buscar')">Buscar</button>-->
    </div>

    <div class="form-container">
        <form id="Insertar" class="content" method="post" enctype="multipart/form-data">
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

        <form id="Modificar" class="content" method="post" enctype="multipart/form-data">
            <h2 class="mensaje">Modificar bebidas</h2>
            <input type="text" name="nombre_buscar" placeholder="Nombre de la bebida a modificar">
            <input type="submit" name="buscar-modificar" value="Buscar">
            <input type="hidden" name="id" value="<?php echo isset($id) ? $id : ''; ?>">
            <input type="text" name="nombre" placeholder="Nombre" value="<?php echo isset($nombre) ? $nombre : ''; ?>">
            <input type="text" name="categoria" placeholder="Categoria"
                value="<?php echo isset($categoria) ? $categoria : ''; ?>">
            <input type="text" name="estacion" placeholder="Estacion"
                value="<?php echo isset($estacion) ? $estacion : ''; ?>">
            <input type="text" name="elaboracion" placeholder="Elaboracion"
                value="<?php echo isset($elaboracion) ? $elaboracion : ''; ?>">
            <input type="text" name="ingredientes" placeholder="Ingredientes"
                value="<?php echo isset($ingredientes) ? $ingredientes : ''; ?>">
            <input type="file" name="imagen">
            <input type="text" name="region" placeholder="Region" value="<?php echo isset($region) ? $region : ''; ?>">
            <input type="text" name="tipo" placeholder="Tipo" value="<?php echo isset($tipo) ? $tipo : ''; ?>">
            <input type="submit" name="modificar-bebida" value="Modificar Bebida">
        </form>

        <form id="Eliminar" class="content" method="post" enctype="multipart/form-data">
            <h2 class="mensaje">Eliminar bebidas</h2>
            <input type="text" name="nombre_buscar" placeholder="Nombre de la bebida a eliminar">
            <input type="submit" name="eliminar-bebida" value="Eliminar Bebida">
        </form>

        <!--<form id="Buscar" class="content">
            <h2>Ventana 4</h2>
            <p>Contenido de la Ventana 4.</p>
             Contenido del formulario para la ventana de Buscar 
        </form>-->
    </div>
</body>

</html>