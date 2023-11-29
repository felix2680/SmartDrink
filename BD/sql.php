<?php

include("conexion.php");

$mensaje_alerta;
$ventana = "";

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
} elseif (isset($_POST['iniciar-sesion'])) {
    if (strlen($_POST['name']) > 1 && strlen($_POST['password']) > 1) {
        $name = trim($_POST['name']);
        $password = trim($_POST['password']);

        // Consulta para verificar la existencia del usuario y contraseña
        $consulta_verificar = "SELECT * FROM usuario WHERE nombre_usuario = '$name' AND contrasenia = '$password'";
        $resultado_verificar = mysqli_query($conexion, $consulta_verificar);
        $row = mysqli_fetch_assoc($resultado_verificar);
        $existe_usuario = mysqli_num_rows($resultado_verificar) > 0;

        if ($existe_usuario) {
            // Login exitoso, utiliza una variable booleana
            $id_usuario = $row['id'];
            $nombre_usuario = $row['nombre_usuario'];
            $correo_usuario = $row['correo'];
            $imagen_perfil = $row['foto_perfil'];
            $login_exitoso = true;

            // Inicia la sesión y establece las variables de sesión
            session_start();
            $_SESSION['id'] = $id_usuario;
            $_SESSION['nombre_usuario'] = $nombre_usuario;
            $_SESSION['correo_usuario'] = $correo_usuario;
            $_SESSION['foto_perfil'] = $imagen_perfil;

        } else {
            // Login fallido, utiliza una variable booleana
            $login_exitoso = false;
            $mensaje_alerta = "Nombre de usuario o contraseña incorrectos. Por favor, inténtalo de nuevo.";
        }
    } else {
        // Campos incompletos, utiliza una variable booleana
        $login_exitoso = false;
        $mensaje_alerta = "Por favor completa los campos";
    }
} elseif (isset($_POST['insertar-bebida'])) {
    if (
        strlen($_POST['nombre']) > 1 && strlen($_POST['categoria']) > 1 && strlen($_POST['estacion']) > 1 && strlen($_POST['elaboracion']) > 1
        && strlen($_POST['ingredientes']) > 1 && strlen($_POST['region']) > 1 && strlen($_POST['tipo']) > 1
    ) {

        $nombre = trim($_POST['nombre']);
        $categoria = trim($_POST['categoria']);
        $estacion = trim($_POST['estacion']);
        $elaboracion = trim($_POST['elaboracion']);
        $ingredientes = trim($_POST['ingredientes']);
        $region = trim($_POST['region']);
        $tipo = trim($_POST['tipo']);
        $imagen = addslashes(file_get_contents($_FILES['imagen']['tmp_name']));

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
    $ventana = "Insertar";
} elseif (isset($_POST['buscar-modificar'])) {
    if (strlen($_POST['nombre_buscar']) > 1) {
        $nombre_buscar = trim($_POST['nombre_buscar']);

        // Consulta para obtener los datos de la bebida
        $consulta_buscar = "SELECT * FROM bebidas WHERE nombre = '$nombre_buscar'";
        $resultado_buscar = mysqli_query($conexion, $consulta_buscar);

        if ($resultado_buscar) {
            // Verificar si se encontraron resultados
            if (mysqli_num_rows($resultado_buscar) > 0) {
                $row = mysqli_fetch_assoc($resultado_buscar);
                $id = $row['id'];
                $nombre = $row['nombre'];
                $categoria = $row['categoria'];
                $estacion = $row['estacion'];
                $elaboracion = $row['elaboracion'];
                $ingredientes = $row['ingredientes'];
                //$imagen = $row['imagen'];
                $region = $row['region'];
                $tipo = $row['tipo'];
            } else {
                $mensaje_alerta = "No se encontró la bebida. Por favor, inténtalo de nuevo.";
            }
        } else {
            $mensaje_alerta = "Error en la consulta: " . mysqli_error($conexion);
        }
    } else {
        $mensaje_alerta = "Por favor completa los campos";
    }
    $ventana = "Modificar";
}

//funcion para modificar la bebida
elseif (isset($_POST['modificar-bebida'])) {
    if (
        strlen($_POST['nombre']) > 1 && strlen($_POST['categoria']) > 1 && strlen($_POST['estacion']) > 1 && strlen($_POST['elaboracion']) > 1
        && strlen($_POST['ingredientes']) > 1 && strlen($_POST['region']) > 1 && strlen($_POST['tipo']) > 1
    ) {
        $id = trim($_POST['id']);
        $nombre = trim($_POST['nombre']);
        $categoria = trim($_POST['categoria']);
        $estacion = trim($_POST['estacion']);
        $elaboracion = trim($_POST['elaboracion']);
        $ingredientes = trim($_POST['ingredientes']);
        $region = trim($_POST['region']);
        $tipo = trim($_POST['tipo']);
        $imagen = addslashes(file_get_contents($_FILES['imagen']['tmp_name']));
        $consulta_modificar = "UPDATE bebidas SET categoria = '$categoria', estacion = '$estacion', elaboracion = '$elaboracion', ingredientes = '$ingredientes', region = '$region', tipo = '$tipo', imagen = '$imagen', nombre = '$nombre' WHERE id = '$id'";
        $resultado_modificar = mysqli_query($conexion, $consulta_modificar);
        if ($resultado_modificar) {
            $mensaje_alerta = "La bebida se ha modificado correctamente";
            $id = '';
            $nombre = '';
            $categoria = '';
            $estacion = '';
            $elaboracion = '';
            $ingredientes = '';
            $region = '';
            $tipo = '';
        } else {
            $mensaje_alerta = "Ha ocurrido un error al modificar la bebida";
        }
    } else {
        $mensaje_alerta = "Por favor completa los campos necesarios para modificar la bebida";
    }
    $ventana = "Modificar";
} elseif (isset($_POST['eliminar-bebida'])) {
    if (strlen($_POST['nombre_buscar']) > 1) {
        $nombre = trim($_POST['nombre_buscar']);

        // Consulta para eliminar la bebida
        $consulta_eliminar = "DELETE FROM bebidas WHERE nombre = '$nombre'";
        $resultado_eliminar = mysqli_query($conexion, $consulta_eliminar);

        if ($resultado_eliminar) {
            $mensaje_alerta = "La bebida se ha eliminado correctamente";
        } else {
            $mensaje_alerta = "No se encontró la bebida. Por favor, inténtalo de nuevo.";
        }
    } else {
        $mensaje_alerta = "Por favor completa los campos";
    }
    $nombre = '';
    $ventana = "Eliminar";

} if (isset($_POST['Modificar-datos-usuario'])) {
    if (isset($_POST['nombre-usuario'], $_POST['correo'], $_POST['nueva-contrasena'])) {
        $nuevo_nombre_usuario = trim($_POST['nombre-usuario']);
        $nuevo_correo = trim($_POST['correo']);
        $nueva_contrasena = trim($_POST['nueva-contrasena']);

        // Accede a los datos de la sesión
        $id_usuario = $_SESSION['id'];

        // Actualizamos los datos en la base de datos
        $consulta_modificar_datos = "UPDATE usuario SET nombre_usuario = '$nuevo_nombre_usuario', correo = '$nuevo_correo', 
            contrasenia = '$nueva_contrasena' WHERE id = '$id_usuario'";
        $resultado = mysqli_query($conexion, $consulta_modificar_datos);

        if ($resultado) {
            $_SESSION['nombre_usuario'] = $nuevo_nombre_usuario;
            $_SESSION['correo_usuario'] = $nuevo_correo;

            echo "<script>alert('Tus datos se han modificado correctamente');</script>";
        } else {
            echo "<script>alert('Ha ocurrido un error');</script>";
        }

    } else {
        echo "<script>alert('Por favor, completa todos los campos para modificar tus datos');</script>";
    }
}
?>