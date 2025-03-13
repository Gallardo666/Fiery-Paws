<?php
session_start();

// Función para validar la contraseña
function validatePassword($password) {
    $minLength = 8;
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

// Si el formulario se envió
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $conn = new mysqli('localhost', 'root', '', 'users_db'); // Conexión a la base de datos
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validar la contraseña
    $passwordValidationResult = validatePassword($password);
    $message = '';

    if ($passwordValidationResult !== true) {
        $message = $passwordValidationResult;
    } else {
        // Cifrar la contraseña
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (username, password) VALUES ('$username', '$hashedPassword')";
        if ($conn->query($sql) === TRUE) {
            $message = "Usuario registrado con éxito. <a href='login.php'>Inicia sesión aquí</a>";
        } else {
            $message = "Error: " . $conn->error;
        }
    }
    $conn->close();
}
?>
    
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fiery Paws - Home</title>
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
            background-color: transparent;
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
        }
        
        header img{
            width: 16rem;
            height: 16rem;
            margin-right: 10%;
        }
        nav {
            background-color: #d94e4e;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 2;
            width: 100%;
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
        }
        .auth-buttons {
    display: flex;
    gap: 15px;
    margin-left: auto;
    background-color: rgba(255, 0, 0, 0.2); /* Fondo temporal para verificar visibilidad */
}

.auth-buttons button {
    background-color: #ffcccb;
    color: #2e1a1a;
    padding: 10px 20px;
    border-radius: 8px;
    transition: background-color 0.3s ease, box-shadow 0.3s ease;
    position: relative;
    overflow: hidden;
    border: 2px solid #ffcccb;
    box-shadow: 0 0 10px #ffcccb;
    margin-right: 20px;
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
            justify-content: space-between;
        }
                
        .content {
            flex: 1;
            padding: 20px;
            background-color: #252525; /* Dark gray background */
            margin: 0 auto;
            width: 90%; /* Set width to 90% to leave space on the sides */
            max-width: 1200px; /* Maximum width for the sheet effect */
            min-height: calc(100vh - 60px); /* Adjust according to the footer size */
            color: #dcdcdc;
            box-sizing: border-box;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Optional: Add a shadow for depth */
            border-radius: 8px; /* Optional: Add rounded corners */
            z-index: 1; /* Ensure it appears above the background */
            position: relative; /* Ensure it is positioned correctly */
        }
        .content img {
            width: 25rem;
            height: 25rem;
            object-fit: cover;
        }
            
        section {
            position: relative;
            margin: 40px 0;
            padding: 30px;
            color: #f0f0f0;
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.6s ease-out, transform 0.6s ease-out;
            min-height: 100vh;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }
        section.active {
            opacity: 1;
            transform: translateY(0);
        }
        section h2 {
            font-size: 2.5rem;
            margin-bottom: 20px;
            color: #ffcccb;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            animation: fadeIn 1s ease-out;
        }
        section p {
            line-height: 1.8;
            margin-bottom: 20px;
            font-size: 1.1rem;
            animation: fadeIn 1.5s ease-out;
            max-width: 800px;
        }
        section img {
            width: 100%;
            max-width: 500px;
            height: auto;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            margin: 20px 0;
            transition: transform 0.3s ease;
        }
        section img:hover {
            transform: scale(1.05);
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .image-container {
            display: flex;
            justify-content: center;
            gap: 20px; /* Space between images */
            margin-top: 20px;
        }
        .image-container img {
            width: 45%; /* Adjust width as needed */
            max-width: 500px;
            height: auto;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease;
        }
        .image-container img:hover {
            transform: scale(1.05);
        }
        /* Specific styles for the gallery section */
        #gallery {
            opacity: 1 !important; /* Ensure full opacity */
            transform: scale(1) !important; /* Ensure no scaling */
        }
        .gallery {
            display: flex;
            justify-content: center; /* Center images in the gallery */
            overflow: hidden; /* Prevent horizontal scrolling */
            gap: 20px; /* Increase space between images */
            padding: 20px 30px; /* Add padding to the gallery */
        }
        .gallery img {
            width: 130px; /* Initial width */
            height: 180px; /* Initial height */
            object-fit: cover; /* Ensure images cover the container without stretching */
            object-position: center; /* Center the image within the container */
            transition: transform 0.3s ease; /* Smooth transition for transform */
            cursor: pointer;
            flex-shrink: 0; /* Prevent images from shrinking */
        }
        .gallery img:hover {
            transform: scale(1.25); /* Scale image uniformly */
        }
        footer {
            background-color: #d94e4e;
            color: white;
            margin-bottom: -100rem;
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
    
        .footer-left, .footer-center, .footer-right {
            display: flex;
            align-items: center;
        }
    
        .footer-left {
            justify-content: flex-start;
        }
    
        .footer-center {
            justify-content: center;
        }
    
        .footer-right {
            justify-content: flex-end;
        }
    
        .footer-links a, .social-media a {
            color: white;
            text-decoration: none;
            margin: 0 10px;
            transition: color 0.3s ease;
        }
    
        .footer-links a {
            margin-right: 2rem;
            margin-bottom: 2px;  /* Aquí ajustas el espacio entre los enlaces */
            color: white;
            text-decoration: none;
            display: block;
            transition: color 0.3s ease;
        }
    
    
        .footer-links a:hover, .social-media a:hover {
            color: #fab9b8;
        }
    
        /* Social Media Icons */
        .social-media a {
            font-size: 24px;
            margin-right: 20px;
            transition: transform 0.3s ease;
        }
    
        .social-media a:hover {
            transform: scale(1.2);
        }

        /* Fondo del modal: oscuro y con desenfoque */
/* Estilos para el Modal */
.modal {
    position: fixed;
    top: 0;
    z-index: 5;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.7); /* Darkens the background */
    display: none;
    align-items: center;
    justify-content: center;
}

/* Contenedor del modal */
.modal-content {
    position: relative;
    background: rgba(20, 20, 20, 1); /* Fondo oscuro opaco */
    color: #f1f1f1;
    padding: 30px;
    width: 80%;
    max-width: 450px;
    border-radius: 12px;
    text-align: center;
    border: 2px solid rgba(255, 255, 255, 0.1); /* Borde sutil */
    box-shadow: 0 0 30px rgba(255, 0, 0, 0.6); /* Iluminación roja en el borde */
}

/* Efecto de iluminación alrededor del modal */
.modal-content::before {
    content: "";
    position: absolute;
    top: -10px;
    left: -10px;
    width: calc(100% + 20px);
    height: calc(100% + 20px);
    border-radius: 12px;
    background: radial-gradient(circle, rgba(255, 0, 0, 0.4) 20%, transparent 80%);
    z-index: -1;
    box-shadow: 0 0 40px rgba(255, 0, 0, 0.8); /* Glow rojo más intenso */
}

/* Botón estilizado */
.modal-content button {
    background-color: var(--modal-button-bg);
    color: #fff;
    padding: 12px 25px;
    border-radius: 8px;
    border: 2px solid var(--modal-button-bg);
    box-shadow: 0 0 15px var(--modal-button-bg);
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.2s;
    width: 100%;
    font-size: 16px;
}

.modal-content button:hover {
    background-color: var(--modal-button-hover-bg);
    color: var(--modal-button-bg);
    transform: scale(1.05);
}

/* Centrar contenido */
.modal-content h2 {
    margin-bottom: 20px;
    font-size: 24px;
}

.modal-content form {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

/* Botón de cerrar */
.close {
    position: absolute;
    top: 15px;
    right: 15px;
    color: #bbb;
    font-size: 24px;
    font-weight: bold;
    cursor: pointer;
    transition: color 0.3s;
}

.close:hover {
    color: #fff;
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
            <li><a href="#about">Inicio</a></li>
            <li><a href="#habitat">Hábitat</a></li>
            <li><a href="#behavior">Comportamiento</a></li>
            <li><a href="#conservation">Conservación</a></li>
            <li><a href="#gallery">Galería</a></li>
            <div class="auth-buttons">
                <?php if (isset($_SESSION['username'])): ?>
                    <p><?php echo htmlspecialchars($_SESSION['username']); ?></p> <!-- Solo el nombre -->
                    <a href="adoption.php">
                        <button>Donación</button>
                    </a>
                    <!-- Cambié la redirección a un evento de JavaScript -->
                    <button id="logoutBtn" style="display:none;" onclick="logout()">Log Out</button>
                <?php else: ?>
                    <button id="openLoginModal">Sign In</a></button>
                    <button id="openRegisterModal">Sign Up</button>
                <?php endif; ?>
            </div>

        </ul>
    </nav>
    <main>
        <div class="content">
            <section id="about">
                <h2>Sobre los Pandas Rojos</h2>
                <p>Los pandas rojos son mamíferos nativos del Himalaya oriental y el suroeste de China. Son conocidos por su pelaje rojizo y su cola anillada.</p>
                <p>Estos animales son únicos en su especie, con características que los distinguen de otros mamíferos. Su dieta principal consiste en bambú, pero también se alimentan de frutas, insectos y pequeños mamíferos. Los pandas rojos son excelentes trepadores y pasan la mayor parte de su tiempo en los árboles.</p>
                <img src="Images/PandaInfo/PandaRojo.jpg" alt="Panda Rojo">
            </section>
            <section id="habitat">
                <h2>Hábitat de los Pandas Rojos</h2>
                <p>Los pandas rojos habitan en los bosques templados del Himalaya oriental y el suroeste de China. Prefieren áreas con abundante bambú, que es su principal fuente de alimento.</p>
                <p>Estos bosques ofrecen el clima fresco y húmedo que los pandas rojos necesitan para sobrevivir. La conservación de su hábitat es crucial para su supervivencia, ya que la deforestación y el cambio climático amenazan su entorno natural.</p>
                <img src="Images/PandaInfo/HabitatPandaRojo.jpeg" alt="Hábitat de los Pandas Rojos">
            </section>
            <section id="behavior">
                <h2>Comportamiento y Dieta</h2>
                <p>Los pandas rojos son animales solitarios y nocturnos. Pasan la mayor parte del tiempo en los árboles y se alimentan principalmente de bambú, aunque también comen frutas e insectos.</p>
                <p>Son conocidos por su comportamiento tranquilo y reservado. Durante el día, descansan en las ramas de los árboles, y por la noche, se vuelven más activos en busca de alimento. Su dieta rica en fibra requiere que pasen muchas horas comiendo.</p>
                <img src="Images/PandaInfo/FrutaBambu.jpeg" alt="Comportamiento de los Pandas Rojos">
            </section>
            <section id="conservation">
                <h2>Conservación y Amenazas</h2>
                <p>Los pandas rojos están clasificados como una especie en peligro de extinción. Las principales amenazas incluyen la pérdida de hábitat, el cambio climático y la caza furtiva.</p>
                <p>Es vital que se implementen esfuerzos de conservación para proteger a estos animales. Las organizaciones de conservación trabajan para preservar su hábitat natural y crear conciencia sobre la importancia de proteger a los pandas rojos.</p>
                <div class="image-container">
                    <img src="Images/PandaInfo/CazaFurtiva.jpg" alt="Caza de los Pandas Rojos">
                    <img src="Images/PandaInfo/PerdidaHabitat.jpg" alt="Pérdida de Hábitat de los Pandas Rojos">
                </div>
            </section>
            <section id="gallery">
                <h2>Galería de Pandas Rojos</h2>
                <p>Disfruta de nuestra colección de fotos y videos de pandas rojos en su hábitat natural.</p>
                <div class="gallery">
                    <img src="Images/PandaInfo/PandaRojo1.jpg" alt="Panda Rojo 1">
                    <img src="Images/PandaInfo/PandaRojo2.jpg" alt="Panda Rojo 2">
                    <img src="Images/PandaInfo/PandaRojo3.jpg" alt="Panda Rojo 3">
                    <img src="Images/PandaInfo/PandaRojo4.jpg" alt="Panda Rojo 4">
                    <img src="Images/PandaInfo/PandaRojo5.jpeg" alt="Panda Rojo 5">
                    <img src="Images/PandaInfo/" alt="Panda Rojo 6">
                    <img src="Images/PandaInfo/PandaRojo7.jpg" alt="Panda Rojo 7">
                </div>
            </section>
        </div>
    </main>
    <footer>
        <div class="footer-content">
            <!-- Left: Redes Sociales de Empresas -->
            <div class="footer-left" style="margin-left: 30px;">
                <div class="social-media">
                    <a href="https://www.instagram.com" target="_blank"><i class="fab fa-instagram"></i></a>
                    <a href="https://www.tiktok.com" target="_blank"><i class="fab fa-tiktok"></i></a>
                    <a href="https://www.youtube.com" target="_blank"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
    
            <!-- Center: Copyright -->
            <div class="footer-center">
                <p>&copy; 2023 Fiery Paws</p>
            </div>
    
            <!-- Right: Términos y condiciones (Vertical) -->
            <div class="footer-right">
                <div class="footer-links">
                    <a href="privacy.html">Términos de Privacidad</a><br>
                    <a href="terms.html">Términos y Condiciones</a>
                </div>
            </div>
        </div>
    </footer>
    
    <!-- Login Modal -->
    <div id="loginModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Sing In</h2>
            <form>
                <label for="login-username">Nombre de usuario:</label>
                <input type="text" id="login-username" name="username" required>
                <label for="login-password">Contraseña:</label>
                <input type="password" id="login-password" name="password" required>
                <button type="submit">Iniciar Sesión</button>
            </form>
        </div>
    </div>

    <!-- Register Modal -->
    <div id="registerModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Sign Up</h2>
            <form action="index.php" method="POST">
                <label for="reg-username">Nombre de usuario:</label>
                <input type="text" id="reg-username" name="username" required>
                <label for="reg-password">Contraseña:</label>
                <input type="password" id="reg-password" name="password" required>
                <button type="submit">Registrarse</button>
            </form>
        </div>
    </div>

    <script>
    const svg = document.getElementById('grid');
    const width = window.innerWidth;
    const height = window.innerHeight;
    const size = 100;

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

    createGrid();

    // Movimiento Hexágonos
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

    // Modals
    const registerModal = document.getElementById("registerModal");
    const loginModal = document.getElementById("loginModal");
    const openRegisterBtn = document.getElementById("openRegisterModal");
    const openLoginBtn = document.getElementById("openLoginModal");
    const closeBtns = document.querySelectorAll(".close");

    openRegisterBtn.onclick = function() {
        registerModal.style.display = "flex";  // Usar "flex" para centrar el modal
    }

    openLoginBtn.onclick = function() {
        loginModal.style.display = "flex";  // Usar "flex" para centrar el modal
    }

    closeBtns.forEach(btn => {
        btn.onclick = function() {
            registerModal.style.display = "none";
            loginModal.style.display = "none";
        }
    });

    window.onclick = function(event) {
        if (event.target == registerModal) {
            registerModal.style.display = "none";
        }
        if (event.target == loginModal) {
            loginModal.style.display = "none";
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        const sections = document.querySelectorAll('section');
            
        const options = {
            root: null,
            rootMargin: '0px 0px -40% 0px', // Adjusted to trigger earlier
            threshold: 0.1 // Lower threshold for more consistent activation
        };
    
        const observer = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('active');
                } else {
                    entry.target.classList.remove('active');
                }
            });
        }, options);
    
        sections.forEach(section => {
            observer.observe(section);
        });
    });

    // Formulario Inicio Sesion
    document.addEventListener('DOMContentLoaded', () => {
        const loginModal = document.getElementById("loginModal");
        const openLoginBtn = document.getElementById("openLoginModal");
        const closeBtns = document.querySelectorAll(".close");
        const logoutBtn = document.getElementById("logoutBtn");

        // Mostrar el modal de login
        openLoginBtn.onclick = function() {
            loginModal.style.display = "flex";  // Usar "flex" para centrar el modal
        };

        // Cerrar el modal de login
        closeBtns.forEach(btn => {
            btn.onclick = function() {
                loginModal.style.display = "none";
            };
        });

        window.onclick = function(event) {
            if (event.target == loginModal) {
                loginModal.style.display = "none";
            }
        };

        // Procesar el formulario de login con AJAX
        document.getElementById("loginForm").onsubmit = function(event) {
            event.preventDefault(); // Prevenir la acción predeterminada de envío del formulario

            const username = document.getElementById("login-username").value;
            const password = document.getElementById("login-password").value;

            const xhr = new XMLHttpRequest();
            xhr.open("POST", "login.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            // Enviar los datos del formulario
            xhr.onload = function() {
                if (xhr.status == 200) {
                    const response = xhr.responseText.trim();
                    if (response == "success") {
                        // Si el inicio de sesión es exitoso, mostrar el nombre y cambiar el botón
                        alert("Inicio de sesión exitoso");
                        loginModal.style.display = "none"; // Cerrar el modal
                        document.querySelector('.auth-buttons').innerHTML = `
                            <p>${username}</p> <!-- Mostrar el nombre del usuario -->
                            <button id="logoutBtn" onclick="logout()">Log Out</button>
                        `;
                        logoutBtn.style.display = "block";  // Mostrar el botón de logout
                    } else {
                        alert("Error: Usuario o contraseña incorrectos");
                    }
                } else {
                    alert("Error al procesar el inicio de sesión");
                }
            };

            xhr.send("username=" + encodeURIComponent(username) + "&password=" + encodeURIComponent(password));
        };

        // Verificar si el usuario ya está logueado al cargar la página
        checkLoginStatus();
    });

    function checkLoginStatus() {
        // Realizar una petición para verificar si el usuario está logueado
        const xhr = new XMLHttpRequest();
        xhr.open("GET", "check_login.php", true); // check_login.php verificará si hay una sesión activa
        xhr.onload = function() {
            if (xhr.status == 200) {
                const response = xhr.responseText.trim();
                if (response == "logged_in") {
                    // El usuario está logueado, mostrar su nombre y el botón de logout
                    document.querySelector('.auth-buttons').innerHTML = `
                        <p>Bienvenido</p>
                        <button id="logoutBtn" onclick="logout()">Log Out</button>
                    `;
                    document.getElementById("logoutBtn").style.display = "block";
                }
            }
        };
        xhr.send();
    }

    function logout() {
        // Llamar al archivo PHP para cerrar la sesión
        const xhr = new XMLHttpRequest();
        xhr.open("GET", "logout.php", true);
        xhr.onload = function() {
            if (xhr.status == 200) {
                // Si la sesión se cierra, actualizar los botones
                alert("Sesión cerrada");
                document.querySelector('.auth-buttons').innerHTML = `
                    <button id="openLoginModal">Login</button>
                `;
                document.getElementById("logoutBtn").style.display = "none";
            }
        };
        xhr.send();
    }
</script>


    </body>
</html>
