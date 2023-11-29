<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de la Bebida</title>
    <link rel="stylesheet" href="../css/bebida.css">
    <link rel="shortcut icon" href="../img/favicon-16x16.png" type="image/x-icon">

</head>
<body>
<?php
include("../BD/sql.php");

// Verificar si se proporciona un ID de bebida en la URL
if (isset($_GET['id'])) {
    $id_bebida = $_GET['id'];

    // Consulta para obtener los detalles de la bebida con el ID proporcionado
    $consulta_obtener_detalle = "SELECT * FROM bebidas WHERE id = $id_bebida";
    $resultado_obtener_detalle = mysqli_query($conexion, $consulta_obtener_detalle);

    if ($resultado_obtener_detalle) {
        // Verificar si se encontraron resultados
        if (mysqli_num_rows($resultado_obtener_detalle) == 1) {
            $row_detalle = mysqli_fetch_assoc($resultado_obtener_detalle);

            // Ahora puedes mostrar los detalles de la bebida en esta página
            echo '<h1>' . $row_detalle['nombre'] . '</h1>';
            echo '<p class="imagen-container"><img src="data:image/jpeg;base64,' . base64_encode($row_detalle['imagen']) . '" alt="' . $row_detalle['nombre'] . '"></p>';
            echo '<p>Categoría: ' . $row_detalle['categoria'] . '</p>';
            echo '<p>Estación recomendada para su consumo: ' . $row_detalle['estacion'] . '</p>';
            echo '<p>Ingredientes: ' . $row_detalle['ingredientes'] . '</p>';
            echo '<p>Elaboracion: ' . $row_detalle['elaboracion'] . '</p>';
            echo '<p>Región: ' . $row_detalle['region'] . '</p>';
            echo '<p>Tipo: ' . $row_detalle['tipo'] . '</p>';
            // Agrega otros detalles según sea necesario

            echo '<a href="../paginas/bebidas.php"><button>Volver a la pagina principal</button></a>';
        } else {
            echo 'Bebida no encontrada.';
        }
    } else {
        echo 'Error en la consulta: ' . mysqli_error($conexion);
    }
} else {
    echo 'ID de bebida no proporcionado.';
}
?>
</body>
</html>