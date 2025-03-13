    document.addEventListener("DOMContentLoaded", function () {
        const form = document.getElementById("filter-form");
        const clearButton = document.getElementById("clear-filters");

        function checkFilters() {
            let hasFilter = false;
            form.querySelectorAll("input, select").forEach(input => {
                if (input.value.trim() !== "") {
                    hasFilter = true;
                }
            });
            clearButton.style.display = hasFilter ? "block" : "none";
        }

        form.addEventListener("input", checkFilters);
        form.addEventListener("change", checkFilters);

        clearButton.addEventListener("click", function () {
            form.querySelectorAll("input, select").forEach(input => {
                input.value = "";
            });
            clearButton.style.display = "none";
            form.submit(); 
        });

        checkFilters();
    });


    document.addEventListener('DOMContentLoaded', function() {
        const clearNombre = document.getElementById('clear-nombre');
        const nombreInput = document.getElementById('nombre');
    
        nombreInput.addEventListener('input', function() {
            if (nombreInput.value.trim() !== "") {
                clearNombre.style.display = "block";
            } else {
                clearNombre.style.display = "none";
            }
        });
    
        clearNombre.addEventListener('click', function() {
            nombreInput.value = "";
            clearNombre.style.display = "none";
            document.getElementById('filter-form').submit();
        });
    
        if (nombreInput.value.trim() === "") {
            clearNombre.style.display = "none";
        }
    });
    