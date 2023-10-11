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

if (isset($_POST['buscar-modificar'])) {
    $nombre_buscar = trim($_POST['nombre_buscar']);
    
    // Realiza una consulta para obtener los datos de la bebida con el nombre ingresado
    $consulta_buscar = "SELECT * FROM bebidas WHERE nombre = '$nombre_buscar'";
    $resultado_buscar = mysqli_query($conexion, $consulta_buscar);
    
    if ($resultado_buscar && mysqli_num_rows($resultado_buscar) > 0) {
        // Si se encontraron resultados, obtén los datos y muéstralos en el formulario
        $row = mysqli_fetch_assoc($resultado_buscar);
        $nombre = $row['nombre'];
        $categoria = $row['categoria'];
        $estacion = $row['estacion'];
        $elaboracion = $row['elaboracion'];
        $ingredientes = $row['ingredientes'];
        $imagen = $row['imagen'];
        $region = $row['region'];
        $tipo = $row['tipo'];        
    } else {
        // Si no se encontraron resultados, muestra un mensaje de error
        $mensaje_alerta = "La bebida no se encontró en la base de datos.";
    }
}

if (isset($_POST['modificar-bebida'])) {
    // Obtén los valores del formulario
    $nombre_original = trim($_POST['nombre_original']); // Nombre original de la bebida
    $nombre = trim($_POST['nombre']);
    $categoria = trim($_POST['categoria']);
    $estacion = trim($_POST['estacion']);
    $elaboracion = trim($_POST['elaboracion']);
    $ingredientes = trim($_POST['ingredientes']);
    $imagen = addcslashes(file_get_contents($_FILES['imagen']['tmp_name']), "\'\"");
    $region = trim($_POST['region']);
    $tipo = trim($_POST['tipo']);
    
    // Actualiza los datos de la bebida en la base de datos
    $consulta_modificar = "UPDATE bebidas SET nombre='$nombre', categoria='$categoria', estacion='$estacion', elaboracion='$elaboracion', ingredientes='$ingredientes', imagen='$imagen', region='$region', tipo='$tipo' WHERE nombre='$nombre_original'";
    
    $resultado_modificar = mysqli_query($conexion, $consulta_modificar);
    
    if ($resultado_modificar) {
        $mensaje_alerta = "La bebida se ha modificado correctamente.";
    } else {
        $mensaje_alerta = "Ha ocurrido un error al modificar la bebida.";
    }
}
?>