<?php
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
            <img src="../img/logo.png" id="logo">
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
            </nav>

            <div id="contenido">
                <div id="headerContenido">
                    <h1>PAGINA PRINCIPAL</h1>
                    <button id="botonPreguntar"><a class="botonLogInA" href="./preguntar.php">Preguntar</a></button>
                </div>
                 <?php
                try {
                    $sqlPreguntas = "SELECT id_post, titulo_post, contenido_post, fecha_post, user_post FROM tbl_post WHERE ref_post IS NULL;";
                    // Preparar y ejecutar la consulta
                    $stmt = $pdo->prepare($sqlPreguntas);
                    $stmt->execute();

                    // Comprobar si hay resultados
                    if ($stmt->rowCount() < 1) {
                        echo "No se han encontrado preguntas";
                    } else {
                        // Recorrer los resultados con un bucle
                        foreach ($stmt as $fila) {
                            echo "<a id='contenedorPregunta' href='./preguntaSeleccionada.php?pregunta=" . htmlspecialchars($fila["id_post"]) . "'><div id='interiorContenedorPregunta'>";
                            echo "<strong>Usuario:</strong> " . htmlspecialchars($fila["user_post"]) . "<br>";
                            echo "<h3><strong>Titulo:</strong> " . htmlspecialchars($fila["titulo_post"]) . "</h3><br>";
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