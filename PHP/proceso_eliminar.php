<?php
session_start();
if (!isset($_SESSION['usuarioConectado'])) {
    header('Location: ../PAGES/login.php');
    exit;
}

if (!isset($_GET["tipoPost"]) || !isset($_GET["idPost"])) {
    header('Location: ../PAGES/preguntasUser.php');
    exit;
}
$post = htmlspecialchars($_GET["tipoPost"]);
$id = htmlspecialchars($_GET["idPost"]);
include_once "../PHP/connect.php";

try {
    if($post === "pregunta"){
        $eliminarP = "DELETE FROM tbl_post WHERE ref_post = :ref_post OR id_post = :id_post;";
       
        $stmt = $pdo->prepare($eliminarP);
        $stmt->bindParam(':ref_post', $id);
        $stmt->bindParam(':id_post', $id);
        $stmt->execute();
    } elseif($post === "respuesta"){      
        $eliminarR = "DELETE FROM tbl_post WHERE id_post = :id_post";
       
        $stmt = $pdo->prepare($eliminarR);
        $stmt->bindParam(':id_post', $id);
        $stmt->execute();
    } else {
        header('Location: ../PAGES/index.php');
        exit;
    }

    header("Location: ../PAGES/preguntasUser.php");
    exit();
} catch (PDOException $e) {
    echo "Error de conexión con la base de datos:".$e->getMessage();
}
?>