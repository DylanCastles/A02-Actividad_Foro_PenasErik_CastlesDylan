<?php
if (!isset($_POST["submitLogin"])) {
    header("Location: ../PAGES/index.php");
}

session_start();
include_once "../PHP/connect.php";

$email = htmlspecialchars($_POST["email"]);
$pwd = htmlspecialchars($_POST["pwd"]);

try {
    $consultaEmail = "SELECT * from tbl_users WHERE email_user = :email_user;";
    $stmt = $pdo->prepare($consultaEmail);
    $stmt->bindParam(':email_user', $email);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    $errores = false;

    if (!($result && count($result) > 0)) {
        $errores = true;
    }

    $pwdBBDD = $result['pwd_user'];

    // Verificar la contraseña usando password_verify
    if (!password_verify($pwd, $pwdBBDD)) {
        $errores = true;
    }

    // Si todo es correcto, redirigir al usuario a la página de recepción
    if ($errores) {
        header("Location: ../PAGES/login.php?error=BBDDmal");
        exit();
    } else {
        $_SESSION['usuarioConectado'] = $result['id_user'];
        header("Location: ../PAGES/index.php");
        exit();
    }

} catch (PDOException $e) {
    echo "Error de conexión con la base de datos:".$e->getMessage();
}
?>