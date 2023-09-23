<?php
// Verificar si se ha enviado una solicitud POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Obtener los datos del usuario del cuerpo de la solicitud
    $data = json_decode(file_get_contents("php://input"));

    // Verificar si se recibieron datos válidos
    if ($data && isset($data->newUsername) && isset($data->newPassword)) {
        // Conectar a la base de datos (reemplaza con tus propias credenciales)
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "miapp";

        $conn = new mysqli($servername, $username, $password, $database);

        // Verificar la conexión
        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }

        // Escapar y hashear la contraseña (se recomienda utilizar hash seguro)
        $newUsername = $conn->real_escape_string($data->newUsername);
        $hashedPassword = password_hash($data->newPassword, PASSWORD_BCRYPT);

        // Insertar el nuevo usuario en la base de datos
        $sql = "INSERT INTO usuarios (username, password) VALUES ('$newUsername', '$hashedPassword')";

        if ($conn->query($sql) === TRUE) {
            // Usuario agregado con éxito
            $response = ["success" => true, "message" => "Usuario agregado con éxito."];
        } else {
            // Error al agregar el usuario
            $response = ["success" => false, "message" => "Error al agregar el usuario: " . $conn->error];
        }

        // Cerrar la conexión a la base de datos
        $conn->close();

        // Devolver la respuesta como JSON
        header("Content-Type: application/json");
        echo json_encode($response);
    } else {
        // Si los datos no son válidos, devuelve un mensaje de error
        $response = ["success" => false, "message" => "Datos de usuario no válidos."];
        header("Content-Type: application/json");
        echo json_encode($response);
    }
} else {
    // Si no se recibió una solicitud POST, muestra un mensaje de error
    echo "Acceso no autorizado.";
}
?>
