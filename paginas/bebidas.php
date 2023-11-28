<?php
include("../BD/sql.php");

session_start();
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
    <div class="barra-lateral">
        <div class="nombre-pagina">
            <ion-icon id="opc" name="grid-outline"></ion-icon>
            <span>SmartDrink</span>
        </div>
        <nav class="navegacion">
            <ul>
                <li>
                    <a id="menu-principal" href="#">
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
            <img id="imagenUsuario" src=" ../img/usuario x.jpg" alt="">
            <div class="info-usuario">
                <div class="nombre-email">
                    <span class="nombre">
                        <?php echo isset($nombre_usuario) ? $nombre_usuario : ''; ?>
                    </span>
                    <span class="email">
                        <?php echo isset($correo_usuario) ? $correo_usuario : ''; ?>
                    </span>
                </div>
                <a id="cambiar-datos" href="#"><ion-icon
                        name="ellipsis-vertical-outline"></ion-icon></a>
            </div>
        </div>
    </div>
    <main>
        <div id="busqueda" class="contenedor-busqueda">
            <input type="text" placeholder="Buscar...">
            <span class="material-symbols-outlined">search</span>
        </div>
        <div id="div-principal" class="Container">
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
                        echo '<p>Categoría: ' . $row_bebida['categoria'] . '</p>';
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
        <div id="div-cambiar-datos">
            <h1>aqui deber ir un formulario para cambiar datos</h1>
        </div>
    </main>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="../js/bebidas.js"></script>
</body>

</html>