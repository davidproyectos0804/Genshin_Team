const PersonajesModel = {
  async añadir(formData) {
    const res = await fetch('index.php?controlador=personajes&accion=cAnadirPersonaje', {
      method: 'POST',
      body: formData
    });
    const data = await res.json();
    return { ok: res.ok, data };
  },

  async editar(formData) {
    const res = await fetch('index.php?controlador=personajes&accion=cEditarPersonaje', {
      method: 'POST',
      body: formData
    });
    const data = await res.json();
    return { ok: res.ok, data };
  },

  async borrar(id) {
    const formData = new FormData();
    formData.append('idPersonaje', id);
    const res = await fetch('index.php?controlador=personajes&accion=cBorrarPersonaje', {
      method: 'POST',
      body: formData
    });
    const data = await res.json();
    return { ok: res.ok, data };
  }
};