<?php
$login_exitoso = false;
$mensaje_alerta="";
include("../BD/sql.php");

// Redirigir si es un "login exitoso"
if ($login_exitoso) {
    header("Location: bebidas.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es-CO">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="../img/favicon-16x16.png" type="image/x-icon">
    <title>Bienvenido a SmartDrink</title>
</head>

<body>
    <div class="container-form sign-up">
        <div class="welcome-back">
            <div class="message">
                <h2>Bienvenido a SmarDrink</h2>
                <p>Si ya tienes una cuenta por favor inicia sesión aquí</p>
                <button class="sign-up-btn">Iniciar Sesion</button>
            </div>
        </div>
        <form method="post" class="formulario">
            <h2 class="create-account">Crear una cuenta</h2>
            <p class="cuenta-gratis">Crear una cuenta gratuita</p>
            <input type="text" id="txtNombre" name="txtNombre" placeholder="Nombre usuario" autocomplete="off">
            <input type="email" id="txtEmail" name="txtEmail" placeholder="Email" autocomplete="off">
            <input type="password" id="txtPassword" name="txtPassword" placeholder="Contraseña">
            <input type="submit" name="registrar" value="Registrarse">
        </form>
    </div>
    <div class="container-form sign-in">
        <form method="post" class="formulario">
            <h2 class="create-account">Iniciar Sesión</h2>
            <div id="mensajeError" class="mensaje-error"><?php echo $mensaje_alerta; ?></div>
            <p class="cuenta-gratis">¿Aun no tienes cuenta?</p>
            <input type="text" id="username" name="name" placeholder="Nombre usuario" autocomplete="off">
            <input type="password" id="password" name="password" placeholder="Contraseña">
            <input type="submit" name="iniciar-sesion" value="Iniciar Sesión">
        </form>
        <div class="welcome-back">
            <div class="message">
                <h2>hola de nuevo</h2>
                <p>Si aun no tienes una cuenta por favor registrese aqui</p>
                <button class="sign-in-btn">Registrarse</button>
            </div>
        </div>
    </div>
    <script src="../js/script.js"></script>
</body>

</html>