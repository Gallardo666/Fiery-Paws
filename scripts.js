document.addEventListener('DOMContentLoaded', () => {
    // Ensure no modals are set to open automatically
    const modals = document.querySelectorAll('.modal, .modal-scrollable');
    modals.forEach(modal => {
        modal.style.display = 'none'; // Ensure all modals are hidden initially
    });

    // Modales existentes
    const registerModal = document.getElementById("registerModal");
    const loginModal = document.getElementById("loginModal");
    const openRegisterBtn = document.getElementById("openRegisterModal");
    const openLoginBtn = document.getElementById("openLoginModal");
    const closeBtns = document.querySelectorAll(".close");

    // Modales nuevos (Términos y privacidad)
    const termsModal = document.getElementById("termsModal");
    const privacyModal = document.getElementById("privacyModal");
    const openTermsModal = document.getElementById("openTermsModal");
    const openPrivacyModal = document.getElementById("openPrivacyModal");
    const closeModalBtns = document.querySelectorAll(".close, .close-btn");

    // Abrir los modales de registro y login
    openRegisterBtn.onclick = function() {
        registerModal.style.display = "flex";
    }

    openLoginBtn.onclick = function() {
        loginModal.style.display = "flex";
    }

    // Abrir los modales de términos y privacidad usando los enlaces <a>
    openTermsModal.onclick = function(event) {
        event.preventDefault();  // Prevenir comportamiento por defecto de enlace
        termsModal.style.display = "flex";  // Mostrar el modal de Términos y Condiciones
    }

    openPrivacyModal.onclick = function(event) {
        event.preventDefault();  // Prevenir comportamiento por defecto de enlace
        privacyModal.style.display = "flex";  // Mostrar el modal de Política de Privacidad
    }

    // Cerrar todos los modales (registro, login, términos, privacidad) cuando se haga clic en el botón de cerrar
    closeModalBtns.forEach(btn => {
        btn.onclick = function() {
            registerModal.style.display = "none";
            loginModal.style.display = "none";
            termsModal.style.display = "none";
            privacyModal.style.display = "none";
        }
    });

    // Cerrar modales si se hace clic fuera de ellos
    window.onclick = function(event) {
        if (event.target === registerModal) {
            registerModal.style.display = "none";
        }
        if (event.target === loginModal) {
            loginModal.style.display = "none";
        }
        if (event.target === termsModal) {
            termsModal.style.display = "none";
        }
        if (event.target === privacyModal) {
            privacyModal.style.display = "none";
        }
    }

    // Intersection Observer for sections
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

// Funcionalidad de registro
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

// Funcionalidad de login
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

                    // Actualiza el botón de donación en la sección "Donaciones"
                    const donationButtonSection = document.querySelector('.donation-button');
                    if (donationButtonSection) {
                        donationButtonSection.innerHTML = `
                            <a href="donacion.php">
                                <button>Donación</button>
                            </a>
                        `;
                    }
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