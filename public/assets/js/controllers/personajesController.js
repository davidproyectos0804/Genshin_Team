// ── AÑADIR ───────────────────────────────────────────────────

document.getElementById('formInsert').addEventListener('submit', async function(e) {
  e.preventDefault();

  // Validación front
  const campos = ['nombre', 'rareza', 'arma', 'elemento', 'ascension', 'region'];
  for (const campo of campos) {
    if (!this.elements[campo].value.trim()) {
      mostrarError('Rellena todos los campos correctamente.');
      return;
    }
  }

  const foto = document.getElementById('fotoInput');
  if (!foto.files.length) {
    mostrarError('Sube una foto del personaje.');
    return;
  }

  const tiposPermitidos = ['image/png', 'image/jpeg', 'image/gif', 'image/webp'];
  if (!tiposPermitidos.includes(foto.files[0].type)) {
    mostrarError('Formato de imagen no permitido.');
    return;
  }

  // Todo ok — enviar al modelo
  const { ok, data } = await PersonajesModel.añadir(new FormData(this));

  if (!ok) {
    mostrarError(data.error);
    return;
  }

  cerrarModal('modalAdd');
  limpiarFormulario('formInsert');
  location.reload();
});


// ── EDITAR ───────────────────────────────────────────────────

document.getElementById('formEdit').addEventListener('submit', async function(e) {
  e.preventDefault();

  const campos = ['nombre', 'rareza', 'arma', 'elemento', 'ascension', 'region'];
  for (const campo of campos) {
    if (!this.elements[campo].value.trim()) {
      mostrarError('Rellena todos los campos correctamente.');
      return;
    }
  }

  const { ok, data } = await PersonajesModel.editar(new FormData(this));

  if (!ok) {
    mostrarError(data.error);
    return;
  }

  cerrarModal('modalEdit');
  location.reload();
});


// ── BORRAR ───────────────────────────────────────────────────

document.getElementById('formDel').addEventListener('submit', async function(e) {
  e.preventDefault();

  const id = document.getElementById('delId').value;
  const { ok, data } = await PersonajesModel.borrar(id);

  if (!ok) {
    mostrarError(data.error);
    return;
  }

  cerrarModal('modalDel');
  location.reload();
});