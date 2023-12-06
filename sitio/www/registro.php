<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "miapp";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$usuario = $_POST['usuario'];
$password = $_POST['password'];

$sql = "INSERT INTO usuarios (username, password) VALUES ('$usuario', '$password')";

if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Usuario agregado exitosamente'); window.location.href = 'index.html';</script>";
} else {
    echo "Error al registrar el usuario: " . $conn->error;
}

$conn->close();
?>
