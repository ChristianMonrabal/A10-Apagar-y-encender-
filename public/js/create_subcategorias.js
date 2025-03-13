function toggleSubcategoryField() {
    var categoriasSelect = document.getElementById('categorias_id');
    var nombreField = document.getElementById('nombre');
    
    if (categoriasSelect.value) {
        nombreField.disabled = false;
    } else {
        nombreField.disabled = true;
    }
}

document.addEventListener('DOMContentLoaded', function() {
    toggleSubcategoryField();
});

function validateSubcategoryName() {
    var nombreField = document.getElementById('nombre');
    var errorMessage = document.getElementById('error-message');
    
    if (nombreField.value.trim() === '') {
        errorMessage.style.display = 'block'; 
    } else {
        errorMessage.style.display = 'none'; 
    }
}


function validateCategoryName() {
    var nombreField = document.getElementById('nombre');
    var errorMessage = document.getElementById('error-message-category');
    
    if (nombreField.value.trim() === '') {
        errorMessage.style.display = 'block';
    } else {
        errorMessage.style.display = 'none';
    }
}
