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

$usuario = $_POST['usuario_login'];
$password = $_POST['password_login'];

$sql = "SELECT * FROM usuarios WHERE username='$usuario'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if ($password === $row['password']) {
        header("Location: welcome.html");
    } else {
        echo "<script>alert('Contraseña Incorrecta'); window.location.href = 'index.html';</script>";
    }
} else {
    echo "<script>alert('Usuario no encontrado'); window.location.href = 'index.html';</script>";
}

