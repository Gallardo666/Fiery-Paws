<!DOCTYPE html>
<html lang="es">
<?php
session_start();

// Check if the user is authenticated
if (!isset($_SESSION['username'])) {
    // Redirect to the login page if not authenticated
    header("Location: index.php");
    exit();
}
?>    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fiery Paws - Donation</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap');
        body, html {
            font-family: 'Roboto', sans-serif;
            scroll-behavior: smooth;
            height: 100%;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            grid-template-rows: auto 1fr auto;
            background: linear-gradient(135deg, #2e1a1a, #d94e4e);
            color: #f0f0f0;
            overflow-y: scroll; /* Ensure vertical scrolling */
            scrollbar-width: thin; /* For Firefox */
            scrollbar-color: #d94e4e #2e1a1a; /* For Firefox */
        }
        /* Custom scrollbar styles */
        ::-webkit-scrollbar {
            width: 12px;
            height: 12px;
        }
        ::-webkit-scrollbar-track {
            background: #2e1a1a;
        }
        ::-webkit-scrollbar-thumb {
            background-color: #d94e4e;
            border-radius: 4px;
            border: 2px solid #2e1a1a;
            box-shadow: inset 0 0 5px rgba(0, 0, 0, 0.2);
        }
        ::-webkit-scrollbar-thumb:hover {
            background-color: #b33a3a;
        }
        .background {
            position: fixed;
            width: 100%;
            height: 100%;
            background: #2e1a1a;
            z-index: 0;
            overflow: hidden;
        }
        svg {
            width: 100%;
            height: 100%;
        }
        .hexagon {
            fill: none;
            stroke: #d94e4e;
            stroke-width: 2;
            transition: transform 0.5s ease-out;
            transform-origin: center;
            filter: drop-shadow(0 0 5px #d94e4e);
        }
        header {
            background-color: rgb(177, 65, 65);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            color: white;
            width: 100%;
            height: 100vh;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 40px;
            text-align: left;
            position: relative;
            z-index: 2;
            box-sizing: border-box;
        }
        header h1 {
            font-size: 10rem;
            margin-left: 5%;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }
        header img {
            width: 16rem;
            height: 16rem;
            margin-right: 10%;
        }
        nav {
            background-color: rgba(217, 78, 78, 0.9);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 2;
            width: 100%;
            backdrop-filter: blur(10px);
        }
        nav ul {
            list-style-type: none;
            padding: 10px 0;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        nav ul li {
            margin: 0 15px;
        }
        nav ul li a, nav ul li button {
            color: white;
            text-decoration: none;
            background: none;
            border: none;
            cursor: pointer;
            font-size: 16px;
            transition: color 0.3s ease, transform 0.3s ease;
        }
        nav ul li a:hover, nav ul li button:hover {
            color: #ffcccb;
            transform: scale(1.1);
        }
        .auth-buttons {
            display: flex;
            gap: 15px;
            margin-left: auto;
            align-items: center;
        }
        .auth-buttons p {
            margin: 0;
            color: #ffcccb;
            font-weight: bold;
        }
        .auth-buttons button {
            background-color: #ffcccb;
            color: #2e1a1a;
            padding: 10px 15px;
            border-radius: 8px;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
            border: 2px solid #ffcccb;
            box-shadow: 0 0 10px #ffcccb;
            margin-right: 10px;
            width: 100px;
            height: 40px;
        }
        .auth-buttons button:hover {
            background-color: transparent;
            color: #ffcccb;
            box-shadow: 0 0 20px #ffcccb;
        }
        main {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 60px 20px;
            background-color: rgba(37, 37, 37, 0.973);
            color: #dcdcdc;
            box-sizing: border-box;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
            z-index: 1;
            position: relative;
            max-width: 1200px;
            margin: 20px auto ; 
            animation: slideIn 1s ease-out;
            overflow: visible; /* Allow content to overflow */
        }
        .donation-form {
            background-color: #2e1a1a;
            padding: 40px 60px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            color: #f0f0f0;
            max-width: 800px;
            margin: 0 auto;
            position: relative;
            display: flex;
            justify-content: space-between;
            gap: 120px;
        }
        .form-section {
            flex: 1;
        }
        .donation-form h2 {
            color: #ffcccb;
            text-align: center;
            margin-bottom: 20px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }
        .donation-form label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }
        .donation-form input, .donation-form textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 4px;
            border: 1px solid #ccc;
            box-sizing: border-box;
            background-color: rgba(255, 255, 255, 0.1);
            color: #f0f0f0;
        }
        .donation-form input[type="number"]::-webkit-outer-spin-button,
        .donation-form input[type="number"]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .donation-form textarea {
            resize: none;
            overflow-y: auto;
        }
        .donation-form button {
            background-color: #ffcccb;
            color: #2e1a1a;
            padding: 10px 20px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
            width: 100%;
            box-shadow: 0 0 10px #ffcccb;
        }
        .donation-form button:hover {
            background-color: transparent;
            color: #ffcccb;
            box-shadow: 0 0 20px #ffcccb;
        }
        .impact-section {
            margin-top: 40px;
            text-align: center;
            padding: 20px;
            background-color: rgba(46, 26, 26, 0.8);
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .impact-section h3 {
            color: #ffcccb;
            margin-bottom: 20px;
        }
        .impact-section p {
            line-height: 1.6;
        }
        footer {
            background-color: #d94e4e;
            color: white;
            padding: 20px 0;
            position: relative;
            z-index: 2;
            box-sizing: border-box;
            flex-shrink: 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .footer-content {
            display: flex;
            justify-content: space-between;
            width: 100%;
            align-items: center;
        }
        .footer-links a, .social-media a {
            color: white;
            text-decoration: none;
            margin: 0 10px;
            transition: color 0.3s ease;
        }
        .footer-links a:hover, .social-media a:hover {
            color: #fab9b8;
        }
        .stars {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            overflow: hidden;
        }
        .star {
            position: absolute;
            width: 0;
            height: 0;
            border-left: 5px solid transparent;
            border-right: 5px solid transparent;
            border-bottom: 10px solid #ffcccb;
            transform-origin: bottom center;
            transform: rotate(35deg);
            animation: moveStar 15s linear infinite, twinkle 3s ease-in-out infinite;
        }
        .star:before {
            content: '';
            position: absolute;
            top: -7px;
            left: -5px;
            width: 0;
            height: 0;
            border-left: 5px solid transparent;
            border-right: 5px solid transparent;
            border-bottom: 10px solid #ffcccb;
            transform-origin: bottom center;
            transform: rotate(-70deg);
        }
        .star:after {
            content: '';
            position: absolute;
            top: -3px;
            left: -5px;
            width: 0;
            height: 0;
            border-left: 5px solid transparent;
            border-right: 5px solid transparent;
            border-bottom: 10px solid #ffcccb;
            transform-origin: bottom center;
            transform: rotate(70deg);
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        @keyframes slideIn {
            from { transform: translateY(20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
        @keyframes moveStar {
            0% { transform: translate(0, 0) rotate(35deg); opacity: 0; }
            10% { opacity: 1; }
            90% { opacity: 1; }
            100% { transform: translate(200px, 200px) rotate(35deg); opacity: 0; }
        }
        @keyframes twinkle {
            0%, 100% { opacity: 0.5; }
            50% { opacity: 1; }
        }
    </style>
</head>
<body>
    <div class="background">
        <svg id="grid"></svg>
    </div>
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
                    <p><?php echo htmlspecialchars($_SESSION['username']); ?></p>
                    <button id="logoutBtn" onclick="window.location.href='logout.php'">Log Out</button>
                <?php else: ?>
                    <button id="openLoginModal">Sign In</button>
                    <button id="openRegisterModal">Sign Up</button>
                <?php endif; ?>
            </div>
        </ul>
    </nav>
    <main>
        <div class="stars" id="stars"></div>
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
    </main>
    <footer>
        <div class="footer-content">
            <div class="footer-left">
                <div class="social-media">
                    <a href="https://www.instagram.com" target="_blank"><i class="fab fa-instagram"></i></a>
                    <a href="https://www.tiktok.com" target="_blank"><i class="fab fa-tiktok"></i></a>
                    <a href="https://www.youtube.com" target="_blank"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
            <div class="footer-center">
                <p>&copy; 2023 Fiery Paws</p>
            </div>
            <div class="footer-right">
                <div class="footer-links">
                    <a href="privacy.html">Términos de Privacidad</a><br>
                    <a href="terms.html">Términos y Condiciones</a>
                </div>
            </div>
        </div>
    </footer>
    <script>
        window.addEventListener('load', () => {
            const starsContainer = document.getElementById('stars');
            const starCount = 30; // Number of stars

            for (let i = 0; i < starCount; i++) {
                const star = document.createElement('div');
                star.className = 'star';
                star.style.left = `${Math.random() * 100}%`;
                star.style.top = `${Math.random() * 100}%`;
                star.style.animationDuration = `${Math.random() * 15 + 10}s`;
                star.style.animationDelay = `${Math.random() * 5}s`;
                starsContainer.appendChild(star);
            }

            createGrid();
        });

        const svg = document.getElementById('grid');
        const width = window.innerWidth;
        const height = window.innerHeight;
        const size = 125;

        function createGrid() {
            const hexHeight = Math.sqrt(3) * size;
            for (let y = 0; y < height + hexHeight; y += hexHeight * 0.75) {
                for (let x = 0; x < width + size; x += size * 1.5) {
                    const offsetX = (y / (hexHeight * 0.75)) % 2 === 0 ? 0 : size * 0.75;
                    const points = createHexagonPoints(x + offsetX, y, size);
                    const hexagon = document.createElementNS('http://www.w3.org/2000/svg', 'polygon');
                    hexagon.setAttribute('class', 'hexagon');
                    hexagon.setAttribute('points', points);
                    svg.appendChild(hexagon);
                }
            }
        }

        function createHexagonPoints(cx, cy, size) {
            const angle = Math.PI / 3;
            let points = '';
            for (let i = 0; i < 6; i++) {
                const x = cx + size * Math.cos(angle * i);
                const y = cy + size * Math.sin(angle * i);
                points += `${x},${y} `;
            }
            return points.trim();
        }

        // Add mousemove event to animate hexagons
        document.addEventListener('mousemove', (e) => {
            const { clientX, clientY } = e;
            document.querySelectorAll('.hexagon').forEach(hexagon => {
                const points = hexagon.getAttribute('points').split(' ')[0].split(',');
                const hx = parseFloat(points[0]);
                const hy = parseFloat(points[1]);
                const dx = clientX - hx;
                const dy = clientY - hy;
                const dist = Math.sqrt(dx * dx + dy * dy);
                const scale = Math.max(1, 1.2 - dist / 500);
                const translateX = -dx / dist * 5;
                const translateY = -dy / dist * 5;
                hexagon.style.transform = `scale(${scale}) translate(${translateX}px, ${translateY}px)`;
            });
        });
    </script>
</body>
</html>