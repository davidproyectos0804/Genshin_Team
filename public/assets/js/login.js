function togglePassword() {
    const input = document.getElementById('passwordInput');
    const ojoCerrado = document.getElementById('ojoCerrado');
    const ojoAbierto = document.getElementById('ojoAbierto');
    if (input.type === 'password') {
        input.type = 'text';
        ojoCerrado.classList.add('hidden');
        ojoAbierto.classList.remove('hidden');
    } else {
        input.type = 'password';
        ojoCerrado.classList.remove('hidden');
        ojoAbierto.classList.add('hidden');
    }
}

function mostrarError(mensaje) {
    const div = document.getElementById('errorDiv');
    const p = document.getElementById('errorMsg');
    p.textContent = mensaje;
    div.classList.remove('hidden');
}