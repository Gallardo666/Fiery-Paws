<!DOCTYPE html>
<html lang="es">
<?php
session_start(); // Inicia una nueva sesión o reanuda la existente

// Verifica si el usuario está autenticado
if (!isset($_SESSION['username'])) {
    // Redirige a la página de inicio de sesión si no está autenticado
    header("Location: index.php");
    exit(); // Termina el script para asegurarse de que no se ejecute más código
}
?>    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fiery Paws - Donation</title>
    <link rel="icon" href="Images/Logos/red-panda.png">
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
</head>
<body>
    <header>
        <h1>Fiery Paws</h1>
        <img src="Images/Logos/red-panda.png" alt="Logo">
    </header>
    <nav>
        <ul>
            <li><a href="index.php">Inicio</a></li>
            <li><a href="#contact">Contacto</a></li>
            <div class="auth-buttons">
                <?php if (isset($_SESSION['username'])): ?>
                    <!-- Muestra el nombre de usuario si está autenticado -->
                    <p><?php echo htmlspecialchars($_SESSION['username']); ?></p>
                    <!-- Botón para cerrar sesión -->
                    <button id="logoutBtn" onclick="window.location.href='logout.php'">Log Out</button>
                <?php else: ?>
                    <!-- Botones para iniciar sesión o registrarse si no está autenticado -->
                    <button id="openLoginModal">Sign In</button>
                    <button id="openRegisterModal">Sign Up</button>
                <?php endif; ?>
            </div>
        </ul>
    </nav>
    <main>
        <div class="content">
            <div class="donation-form">
                <div class="form-section">
                    <h2>Haz una Donación</h2>
                    <form action="process_donation.php" method="POST">
                        <label for="donor-name">Nombre:</label>
                        <input type="text" id="donor-name" name="donor_name" placeholder="Nombre (obligatorio)" required>
                        
                        <label for="donor-email">Email:</label>
                        <input type="email" id="donor-email" name="donor_email" placeholder="Email (obligatorio)" required>
                        
                        <label for="donor-phone">Teléfono:</label>
                        <input type="tel" id="donor-phone" name="donor_phone" placeholder="Teléfono (obligatorio)" required>
                        
                        <label for="donation-amount">Cantidad de Donación:</label>
                        <input type="number" id="donation-amount" name="donation_amount" placeholder="Cantidad de Donación (obligatorio)" required>
                        
                        <label for="donation-message">Mensaje:</label>
                        <textarea id="donation-message" name="donation_message" rows="4" placeholder="Mensaje (opcional)"></textarea>
                    </form>
                </div>
                <div class="form-section">
                    <h2>Información de Pago</h2>
                    <form action="process_donation.php" method="POST">
                        <label for="card-number">Número de Tarjeta:</label>
                        <input type="text" id="card-number" name="card_number" placeholder="Número de Tarjeta (obligatorio)" required>
                        
                        <label for="card-expiry">Fecha de Expiración (MM/AA):</label>
                        <input type="text" id="card-expiry" name="card_expiry" placeholder="MM/AA (obligatorio)" required>
                        
                        <label for="card-cvc">CVC:</label>
                        <input type="text" id="card-cvc" name="card_cvc" placeholder="CVC (obligatorio)" required>
                        
                        <button type="submit">Donar</button>
                    </form>
                </div>
            </div>
            <div class="impact-section">
                <h3>¿Cómo Ayudan Tus Donaciones?</h3>
                <p>Tus contribuciones nos permiten proteger a los pandas rojos, conservar su hábitat natural, y educar al público sobre la importancia de estas criaturas únicas. Cada donación marca una diferencia significativa en nuestros esfuerzos de conservación.</p>
            </div>
        </div>
    </main>
    <footer>
        <div class="footer-content">
            <div class="footer-left">
                <h3>Síguenos</h3>
                <div class="social-media">
                    <a href="https://www.instagram.com" target="_blank"><i class="fab fa-instagram"></i></a>
                    <a href="https://www.tiktok.com" target="_blank"><i class="fab fa-tiktok"></i></a>
                    <a href="https://www.youtube.com" target="_blank"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
            <div class="footer-center">
                <p>&copy; 2025 Fiery Paws. Todos los derechos reservados. Diseñado con pasión por la conservación.</p>
            </div>
            <div class="footer-right">
                <h3>Información</h3>
                <a href="#" id="openTermsModal">Términos y Condiciones</a>
                <a href="#" id="openPrivacyModal">Política de Privacidad</a>
            </div>
        </div>
    </footer>
</body>
</html>