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