<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fiery Paws - Home</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
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
                    <p><?php echo htmlspecialchars($_SESSION['username']); ?></p>
                    <a href="donacion.php">
                        <button>Donación</button>
                    </a>
                    <button id="logoutBtn" onclick="window.location.href='logout.php'">Log Out</button>
                <?php else: ?>
                    <button id="openLoginModal">Sign In</button>
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
            <div class="footer-left" style="margin-left: 30px;">
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
    <!-- Login Modal -->
    <div id="loginModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Sign In</h2>
            <form id="loginForm">
                <label for="login-username">Nombre de usuario:</label>
                <input type="text" id="login-username" name="username" required>
                <label for="login-password">Contraseña:</label>
                <input type="password" id="login-password" name="password" required>
                <div id="loginMessage" class="modal-message"></div>
                <button type="submit">Iniciar Sesión</button>
            </form>
        </div>
    </div>
    <!-- Register Modal -->
    <div id="registerModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Sign Up</h2>
            <form id="registerForm" action="register.php" method="POST">
                <label for="reg-username">Nombre de usuario:</label>
                <input type="text" id="reg-username" name="username" required>
                <label for="reg-password">Contraseña:</label>
                <input type="password" id="reg-password" name="password" required>
                <div id="registerMessage" class="modal-message"></div>
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

        // Modales
        const registerModal = document.getElementById("registerModal");
        const loginModal = document.getElementById("loginModal");
        const openRegisterBtn = document.getElementById("openRegisterModal");
        const openLoginBtn = document.getElementById("openLoginModal");
        const closeBtns = document.querySelectorAll(".close");

        // Abrir el modal de registro (Sign Up)
        openRegisterBtn.onclick = function() {
            registerModal.style.display = "flex";
        }

        // Abrir el modal de inicio de sesión (Sign In)
        openLoginBtn.onclick = function() {
            loginModal.style.display = "flex";
        }

        // Cerrar ambos modales cuando se haga clic en el botón de cerrar
        closeBtns.forEach(btn => {
            btn.onclick = function() {
                registerModal.style.display = "none";
                loginModal.style.display = "none";
            }
        });

        // Cerrar el modal de Sign Up si haces clic fuera del área del modal
        window.onclick = function(event) {
            if (event.target === registerModal) {
                registerModal.style.display = "none";
            }
            if (event.target === loginModal) {
                loginModal.style.display = "none";
            }
        }

        // Asegurarnos de que todo esté listo una vez el DOM se haya cargado completamente
        document.addEventListener('DOMContentLoaded', () => {
            const sections = document.querySelectorAll('section');
                
            const options = {
                root: null,
                rootMargin: '0px 0px -40% 0px',
                threshold: 0.1
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

        document.getElementById("registerForm").onsubmit = function(event) {
            event.preventDefault();
                
            const username = document.getElementById("reg-username").value;
            const password = document.getElementById("reg-password").value;
            const registerMessage = document.getElementById("registerMessage");
                
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "register.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                
            xhr.onload = function() {
                if (xhr.status == 200) {
                    const response = xhr.responseText.trim();
                    const styles = getComputedStyle(document.documentElement);
                    if (response === "success") {
                        registerMessage.textContent = "Registro exitoso. Ahora puedes iniciar sesión";
                        registerMessage.style.color = styles.getPropertyValue('--message-success-color');
                    
                        setTimeout(() => {
                            registerModal.style.display = "none"; // Cierra el modal
                            window.location.reload(); // Recarga la página
                        }, 1500);
                    } else if (response) {
                        registerMessage.textContent = response;
                        registerMessage.style.color = styles.getPropertyValue('--message-error-color');
                    } else {
                        registerMessage.textContent = "Error: Respuesta inesperada del servidor.";
                        registerMessage.style.color = styles.getPropertyValue('--message-error-color');
                    }
                } else {
                    alert("Error al procesar el registro");
                }
            };
        
            xhr.send("username=" + encodeURIComponent(username) + "&password=" + encodeURIComponent(password));
        };
        
        document.getElementById("loginForm").onsubmit = function(event) {
            event.preventDefault();
        
            const username = document.getElementById("login-username").value.trim();
            const password = document.getElementById("login-password").value.trim();
            const loginMessage = document.getElementById("loginMessage");
        
            if (username === "" || password === "") {
                loginMessage.textContent = "Error: Todos los campos son obligatorios";
                loginMessage.style.color = styles.getPropertyValue('--message-error-color');
                return;
            }
        
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "login.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        
            xhr.onload = function() {
                if (xhr.status == 200) {
                    const response = xhr.responseText.trim();
                    const styles = getComputedStyle(document.documentElement);
                    if (response === "success") {
                        loginMessage.textContent = "Inicio de sesión exitoso";
                        loginMessage.style.color = styles.getPropertyValue('--message-success-color');
                    
                        setTimeout(() => {
                            document.querySelector('.auth-buttons').innerHTML = `
                                <p>${username}</p>
                                <a href="donacion.php">
                                    <button>Donación</button>
                                </a>
                                <button id="logoutBtn" onclick="window.location.href='logout.php'">Log Out</button>
                            `;
                            document.getElementById("loginModal").style.display = "none"; // Cierra el modal
                        }, 1000);
                    } else {
                        loginMessage.textContent = response;
                        loginMessage.style.color = styles.getPropertyValue('--message-error-color');
                    }
                } else {
                    loginMessage.textContent = "Error al procesar el inicio de sesión";
                    loginMessage.style.color = styles.getPropertyValue('--message-error-color');
                }
            };
        
            xhr.send(`username=${encodeURIComponent(username)}&password=${encodeURIComponent(password)}`);
        };
        
        
        
        document.getElementById("loginForm").onsubmit = function(event) {
            event.preventDefault();
        
            const username = document.getElementById("login-username").value.trim();
            const password = document.getElementById("login-password").value.trim();
            const loginMessage = document.getElementById("loginMessage");
        
            if (username === "" || password === "") {
                loginMessage.textContent = "Error: Todos los campos son obligatorios";
                return;
            }
        
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "login.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        
            xhr.onload = function() {
                if (xhr.status == 200) {
                    const response = xhr.responseText.trim();
                    if (response === "success") {
                        loginMessage.textContent = "Inicio de sesión exitoso";
                        
                        setTimeout(() => {
                            document.querySelector('.auth-buttons').innerHTML = `
                                <p>${username}</p>
                                <a href="donacion.php">
                                    <button>Donación</button>
                                </a>
                                <button id="logoutBtn" onclick="window.location.href='logout.php'">Log Out</button>
                            `;
                            document.getElementById("loginModal").style.display = "none"; // Cierra el modal
                        }, 1000);
                    } else {
                        loginMessage.textContent = response;
                    }
                } else {
                    loginMessage.textContent = "Error al procesar el inicio de sesión";
                }
            };
        
            xhr.send(`username=${encodeURIComponent(username)}&password=${encodeURIComponent(password)}`);
        };

    </script>
</body>
</html>