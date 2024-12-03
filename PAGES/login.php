<?php
include_once "../PHP/connect.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../STYLES/estilos.css">
</head>
<body class="body-login">
    <!-- Oscurecer el fondo -->
    <div class="login"></div>

    <!-- Formulario de Login -->
    <div class="login-form container-sm">
        <div id="contenedorLogoModal"><a href="./index.php" id="logo"><img src="../img/logo.png" id="logoFoto"></a></div>
        <form action="../PHP/proceso_login.php" method="post">
            <div class="mb-3">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input type="text" name="email" class="form-control" id="email" placeholder="Ingresa tu correo">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" name="pwd" class="form-control" id="password" placeholder="Ingresa tu contraseña">
                <span style="color: red;"><?php if(isset($_GET["error"]) && $_GET["error"] = "BBDDmal"){echo "Usuario o contraseña incorrectos";} ?></span>
            </div>
            <button type="submit" name="submitLogin" class="btn btn-primary w-100">Iniciar Sesión</button>
        </form>
        <p class="text-center">
            ¿No tienes una cuenta? <a href="#" class="text-decoration-none">Regístrate</a>
        </p>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
