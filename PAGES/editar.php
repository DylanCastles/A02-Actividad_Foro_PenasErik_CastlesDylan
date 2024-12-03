<?php
session_start();
include_once "../PHP/connect.php";

if (!isset($_SESSION['usuarioConectado'])) {
    header('Location: ./login.php');
    exit;
}

if(!isset($_GET["post"])){
    header('Location: ./preguntasUser.php');
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
                <?php
                    $edit = htmlspecialchars($_GET["post"]);
                    
                    $sqlPreguntasUser = "SELECT * FROM tbl_post WHERE id_post = :id_post";
                    
                    $stmt = $pdo->prepare($sqlPreguntasUser);
                    $stmt->bindParam(':id_post', $edit);
                    $stmt->execute();
                    $result = $stmt->fetch(PDO::FETCH_ASSOC);
                    
                    if(is_null($result["ref_post"])){
                        ?>
                            <h2>¡Edita tu pregunta en el foro!</h2>
                            <form action="../PHP/proceso_editar.php" method="POST">
                                <div class="mb-3">
                                    <label for="titulo" class="form-label">Título de la Pregunta</label>
                                    <input type="text" class="form-control" id="titulo" name="titulo" value="<?php echo isset($result['titulo_post']) ? $result['titulo_post'] : '';?>">
                                </div>
                                <div class="mb-3">
                                    <label for="contenidoForm" class="form-label">Contenido de la Pregunta</label>
                                    <textarea class="form-control" id="contenidoForm" name="contenido" rows="5"><?php echo isset($result['contenido_post']) ? $result['contenido_post'] : '';?></textarea>
                                </div>
                                <input type="hidden" name="post" value="<?php echo $edit; ?>">
                                <button type="submit" name="editPreguntar" class="btn btn-primary w-100">Editar Pregunta</button>
                            </form>
                            <a href="../PHP/proceso_eliminar.php?tipoPost=pregunta&idPost=<?php echo $edit?>"><button type="submit" name="deletePreguntar" class="btn btn-danger w-100">Eliminar pregunta</button></a>
                        <?php
                    } else {
                        ?>
                        <h2>¡Edita tu respuesta en el foro!</h2>
                        <form action="../PHP/proceso_editar.php" method="POST">
                            <div class="mb-3">
                                <label for="contenidoForm" class="form-label">Contenido de la Respuesta</label>
                                <textarea class="form-control" id="contenidoForm" name="contenidoR" rows="5"><?php echo isset($result['contenido_post']) ? $result['contenido_post'] : 'buenas';?></textarea>
                            </div>
                            <input type="hidden" name="post" value="<?php echo $edit; ?>">
                            <button type="submit" name="editRespuestas" class="btn btn-primary w-100">Editar respuesta</button>
                        </form>
                        <a href="../PHP/proceso_eliminar.php?tipoPost=respuesta&idPost=<?php echo $edit?>"><button type="submit" name="submitPreguntar" class="btn btn-danger w-100">Eliminar respuesta</button></a>
                        <?php
                        }
                        ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
