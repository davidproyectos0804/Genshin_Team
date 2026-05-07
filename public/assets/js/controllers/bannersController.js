// ── AÑADIR ───────────────────────────────────────────────────
document.getElementById('formAdd').addEventListener('submit', async function(e) {
  e.preventDefault();

  if (!this.elements['idVersion'].value) {
    mostrarError('Selecciona una versión.');
    return;
  }
  if (!this.elements['fecha_inicio'].value || !this.elements['fecha_fin'].value) {
    mostrarError('Rellena las fechas del banner.');
    return;
  }

  const personajes = [...this.querySelectorAll('select[name="personajes[]"]')];
  if (personajes.some(s => !s.value)) {
    mostrarError('Selecciona todos los personajes.');
    return;
  }
  const ids = personajes.map(s => s.value);
  if (ids.length !== new Set(ids).size) {
    mostrarError('No puedes repetir personajes en el mismo banner.');
    return;
  }

  const { ok, data } = await BannersModel.anadir(new FormData(this));
  if (!ok) {
    mostrarError(data.error);
    return;
  }
  cerrarModal('modalAdd');
  location.reload();
});

// ── EDITAR ───────────────────────────────────────────────────
document.getElementById('formEdit').addEventListener('submit', async function(e) {
  e.preventDefault();

  if (!this.elements['idVersion'].value) {
    mostrarError('Selecciona una versión.');
    return;
  }
  if (!this.elements['fecha_inicio'].value || !this.elements['fecha_fin'].value) {
    mostrarError('Rellena las fechas del banner.');
    return;
  }

  const personajes = [...this.querySelectorAll('select[name="personajes[]"]')];
  if (personajes.some(s => !s.value)) {
    mostrarError('Selecciona todos los personajes.');
    return;
  }
  const ids = personajes.map(s => s.value);
  if (ids.length !== new Set(ids).size) {
    mostrarError('No puedes repetir personajes en el mismo banner.');
    return;
  }

  const { ok, data } = await BannersModel.editar(new FormData(this));
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
  const { ok, data } = await BannersModel.borrar(id);
  if (!ok) {
    mostrarError(data.error);
    return;
  }
  cerrarModal('modalDel');
  location.reload();
});