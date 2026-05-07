const BannersModel = {
  async anadir(formData) {
    const res = await fetch('index.php?controlador=banners&accion=cAnadirBanner', {
      method: 'POST',
      body: formData
    });
    const data = await res.json();
    return { ok: res.ok, data };
  },
  async editar(formData) {
    const res = await fetch('index.php?controlador=banners&accion=cModificarBanner', {
      method: 'POST',
      body: formData
    });
    const data = await res.json();
    return { ok: res.ok, data };
  },
  async borrar(id) {
    const formData = new FormData();
    formData.append('idBanner', id);
    const res = await fetch('index.php?controlador=banners&accion=cBorrarBanner', {
      method: 'POST',
      body: formData
    });
    const data = await res.json();
    return { ok: res.ok, data };
  }
};