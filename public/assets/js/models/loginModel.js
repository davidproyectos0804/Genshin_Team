const LoginModel = {
    async login(formData) {
        const res = await fetch('index.php?controlador=auth&accion=login', {
            method: 'POST',
            body: formData
        });
        const data = await res.json();
        return { ok: res.ok, data };
    }
};