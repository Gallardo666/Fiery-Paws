<?php
session_start();

function validatePassword($password) {
    // Define los criterios de la contraseña
    $minLength = 6;
    $hasNumber = preg_match('/[0-9]/', $password);
    $hasSpecialChar = preg_match('/[\W]/', $password); // Caracteres no alfanuméricos

    if (strlen($password) < $minLength) {
        return "La contraseña debe tener al menos $minLength caracteres.";
    }
    if (!$hasNumber) {
        return "La contraseña debe incluir al menos un número.";
    }
    if (!$hasSpecialChar) {
        return "La contraseña debe incluir al menos un carácter especial.";
    }
    return true;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $conn = new mysqli('localhost', 'root', '', 'users_db'); // Conexión a la base de datos
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    $username = $_POST['username'];
    $password = $_POST['password'];

    // Verificar si el nombre de usuario ya existe
    $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "Error: El nombre de usuario ya está registrado.";
        $stmt->close();
        $conn->close();
        exit; // Detener la ejecución si el usuario ya existe
    }
    $stmt->close();

    // Validar la contraseña
    $passwordValidationResult = validatePassword($password);
    if ($passwordValidationResult !== true) {
        echo $passwordValidationResult;
        $conn->close();
        exit; // Detener la ejecución si hay un error
    }

    // Cifrar la contraseña e insertar el usuario
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $hashedPassword);
    if ($stmt->execute()) {
        // Set session variables to log in the user
        $_SESSION['username'] = $username;
        echo "success";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
}
?>