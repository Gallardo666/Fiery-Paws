<?php
session_start(); // Inicia una nueva sesión o reanuda la existente

// Verifica si el método de solicitud es POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Conexión a la base de datos
    $conn = new mysqli('localhost', 'root', '', 'users_db');

    // Verifica si hay un error de conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error); // Termina el script si hay un error
    }

    // Validar y limpiar entrada
    $username = trim($_POST['username']); // Elimina espacios en blanco al inicio y al final del nombre de usuario
    $password = trim($_POST['password']); // Elimina espacios en blanco al inicio y al final de la contraseña

    // Verifica si el nombre de usuario o la contraseña están vacíos
    if (empty($username) || empty($password)) {
        echo "Error: Usuario o contraseña incorrectos"; // Muestra un mensaje de error
        exit(); // Termina la ejecución del script
    }

    // Prepara una declaración para seleccionar la contraseña del usuario
    $stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username); // Vincula el parámetro del nombre de usuario
    $stmt->execute(); // Ejecuta la declaración
    $stmt->store_result(); // Almacena el resultado

    // Verifica si se encontró el usuario
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($hashedPassword); // Vincula el resultado de la contraseña cifrada
        $stmt->fetch(); // Obtiene el resultado

        // Verifica si la contraseña ingresada coincide con la contraseña cifrada
        if (password_verify($password, $hashedPassword)) {
            $_SESSION['username'] = $username; // Establece la variable de sesión para el usuario
            echo "success"; // Muestra un mensaje de éxito
        } else {
            echo "Error: Usuario o contraseña incorrectos"; // Muestra un mensaje de error si la contraseña no coincide
        }
    } else {
        echo "Error: Usuario o contraseña incorrectos"; // Muestra un mensaje de error si no se encuentra el usuario
    }

    $stmt->close(); // Cierra la declaración
    $conn->close(); // Cierra la conexión a la base de datos
}
?>