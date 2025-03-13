<?php
session_start();

// Verificar si el usuario está logueado
if (isset($_SESSION['username'])) {
    echo "logged_in";  // Si está logueado, devolvemos "logged_in"
} else {
    echo "not_logged_in";  // Si no está logueado, devolvemos "not_logged_in"
}
?>
