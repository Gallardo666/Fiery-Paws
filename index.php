<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fiery Paws</title>
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
            <li><a href="#about">Inicio</a></li>
            <li><a href="#habitat">Hábitat</a></li>
            <li><a href="#behavior">Comportamiento</a></li>
            <li><a href="#conservation">Conservación</a></li>
            <li><a href="#gallery">Galería</a></li>
            <li><a href="#donaciones">Donaciones</a></li>
            <div class="auth-buttons">
                <?php if (isset($_SESSION['username'])): ?>
                    <!-- Si el usuario está autenticado, muestra su nombre y opciones de donación y cierre de sesión -->
                    <p><?php echo htmlspecialchars($_SESSION['username']); ?></p>
                    <a href="donacion.php">
                        <button>Donación</button>
                    </a>
                    <button id="logoutBtn" onclick="window.location.href='logout.php'">Log Out</button>
                <?php else: ?>
                    <!-- Si el usuario no está autenticado, muestra opciones para iniciar sesión o registrarse -->
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
                <img src="Images/PandaInfo/PandaRojo.jpeg" alt="Panda Rojo">
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
                    <img src="Images/PandaInfo/PandaRojo6.jpeg" alt="Panda Rojo 6">
                    <img src="Images/PandaInfo/PandaRojo7.jpg" alt="Panda Rojo 7">
                    <img src="Images/PandaInfo/PandaRojo10.jpg" alt="Panda Rojo 10">
                </div>
            </section>
            <section id="donaciones">
                <h2>Información sobre Donaciones</h2>
                <p>Tu apoyo es fundamental para la conservación de los pandas rojos. Con tu donación, podemos ayudar a proteger su hábitat, combatir la caza furtiva y promover programas de concienciación.</p>
                <p>Cada contribución cuenta y marca la diferencia en la vida de estos maravillosos animales.</p>
                    <!--Añadir Mensaje de iniciar sesion para donar-->
                <img src="Images/PandaInfo/AyudaPandaRojo.jpg" alt="Ayuda a los pandas rojos">
                <div class="donation-button">
                    <?php if (isset($_SESSION['username'])): ?>
                        <!-- Botón activo si el usuario está autenticado -->
                        <a href="donacion.php">
                            <button>Donación</button>
                        </a>
                    <?php else: ?>
                        <!-- Botón inactivo si el usuario no está autenticado -->
                        <button disabled style="opacity: 0.5; cursor: not-allowed;">Donación</button>
                        <span class="login-message">Por favor, inicie sesión para donar.</span>
                    <?php endif; ?>
                </div>
            </section>
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

    <!-- Modal de Términos -->
    <div id="termsModal" class="modal-scrollable">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Términos y Condiciones</h2>
            <p>Bienvenido a nuestro sitio web. Al acceder y utilizar este sitio, usted acepta cumplir con los siguientes términos y condiciones.</p>
            <br>

            <h3>1. Uso del sitio</h3>
            <p>Usted se compromete a usar este sitio solo para fines legales y de acuerdo con las leyes aplicables. Está prohibido utilizar este sitio de manera que pueda dañar, deshabilitar, sobrecargar o deteriorar cualquier servidor o red.</p>
            <br>
                        
            <h3>2. Registro y cuenta</h3>
            <p>Para utilizar ciertos servicios en el sitio, es posible que deba registrarse y crear una cuenta. Usted es responsable de mantener la confidencialidad de su cuenta y contraseña, y de todas las actividades que ocurran bajo su cuenta.</p>
            <br>
                        
            <h3>3. Propiedad intelectual</h3>
            <p>Todo el contenido disponible en este sitio, incluyendo textos, imágenes, logotipos, gráficos, es propiedad exclusiva del sitio o de sus licenciantes. Queda prohibida la reproducción, distribución o modificación sin autorización.</p>
            <br>
                        
            <h3>4. Exoneración de responsabilidad</h3>
            <p>El sitio no será responsable por ningún daño directo, indirecto, incidental o consecuente resultante del uso o la imposibilidad de usar este sitio, o de la interrupción de los servicios proporcionados en este sitio.</p>
            <br>
                        
            <h3>5. Modificaciones</h3>
            <p>Nos reservamos el derecho de modificar estos términos y condiciones en cualquier momento. Se le notificará de dichos cambios en el sitio web.</p>
        </div>
    </div>
                        
    <!-- Modal de Política de Privacidad -->
    <div id="privacyModal" class="modal-scrollable">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Política de Privacidad</h2>
            <p>En nuestro sitio web, valoramos su privacidad y nos comprometemos a proteger su información personal. Esta política de privacidad explica cómo recopilamos, usamos y protegemos su información.</p>
            <br>
                        
            <h3>1. Información que recopilamos</h3>
            <p>Recopilamos información personal que usted nos proporciona al registrarse en el sitio o al interactuar con nuestros servicios, como su nombre, dirección de correo electrónico, dirección IP y otra información relacionada.</p>
            <br>
                        
            <h3>2. Uso de la información</h3>
            <p>Utilizamos la información que recopilamos para mejorar nuestros servicios, procesar sus solicitudes, enviarle comunicaciones relacionadas con su cuenta, y para cumplir con nuestras obligaciones legales.</p>
            <br>
                        
            <h3>3. Compartir información</h3>
            <p>No compartimos su información personal con terceros, excepto cuando sea necesario para cumplir con una obligación legal o para mejorar nuestros servicios. En ningún caso venderemos su información personal a terceros.</p>
            <br>
                        
            <h3>4. Seguridad</h3>
            <p>Implementamos medidas de seguridad razonables para proteger su información personal contra el acceso no autorizado, la alteración o la divulgación. Sin embargo, no podemos garantizar la seguridad absoluta de los datos transmitidos a través de Internet.</p>
            <br>
                        
            <h3>5. Derechos del usuario</h3>
            <p>Usted tiene el derecho de acceder, corregir o eliminar su información personal. Si desea ejercer estos derechos, puede ponerse en contacto con nosotros a través de los medios proporcionados en el sitio web.</p>
            <br>
                        
            <h3>6. Cambios en la política de privacidad</h3>
            <p>Podemos actualizar esta política de privacidad ocasionalmente. Le notificaremos sobre cualquier cambio mediante una actualización en esta página.</p>
        </div>
    </div>


    <script src="scripts.js"></script>
</body>
</html>