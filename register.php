<?php
session_start();

function validatePassword($password) {
    // Define the password criteria
    $minLength = 6;
    $hasNumber = preg_match('/[0-9]/', $password);
    $hasSpecialChar = preg_match('/[\W]/', $password); // Non-word characters

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

    // Validate the password
    $passwordValidationResult = validatePassword($password);
    if ($passwordValidationResult !== true) {
        echo $passwordValidationResult;
    } else {
        // Cifrar la contraseña
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (username, password) VALUES ('$username', '$hashedPassword')";
        if ($conn->query($sql) === TRUE) {
            echo "Usuario registrado con éxito. <a href='login.php'>Inicia sesión aquí</a>";
        } else {
            echo "Error: " . $conn->error;
        }
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
</head>
<body>
    <h2>Formulario de Registro</h2>
    <form action="register.php" method="POST">
        <label for="username">Usuario:</label>
        <input type="text" name="username" required><br>
        <label for="password">Contraseña:</label>
        <input type="password" name="password" required><br>
        <input type="submit" value="Registrarse">
    </form>
</body>
</html>
