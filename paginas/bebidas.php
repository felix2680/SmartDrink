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
                    <a href="#">
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
                <a href="#"><ion-icon name="ellipsis-vertical-outline"></ion-icon></a>
            </div>
        </div>
    </div>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="../js/bebidas.js"></script>
</body>

</html>