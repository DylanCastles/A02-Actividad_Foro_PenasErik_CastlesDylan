<?php
session_start();
include_once "../PHP/connect.php";

if (!isset($_SESSION['usuarioConectado'])) {
    header('Location: ./login.php');
    exit;
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Respuesta - Foro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Fondo oscuro y opaco */
        .background-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }
        .container {
            position: relative;
            z-index: 10;
        }
        /* Estilo del formulario */
        .form-container {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.2);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body class="bg-light">
    <div class="background-overlay"></div>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6 form-container">
                <h2>¡Realiza tu respuesta en el foro!</h2>
                <form action="../PHP/proceso_Responder.php" method="POST">
                    <div class="mb-3">
                        <label for="titulo" class="form-label">Título de la Pregunta</label><br>
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
                                    echo "<strong>" . htmlspecialchars($result["titulo_post"]) . "</strong>";
                                }

                                // Cerrar conexión (opcional en PDO, se hace automáticamente al final del script)
                                $pdo = null;
                                
                            } catch (PDOException $e) {
                            echo "Error: " . $e->getMessage();
                            }
                        ?>
                    </div>
                    <div class="mb-3">
                        <label for="contenido" class="form-label">Contenido de la Respuesta</label>
                        <textarea class="form-control" id="contenido" name="contenido" rows="5" required></textarea>
                    </div>
                    <input type="hidden" name="pregunta" value="<?php echo $pregunta; ?>">
                    <button type="submit" name="submitResponder" class="btn btn-primary w-100">Publicar Respuesta</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
