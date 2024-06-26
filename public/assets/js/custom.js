document.addEventListener("DOMContentLoaded", function () {
    const togglePassword = document.getElementById("togglePassword");
    const password = document.getElementById("password");

    const toggleConfirmPassword = document.getElementById(
        "toggleConfirmPassword"
    );
    const confirmPassword = document.getElementById("confirm_password");

    if (togglePassword && password) {
        togglePassword.addEventListener("click", function () {
            const type =
                password.getAttribute("type") === "password"
                    ? "text"
                    : "password";
            password.setAttribute("type", type);
            this.classList.toggle("fa-eye");
            this.classList.toggle("fa-eye-slash");
        });
    }

    if (toggleConfirmPassword && confirmPassword) {
        toggleConfirmPassword.addEventListener("click", function () {
            const type =
                confirmPassword.getAttribute("type") === "password"
                    ? "text"
                    : "password";
            confirmPassword.setAttribute("type", type);
            this.classList.toggle("fa-eye");
            this.classList.toggle("fa-eye-slash");
        });
    }
});

document.addEventListener("DOMContentLoaded", function () {
    var password = document.getElementById("password");
    var confirm_password = document.getElementById("confirm_password");
    var password_feedback = document.getElementById("password-feedback");

    function validatePassword() {
        if (password.value != confirm_password.value) {
            confirm_password.classList.add("mismatch");
            confirm_password.classList.remove("match");
            password_feedback.style.display = "block";
        } else {
            confirm_password.classList.remove("mismatch");
            confirm_password.classList.add("match");
            password_feedback.style.display = "none";
        }
    }

    password.onchange = validatePassword;
    confirm_password.onkeyup = validatePassword;
});
