<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");  // Si no está logueado, redirigir al login
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Protegida</title>
</head>
<body>
    <h2>Bienvenido, has podido entrar ! <?php echo $_SESSION['username']; ?>!</h2>
    <p>Esta es una sección protegida, solo accesible si has iniciado sesión.</p>
    <a href="logout.php">Cerrar sesión</a>
</body>
</html>
