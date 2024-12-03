<?php
session_start();
if (!isset($_SESSION['usuarioConectado'])) {
    header('Location: ./login.php');
    exit;
}
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
            <a href="./index.php" id="logo"><img src="../img/logo.png" id="logoFoto"></a>
            <div id="contenedorOpcionesHeader">
                <div id="filtrosBuscador">
                    <img src="../img/buscador.png" alt="" id="logoBuscador">
                    <input type="text" name="" id="buscador" placeholder="Buscar...">
                </div>
                <?php
                if (isset($_SESSION['usuarioConectado'])) {
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
                <button class="botonMenu"><a class="botonMenuInterior" href="./index.php">Pagina principal</a></button>
                <button class="botonMenuPyRSeleccionado"><a class="botonMenuInterior" href="./preguntasUser.php">Tus preguntas y respuestas</a></button>
            </nav>

            <div id="contenido">
                <div id="headerContenido">
                    <h1>TUS PREGUNTAS Y RESPUESTAS</h1>
                </div>

                <?php
                try {
                    // SQL para obtener las preguntas
                    $sqlPreguntas = "SELECT * FROM tbl_post WHERE user_post = :user_post AND ref_post IS NULL";
                    // SQL para obtener las respuestas y el título de la pregunta respondida
                    $sqlRespuestas = "
                        SELECT 
                            r.id_post, 
                            r.contenido_post, 
                            r.fecha_post, 
                            r.user_post, 
                            r.ref_post, 
                            p.titulo_post AS titulo_pregunta
                        FROM 
                            tbl_post r
                        INNER JOIN 
                            tbl_post p ON r.ref_post = p.id_post
                        WHERE 
                            r.user_post = :user_post 
                            AND r.ref_post IS NOT NULL
                    ";

                    // Preparar y ejecutar la consulta de preguntas
                    $stmt1 = $pdo->prepare($sqlPreguntas);
                    $stmt1->bindParam(':user_post', $_SESSION["usuarioConectado"]);
                    $stmt1->execute();
                    $result = $stmt1->fetchAll(PDO::FETCH_ASSOC);

                    echo "<h3>Tus Preguntas</h3>";
                    // Comprobar si hay preguntas
                    if ($stmt1->rowCount() < 1) {
                        echo "No has hecho ninguna pregunta.";
                    } else {
                        foreach ($result as $fila) {
                            echo "<a id='contenedorPregunta' href='./editar.php?post=" . htmlspecialchars($fila["id_post"]) . "'><div id='interiorContenedorPregunta'>";
                            echo "<strong>Usuario:</strong> " . htmlspecialchars($fila["user_post"]) . "<br>";
                            echo "<h3><strong>Titulo:</strong> " . htmlspecialchars($fila["titulo_post"]) . "</h3><br>";
                            echo htmlspecialchars($fila["contenido_post"]) . "<br>";
                            echo "<strong>Fecha:</strong> " . htmlspecialchars($fila["fecha_post"]) . "<br>";
                            echo "</div></a>";
                        }
                    }

                    // Preparar y ejecutar la consulta de respuestas
                    $stmt2 = $pdo->prepare($sqlRespuestas);
                    $stmt2->bindParam(':user_post', $_SESSION["usuarioConectado"]);
                    $stmt2->execute();
                    $result2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);

                    echo "<h3>Tus Respuestas</h3>";
                    // Comprobar si hay respuestas
                    if ($stmt2->rowCount() < 1) {
                        echo "No has respondido ninguna pregunta.";
                    } else {
                        foreach ($result2 as $fila) {
                            echo "<a id='contenedorPregunta' href='./editar.php?post=" . htmlspecialchars($fila["id_post"]) . "'><div id='interiorContenedorPregunta'>";
                            echo "<strong>Usuario:</strong> " . htmlspecialchars($fila["user_post"]) . "<br>";
                            echo "<h3><strong>Título de la pregunta respondida:</strong> " . htmlspecialchars($fila["titulo_pregunta"]) . "</h3><br>";
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
