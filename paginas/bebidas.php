<?php
session_start();
include("../BD/sql.php");

if (isset($_SESSION['nombre_usuario'])) {
    $nombre_usuario = $_SESSION['nombre_usuario'];
    $correo_usuario = $_SESSION['correo_usuario'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bebidas</title>

    <link rel="stylesheet" href="../css/bebidas.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>

<body>
    <div class="menu">
        <ion-icon name="menu-outline"></ion-icon>
    </div>
    <div class="barra-lateral">
        <div>
            <div class="nombre-pagina">
                <ion-icon id="opc" name="grid-outline"></ion-icon>
                <span>SmartDrink</span>
            </div>
        </div>
        <nav class="navegacion">
            <ul>
                <li>
                    <a id="menu-principal" href="#bebidas-principal">
                        <ion-icon name="beer-outline"></ion-icon>
                        <span>Pagina principal</span>
                    </a>
                </li>
                <li>
                    <a href="cerrar_sesion.php">
                        <ion-icon name="close-circle-outline"></ion-icon>
                        <span>Cerrar sesion</span>
                    </a>
                </li>
            </ul>
        </nav>
        <div>
            <div class="linea"></div>

            <div class="modo-oscuro">
                <div class="info">
                    <ion-icon name="moon-outline"></ion-icon>
                    <span>Dark mode</span>
                </div>
                <div class="switch">
                    <div class="base">
                        <div class="circulo">

                        </div>
                    </div>
                </div>
            </div>
            <div class="usuario">
                <img id="imagenUsuario" src="../img/usuario x.jpg" alt="">
                <div class="info-usuario">
                    <div class="nombre-email">
                        <span class="nombre">
                            <?php echo isset($nombre_usuario) ? $nombre_usuario : ''; ?>
                        </span>
                        <span class="email">
                            <?php echo isset($correo_usuario) ? $correo_usuario : ''; ?>
                        </span>
                    </div>
                    <a id="cambiar-datos" href="#modificar-datos"><ion-icon
                            name="ellipsis-vertical-outline"></ion-icon></a>
                </div>
            </div>
        </div>
    </div>
    <main>
        <div id="busqueda" class="contenedor-busqueda">
        <input type="text" id="buscarInput" placeholder="Buscar...">
        <span class="material-symbols-outlined">search</span>
        </div>
        <div id="bebidas-principal" class="Container">
            <?php
            $consulta_obtener_bebidas = "SELECT * FROM bebidas";
            $resultado_obtener_bebidas = mysqli_query($conexion, $consulta_obtener_bebidas);

            if ($resultado_obtener_bebidas) {
                // Verificar si se encontraron resultados
                if (mysqli_num_rows($resultado_obtener_bebidas) > 0) {
                    while ($row_bebida = mysqli_fetch_assoc($resultado_obtener_bebidas)) {
                        // Mostrar los datos de la bebida
                        echo '<div class="card">';
                        echo '<img src="data:image/jpeg;base64,' . base64_encode($row_bebida['imagen']) . '" alt="' . $row_bebida['nombre'] . '">';
                        echo '<h4>' . $row_bebida['nombre'] . '</h4>';
                        echo '<p class="categoria">Categoría: ' . $row_bebida['categoria'] . '</p>';
                        // Agrega otros datos de la bebida según sea necesario
                        echo '<a href="">Leer mas</a>';
                        echo '</div>';
                    }
                } else {
                    $mensaje_alerta = "No se encontraron bebidas.";
                }
            } else {
                $mensaje_alerta = "Error en la consulta: " . mysqli_error($conexion);
            }
            ?>
        </div>
        <div id="modificar-datos">
            <form id="formulario-modificacion" method="post" enctype="multipart/form-data">
                <h1>Formulario para cambiar datos del usuario</h1>

                <label for="nombre-usuario">Nombre de usuario:</label>
                <input type="text" id="nombre-usuario" name="nombre-usuario" placeholder="Nuevo nombre de usuario"
                    required>

                <label for="correo">Correo electrónico:</label>
                <input type="email" id="correo" name="correo" placeholder="Nuevo correo electrónico" required>

                <label for="nueva-contrasena">Nueva contraseña:</label>
                <input type="password" id="nueva-contrasena" name="nueva-contrasena" placeholder="Nueva contraseña"
                    required>
                <input name="Modificar-datos-usuario" type="submit" value="Modificar">
            </form>
        </div>

    </main>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="../js/bebidas.js"></script>
    <script>
        $(document).ready(function () {
            // Código JavaScript para la búsqueda dinámica
            $('#buscarInput').on('input', function () {
                var busqueda = $(this).val().toLowerCase();

                $('.card').each(function () {
                    var categoriaBebida = $(this).find('.categoria').text().toLowerCase();
                    var nombreBebida = $(this).find('h4').text().toLowerCase();

                    // Muestra u oculta la tarjeta según la coincidencia en categoría o nombre
                    $(this).toggle(categoriaBebida.includes(busqueda) || nombreBebida.includes(busqueda));
                });
            });
        });
    </script>
</body>

</html>