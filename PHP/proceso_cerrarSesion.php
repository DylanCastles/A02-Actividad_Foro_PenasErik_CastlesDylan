<?php
session_start();

if (!isset($_SESSION['usuarioConectado'])) {
    header('Location: ../PAGES/index.php');
    exit;
}

session_unset();

session_destroy();

header('Location: ../PAGES/index.php');
exit();
?>