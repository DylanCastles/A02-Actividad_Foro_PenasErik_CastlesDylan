<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "db_YOLOSE";

try {
    $pdo = new PDO("mysql:host=$host;dbname=db_yolose", $user, $password);
    
} catch (PDOException $e) {
    // Capturar cualquier excepción y mostrar el mensaje de error
    echo "Error en la conexión: " . $e->getMessage();
    echo "</br>";
    die("Conexión fallida.");
}

?>