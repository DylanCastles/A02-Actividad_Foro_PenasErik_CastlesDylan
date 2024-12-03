<?php
$host = "localhost";
$user = "root";
$password = "1234";
$dbname = "db_YOLOSE";

try {
    $pdo = new PDO("mysql:host=$host;dbname=db_yolose", $user, $password);
    
} catch (PDOException $e) {
    // Capturar cualquier excepción y mostrar el mensaje de error
    echo "Error en la conexión: " . $e->getMessage();
    echo "</br>";
    die("Conexión fallida.");
}
echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">';
?>