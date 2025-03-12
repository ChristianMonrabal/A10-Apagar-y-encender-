document.addEventListener("DOMContentLoaded", function () {
    function validateInput(input) {
        let errorMessage = "";
        let isValid = true;

        if (input.value.trim() === "" && input.type !== "password") {
            errorMessage = "Este campo no puede estar vacío.";
            isValid = false;
        } 
        else if (input.type === "email") {
            const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
            if (!emailPattern.test(input.value.trim())) {
                errorMessage = "El correo electrónico no es válido.";
                isValid = false;
            }
        }
        else if (input.type === "password") {
            if (input.value.trim() !== "" && input.value.length < 6) {
                errorMessage = "La contraseña debe tener al menos 6 caracteres.";
                isValid = false;
            }
        }

        let errorElement = input.nextElementSibling;
        if (!errorElement || !errorElement.classList.contains("error-message")) {
            errorElement = document.createElement("span");
            errorElement.classList.add("error-message");
            input.parentNode.appendChild(errorElement);
        }

        if (!isValid) {
            input.style.border = "1px solid red";
            errorElement.textContent = errorMessage;
            errorElement.style.color = "red";
            errorElement.style.display = "block";
        } else {
            input.style.border = "1px solid #DFE1E6";
            errorElement.textContent = "";
            errorElement.style.display = "none";
        }
    }

    document.querySelectorAll("input").forEach(input => {
        input.addEventListener("blur", function () {
            validateInput(input);
        });
    });

    const form = document.querySelector("form");
    form.addEventListener("submit", function (event) {
        let isFormValid = true;
        document.querySelectorAll("input").forEach(input => {
            validateInput(input);
            if (input.style.border === "1px solid red") {
                isFormValid = false;
            }
        });

        if (!isFormValid) {
            event.preventDefault();
        }
    });
});
