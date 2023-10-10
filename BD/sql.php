<?php

include("conexion.php");

$mensaje_alerta = "";

if (isset($_POST['registrar'])) {
    if (strlen($_POST['txtNombre']) > 1 && strlen($_POST['txtEmail']) > 1 && strlen($_POST['txtPassword']) > 1) {
        $name = trim($_POST['txtNombre']);
        $email = trim($_POST['txtEmail']);
        $password = trim($_POST['txtPassword']);

        // Verifica si el usuario ya está registrado
        $consulta_verificar = "SELECT COUNT(*) FROM usuario WHERE nombre_usuario = '$name'";
        $resultado_verificar = mysqli_query($conexion, $consulta_verificar);
        $row = mysqli_fetch_row($resultado_verificar);
        $existe_usuario = $row[0] > 0;

        if ($existe_usuario) {
            $mensaje_alerta = "El nombre de usuario ya está en uso. Por favor, elige otro nombre de usuario.";
        } else {
            $consulta = "INSERT INTO usuario(nombre_usuario, correo, contrasenia) 
                        VALUES ('$name','$email','$password')";
            $resultado = mysqli_query($conexion, $consulta);
            if ($resultado) {
                $mensaje_alerta = "Te has inscrito correctamente";
            } else {
                $mensaje_alerta = "Ha ocurrido un error";
            }
        }
    } else {
        $mensaje_alerta = "Por favor completa los campos";
    }
}

if (isset($_POST['iniciar-sesion'])) {
    if (strlen($_POST['name']) > 1 && strlen($_POST['password']) > 1) {
        $name = trim($_POST['name']);
        $password = trim($_POST['password']);

        // Consulta para verificar la existencia del usuario y contraseña
        $consulta_verificar = "SELECT COUNT(*) FROM usuario WHERE nombre_usuario = '$name' AND contrasenia = '$password'";
        $resultado_verificar = mysqli_query($conexion, $consulta_verificar);
        $row = mysqli_fetch_row($resultado_verificar);
        $existe_usuario = $row[0] > 0;

        if ($existe_usuario) {
            // Redirecciona a la página principal
            $mensaje_alerta = "login exitoso";
        } else {
            $mensaje_alerta = "Nombre de usuario o contraseña incorrectos. Por favor, inténtalo de nuevo.";
        }
    } else {
        $mensaje_alerta = "Por favor completa los campos')";
    }
}

if (isset($_POST['insertar-bebida'])) {
    if (strlen($_POST['nombre']) > 1 && strlen($_POST['categoria']) > 1 && strlen($_POST['estacion']) > 1 && strlen($_POST['elaboracion']) > 1
        && strlen($_POST['ingredientes']) > 1 && strlen($_POST['region']) > 1 && strlen($_POST['tipo']) > 1) {
        
        $nombre = trim($_POST['nombre']);
        $categoria = trim($_POST['categoria']);
        $estacion = trim($_POST['estacion']);
        $elaboracion = trim($_POST['elaboracion']);
        $ingredientes = trim($_POST['ingredientes']);
        $region = trim($_POST['region']);
        $tipo = trim($_POST['tipo']);
        $$imagen = addcslashes(file_get_contents($_FILES['imagen']['tmp_name']), "\'\"");

        $consulta = "INSERT INTO bebidas( nombre, categoria, estacion, elaboracion, ingredientes, imagen, region, tipo) 
                        VALUES ('$nombre','$categoria','$estacion','$elaboracion','$ingredientes','$imagen','$region','$tipo')";
        $resultado = mysqli_query($conexion, $consulta);

        if ($resultado) {
            $mensaje_alerta = "La bebida se ha insertado correctamente";
        } else {
            $mensaje_alerta = "Ha ocurrido un error";
        }
    } else {
        $mensaje_alerta = "Por favor completa los campos";
    }

}

?>