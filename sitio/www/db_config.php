<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "miapp";

// Crea una conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $database);

// Verifica si la conexión es exitosa
if ($conn->connect_error) {
    die("La conexión a la base de datos falló: " . $conn->connect_error);
}
?>
