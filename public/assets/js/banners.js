function abrirModal(id) {
  document.getElementById(id).classList.remove('hidden');
}
function cerrarModal(id) {
  document.getElementById(id).classList.add('hidden');
}
function mostrarError(msg) {
  document.getElementById('errorMsg').textContent = msg;
  abrirModal('modalError');
}
function cerrarModalError() {
  cerrarModal('modalError');
}

function abrirModalBorrar(btn) {
  document.getElementById('delId').value = btn.dataset.id;
  document.getElementById('delInfo').textContent = 'v' + btn.dataset.version + ' · Banner ' + btn.dataset.numero;
  abrirModal('modalDel');
}

function abrirModalEditar(btn) {
  document.getElementById('editIdBanner').value  = btn.dataset.id;
  document.getElementById('editVersion').value   = btn.dataset.version;
  document.getElementById('editNumero').value    = btn.dataset.numero;
  document.getElementById('editInicio').value    = btn.dataset.inicio;
  document.getElementById('editFin').value       = btn.dataset.fin;
  document.getElementById('editActivo').checked  = btn.dataset.activo == '1';

  const personajes = JSON.parse(btn.dataset.personajes);
  const selects5 = [document.getElementById('editPersonaje5_0'), document.getElementById('editPersonaje5_1')];
  const selects4 = [document.getElementById('editPersonaje4_0'), document.getElementById('editPersonaje4_1'), document.getElementById('editPersonaje4_2')];
  selects5.forEach((s, i) => { if (personajes[i]) s.value = personajes[i]; });
  selects4.forEach((s, i) => { if (personajes[i + 2]) s.value = personajes[i + 2]; });

  abrirModal('modalEdit');
}