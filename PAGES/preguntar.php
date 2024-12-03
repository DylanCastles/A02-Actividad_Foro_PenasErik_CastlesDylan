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
    <title>Formulario de Pregunta - Foro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../STYLES/estilos.css">
</head>
<body class="bg-light" id="bodyEditar">
    <div class="background-overlay"></div>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6 form-container">
                <h2>¡Realiza tu pregunta en el foro!</h2>
                <form action="../PHP/proceso_Preguntar.php" method="POST">
                    <div class="mb-3">
                        <label for="titulo" class="form-label">Título de la Pregunta</label>
                        <input type="text" class="form-control" id="titulo" name="titulo" required>
                    </div>
                    <div class="mb-3">
                        <label for="contenidoForm" class="form-label">Contenido de la Pregunta</label>
                        <textarea class="form-control" id="contenidoForm" name="contenido" rows="5" required></textarea>
                    </div>
                    <button type="submit" name="submitPreguntar" class="btn btn-primary w-100">Publicar Pregunta</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
