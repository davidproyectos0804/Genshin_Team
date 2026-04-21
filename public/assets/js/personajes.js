// ============================================================
//  personajes.js — vanilla JS puro
// ============================================================


// ── HELPERS: abrir / cerrar modales ──────────────────────────

function abrirModal(id) {
  document.getElementById(id).classList.remove('hidden');
  document.body.style.overflow = 'hidden'; // evita scroll de fondo
}

function cerrarModal(id) {
  document.getElementById(id).classList.add('hidden');
  document.body.style.overflow = '';
}

// Cerrar con Escape
document.addEventListener('keydown', (e) => {
  if (e.key === 'Escape') {
    ['modalAdd', 'modalEdit', 'modalDel', 'modalError'].forEach(cerrarModal);
  }
});


// ── MODAL BORRAR ─────────────────────────────────────────────
// Recibe el botón que se pulsó, lee sus data-* y rellena el modal

function abrirModalBorrar(btn) {
  document.getElementById('delNombre').textContent = btn.dataset.nombre;
  document.getElementById('delId').value           = btn.dataset.id;
  abrirModal('modalDel');
}


// ── MODAL EDITAR ─────────────────────────────────────────────
// Lee los data-* del botón y rellena todos los campos del formulario

function abrirModalEditar(btn) {
  // Campos de texto / hidden
  document.getElementById('editId').value          = btn.dataset.id;
  document.getElementById('editNombre').value      = btn.dataset.nombre;
  document.getElementById('editFotoActual').value  = btn.dataset.foto;

  // Selects — asignar value hace que se seleccione la opción correcta
  document.getElementById('editRareza').value      = btn.dataset.rareza;
  document.getElementById('editArma').value        = btn.dataset.arma;
  document.getElementById('editElemento').value    = btn.dataset.elemento;
  document.getElementById('editAscension').value   = btn.dataset.estadistica;
  document.getElementById('editRegion').value      = btn.dataset.region;

  // Preview foto actual
  const preview     = document.getElementById('editFotoPreview');
  const placeholder = document.getElementById('editFotoPlaceholder');

  if (btn.dataset.foto) {
    preview.src = btn.dataset.foto;
    preview.classList.remove('hidden');
    placeholder.style.display = 'none';
  } else {
    preview.classList.add('hidden');
    placeholder.style.display = '';
  }

  // Limpiar el input de file por si venía de un editar anterior
  document.getElementById('fotoEditInput').value = '';

  abrirModal('modalEdit');
}


// ── PREVIEW IMAGEN — modal Añadir ────────────────────────────

document.getElementById('fotoInput').addEventListener('change', function () {
  const file = this.files[0];
  if (!file) return;

  const reader = new FileReader();
  reader.onload = function (e) {
    const img  = document.getElementById('previewImg');
    const text = document.getElementById('previewText');
    img.src = e.target.result;
    img.classList.remove('hidden');
    text.style.display = 'none';
  };
  reader.readAsDataURL(file);
});


// ── PREVIEW IMAGEN — modal Editar ────────────────────────────

document.getElementById('fotoEditInput').addEventListener('change', function () {
  const file = this.files[0];
  if (!file) return;

  const reader = new FileReader();
  reader.onload = function (e) {
    const preview     = document.getElementById('editFotoPreview');
    const placeholder = document.getElementById('editFotoPlaceholder');
    preview.src = e.target.result;
    preview.classList.remove('hidden');
    placeholder.style.display = 'none';
  };
  reader.readAsDataURL(file);
});


// ── LIMPIAR FORMULARIO — modal Añadir ────────────────────────

function limpiarFormulario(idForm) {
  document.getElementById(idForm).reset();

  const img  = document.getElementById('previewImg');
  const text = document.getElementById('previewText');
  img.src = '';
  img.classList.add('hidden');
  text.style.display = '';
}