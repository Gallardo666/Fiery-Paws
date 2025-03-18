// Existing modals
const registerModal = document.getElementById("registerModal");
const loginModal = document.getElementById("loginModal");
const openRegisterBtn = document.getElementById("openRegisterModal");
const openLoginBtn = document.getElementById("openLoginModal");

// New modals (Terms and Privacy)
const termsModal = document.getElementById("termsModal");
const privacyModal = document.getElementById("privacyModal");
const openTermsModal = document.getElementById("openTermsModal");
const openPrivacyModal = document.getElementById("openPrivacyModal");

// Open registration and login modals
openRegisterBtn.onclick = function() {
    registerModal.style.display = "flex";
}

openLoginBtn.onclick = function() {
    loginModal.style.display = "flex";
}

// Open terms and privacy modals using <a> links
openTermsModal.onclick = function(event) {
    event.preventDefault();  // Prevent default link behavior
    termsModal.style.display = "flex";  // Show Terms and Conditions modal
}

openPrivacyModal.onclick = function(event) {
    event.preventDefault();  // Prevent default link behavior
    privacyModal.style.display = "flex";  // Show Privacy Policy modal
}

// Close all modals (registration, login, terms, privacy) when clicking the close button
const closeBtns = document.querySelectorAll(".close");
closeBtns.forEach(btn => {
    btn.onclick = function() {
        if (btn.closest('.modal') === registerModal) {
            registerModal.style.display = "none";
        }
        if (btn.closest('.modal') === loginModal) {
            loginModal.style.display = "none";
        }
        if (btn.closest('.modal') === termsModal) {
            termsModal.style.display = "none";
        }
        if (btn.closest('.modal') === privacyModal) {
            privacyModal.style.display = "none";
        }
    }
});

// Close modals if clicking outside of them
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

// Registration functionality
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

// Login functionality
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

                    // Update the donation button in the "Donaciones" section
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