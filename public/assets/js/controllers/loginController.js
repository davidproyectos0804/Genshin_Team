document.querySelector('form').addEventListener('submit', async function(e) {
    e.preventDefault();

    const usuario = this.elements['usuario'].value.trim();
    const password = this.elements['password'].value.trim();

    if (!usuario || !password) {
        mostrarError('Rellena todos los campos.');
        return;
    }

    const { ok, data } = await LoginModel.login(new FormData(this));

    if (!ok) {
        mostrarError(data.error);
        return;
    }

    window.location.href = 'index.php';
});