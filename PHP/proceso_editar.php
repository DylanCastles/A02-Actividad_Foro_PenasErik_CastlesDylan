<?php
session_start();
if (!isset($_SESSION['usuarioConectado'])) {
    header('Location: ../PAGES/login.php');
    exit;
}

$post = htmlspecialchars($_POST["post"]);
include_once "../PHP/connect.php";

try {
    if(isset($_POST["editPreguntar"])){
        $titulo = htmlspecialchars($_POST["titulo"]);
        $cont = htmlspecialchars($_POST["contenido"]);

        $editP = "UPDATE tbl_post SET titulo_post=:titulo_post, contenido_post=:contenido_post WHERE id_post=:id_post;";
       
        $stmt = $pdo->prepare($editP);
        $stmt->bindParam(':titulo_post', $titulo);
        $stmt->bindParam(':contenido_post', $cont);
        $stmt->bindParam(':id_post', $post);
        $stmt->execute();
        
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    } elseif(isset($_POST["editRespuesta"])){
        $cont = htmlspecialchars($_POST["contenido"]);
        
        $editR = "UPDATE tbl_post SET ontenido_post=:contenido_post WHERE id_post=:id_post;";
       
        $stmt = $pdo->prepare($editR);
        $stmt->bindParam(':contenido_post', $cont);
        $stmt->bindParam(':id_post', $post);
        $stmt->execute();
        
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    } else {
        header('Location: ./index.php');
        exit;
    }

    header("Location: ../PAGES/preguntasUser.php");
    exit();

} catch (PDOException $e) {
    echo "Error de conexión con la base de datos:".$e->getMessage();
}
?>