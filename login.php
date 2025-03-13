<?php
session_start();

// Simulación de una base de datos
$usuarios = [
    "usuario1" => "password123",
    "usuario2" => "password456",
];

// Obtener datos del formulario
$username = $_POST['username'];
$password = $_POST['password'];

// Verificar las credenciales
if (isset($usuarios[$username]) && $usuarios[$username] == $password) {
    // Si las credenciales son correctas, inicia sesión
    $_SESSION['username'] = $username;
    echo "success";  // Devolver éxito
} else {
    echo "error";  // Devolver error
}
?>
