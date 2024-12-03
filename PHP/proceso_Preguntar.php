<?php
if (!isset($_SESSION['usuarioConectado'])) {
    header('Location: ../PAGES/index.php');
    exit;
}

if (!isset($_POST["submitPreguntar"])) {
    header("Location: ../PAGES/index.php");
}

session_start();
include_once "../PHP/connect.php";

$titulo = htmlspecialchars($_POST["titulo"]);
$contenido = htmlspecialchars($_POST["contenido"]);
$fecha = date('Y-m-d H:i:s');
$ref = NULL;

try {
    $insertPregunta = "INSERT INTO tbl_post (titulo_post, contenido_post, fecha_post, user_post, ref_post) VALUES (:titulo_post, :contenido_post, :fecha_post, :user_post, :ref_post)";
    $stmt = $pdo->prepare($insertPregunta);

    $stmt->bindParam(':titulo_post', $titulo);
    $stmt->bindParam(':contenido_post', $contenido); 
    $stmt->bindParam(':fecha_post', $fecha);
    $stmt->bindParam(':user_post', $_SESSION["usuarioConectado"]);
    $stmt->bindParam(':ref_post', $ref); 

    $stmt->execute();


    header("Location: ../PAGES/index.php"); 
    exit();

} catch (PDOException $e) {
    echo "Error de conexión con la base de datos:".$e->getMessage();
}
?>