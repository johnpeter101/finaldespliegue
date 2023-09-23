<?php
// Configura la conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$database = "miapp";

$conn = new mysqli($servername, $username, $password, $database);

// Verifica si la conexión es exitosa
if ($conn->connect_error) {
    die("La conexión a la base de datos falló: " . $conn->connect_error);
}

// Obtiene los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Consulta la base de datos para verificar las credenciales
    $sql = "SELECT * FROM usuarios WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Inicio de sesión exitoso
        header("Location: welcome.html");
    } else {
        // Credenciales incorrectas
        echo "Nombre de usuario o contraseña incorrectos.";
    }
}

$conn->close();
?>
