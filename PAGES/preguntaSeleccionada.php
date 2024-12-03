<?php
if (!isset($_GET['pregunta'])) {
    header('Location: ./index.php');
    exit;
}
include_once "../PHP/connect.php";
session_start();
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
            <a href="./index.php" id="logo"><img src="../img/logo.png" id="logoFoto"></a>
            <div id="contenedorOpcionesHeader">
                <div id="filtrosBuscador">
                    <img src="../img/buscador.png" alt="" id="logoBuscador">
                    <input type="text" name="" id="buscador" placeholder="Buscar...">
                </div>
                <?php
                if(isset($_SESSION['usuarioConectado'])){
                    ?>
                    <p><strong>Usuario conectado:</strong><br><?php echo $_SESSION['usuarioConectado']; ?></p>
                    <button class="botonesHeader" id="botonLogOut"><a class="botonLogInA" href="../PHP/proceso_cerrarSesion.php">Cerrar Sesión</a></button>
                    <?php
                } else {
                    ?>
                    <button class="botonesHeader" id="botonLogIn"><a class="botonLogInA" href="./login.php">Log In</a></button>
                    
                    <button class="botonesHeader" id="botonReg"><a class="botonLogInA" href="./registrarse.php">Register</a></button>
                    <?php
                }
                ?>
            </div>
        </div>
        <div id="bodyPagina">
            <nav id="menu">
                <button class="botonMenuSeleccionado"><a class="botonMenuInterior" href="./index.php">Pagina principal</a></button>
                <button class="botonMenuPyR"><a class="botonMenuInterior" href="./preguntasUser.php">Tus preguntas y respuestas</a></button>
            </nav>

            <div id="contenido">
                <div id="headerContenido">
                    <h1>PREGUNTA</h1>
                    <button id="botonPreguntar"><a class="botonLogInA" href="./preguntar.php">Preguntar</a></button>
                    <button id="botonPreguntar"><a class="botonLogInA" href="./responder.php?pregunta=<?php echo htmlspecialchars($_GET['pregunta']); ?>">Responder</a></button>
                </div>
                 <?php
                try {
                    $pregunta = htmlspecialchars($_GET['pregunta']);
                    $sqlPreguntas = "SELECT id_post, titulo_post, contenido_post, fecha_post, user_post FROM tbl_post WHERE id_post = :id_post;";
                    // Preparar y ejecutar la consulta
                    $stmt = $pdo->prepare($sqlPreguntas);
                    $stmt->bindParam(':id_post', $pregunta);
                    $stmt->execute();
                    $result = $stmt->fetch(PDO::FETCH_ASSOC);

                    // Comprobar si hay resultados
                    if ($stmt->rowCount() < 1) {
                        echo "No se ha encontrado la pregunta.";
                    } else {
                        echo "<a id='contenedorPreguntaSeleccionada'><div id='interiorContenedorPregunta'>";
                        echo "<strong>Usuario:</strong> " . htmlspecialchars($result["user_post"]) . "<br>";
                        echo "<h3><strong>Titulo:</strong> " . htmlspecialchars($result["titulo_post"]) . "</h3><br>";
                        echo htmlspecialchars($result["contenido_post"]) . "<br>";
                        echo htmlspecialchars($result["fecha_post"]) . "<br>";
                        echo "</div></a>";
                    }
                    ?>
                        <br>
                        <h2>Respuestas</h2>
                    <?php
                    
                    $sqlPreguntas = "SELECT id_post, titulo_post, contenido_post, fecha_post, user_post FROM tbl_post WHERE ref_post = :id_post;";
                    // Preparar y ejecutar la consulta
                    $stmt2 = $pdo->prepare($sqlPreguntas);
                    $stmt2->bindParam(':id_post', $pregunta);
                    $stmt2->execute();
            
                    // Comprobar si hay resultados
                    if ($stmt2->rowCount() < 1) {
                        echo "No se han encontrado respuestas";
                    } else {
                        // Recorrer los resultados con un bucle
                        foreach ($stmt2 as $fila) {
                            echo "<a id='contenedorPregunta'><div id='interiorContenedorPregunta'>";
                            echo "<strong>Usuario:</strong> " . htmlspecialchars($fila["user_post"]) . "<br>";
                            echo htmlspecialchars($fila["contenido_post"]) . "<br>";
                            echo "<strong>Fecha:</strong> " . htmlspecialchars($fila["fecha_post"]) . "<br>";
                            echo "</div></a>";
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