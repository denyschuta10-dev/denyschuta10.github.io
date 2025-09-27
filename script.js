document.getElementById('contacto-form').addEventListener('submit', function(event) {
    let isValid = true;
    const form = event.target;
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    function showError(fieldId, message) {
        const errorMessageDiv = form.querySelector(`.error-message[data-for="${fieldId}"]`);
        if (errorMessageDiv) {
            errorMessageDiv.textContent = message;
        }
    }

    function clearError(fieldId) {
        showError(fieldId, '');
    }

    // --- Validación de Nombre ---
    const nombre = document.getElementById('nombre').value.trim();
    if (nombre === "") {
        showError('nombre', 'El nombre es obligatorio.');
        isValid = false;
    } else {
        clearError('nombre');
    }

    // --- Validación de Apellido ---
    const apellido = document.getElementById('apellido').value.trim();
    if (apellido === "") {
        showError('apellido', 'El apellido es obligatorio.');
        isValid = false;
    } else {
        clearError('apellido');
    }

    // --- Validación de Correo ---
    const correo = document.getElementById('correo').value.trim();
    if (correo === "") {
        showError('correo', 'El correo es obligatorio.');
        isValid = false;
    } else if (!emailRegex.test(correo)) {
        showError('correo', 'Formato de correo electrónico no válido.');
        isValid = false;
    } else {
        clearError('correo');
    }

    // --- Validación de Asunto ---
    const asunto = document.getElementById('asunto').value.trim();
    if (asunto === "") {
        showError('asunto', 'El asunto es obligatorio.');
        isValid = false;
    } else {
        clearError('asunto');
    }

    // --- Validación de Mensaje ---
    const mensaje = document.getElementById('mensaje').value.trim();
    if (mensaje === "") {
        showError('mensaje', 'El mensaje es obligatorio.');
        isValid = false;
    } else {
        clearError('mensaje');
    }

    // Si la validación falla, detenemos el envío del formulario.
    if (!isValid) {
        event.preventDefault(); 
    }
});