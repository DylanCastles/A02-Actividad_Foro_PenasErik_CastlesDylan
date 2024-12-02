<?php
include_once "../PHP/connect.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../STYLES/estilos.css">
    <title>Pagina principal</title>
</head>
<body>
    <div id="contenedorPagina">
        <div id="header">
            <img src="../img/logo.png" id="logo">
            <div id="contenedorOpcionesHeader">
                <div id="filtrosBuscador">
                    <img src="../img/buscador.png" alt="" id="logoBuscador">
                    <input type="text" name="" id="buscador" placeholder="Buscar...">
                </div>
                <button class="botonesHeader" id="botonLogIn">Log In</button>
                <button class="botonesHeader" id="botonReg">Register</button>
            </div>
        </div>
        <div id="bodyPagina">
            <nav id="menu">

            </nav>
            <div id="contenido">
                <div id="headerContenido">
                    <h1>PAGINA PRINCIPAL</h1>
                    <button id="botonPreguntar">Preguntar</button>
                </div>
                <!-- LO SIGUIENTE SE HARÁ CON UN BUCLE PARA QUE LO HAGA POR CADA PREGUNTA -->
                 <?php
                try {
                    $sqlPreguntas = "SELECT titulo_post, contenido_post, fecha_post, user_post FROM tbl_post;";
                    // Preparar y ejecutar la consulta
                    $stmt = $pdo->prepare($sqlPreguntas);
                    $stmt->execute();

                    // Comprobar si hay resultados
                    if ($stmt->rowCount() < 1) {
                        echo "No se han encontrado preguntas";
                    } else {
                        // Recorrer los resultados con un bucle
                        foreach ($stmt as $fila) {
                            echo "<div id='contenedorPregunta'>";
                            echo "<strong>Usuario:</strong> " . htmlspecialchars($fila["user_post"]) . "<br>";
                            echo "<h3><strong>Titulo:</strong> " . htmlspecialchars($fila["titulo_post"]) . "</h3><br>";
                            echo "<strong>Fecha:</strong> " . htmlspecialchars($fila["fecha_post"]) . "<br>";
                            echo "</div>";
                        }
                    }
                    // Cerrar conexión (opcional en PDO, se hace automáticamente al final del script)
                    $pdo = null;

                } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
                }
                
                 ?>
            </div>
        </div>
    </div>
</body>
</html>