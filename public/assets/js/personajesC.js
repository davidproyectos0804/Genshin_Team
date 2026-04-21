// ============================================================
//  personajes_cliente.js — Solo Filtrado
// ============================================================

// Recoge todos los controles de filtro
const filtros = {
  nombre:   document.getElementById('filtroNombre'),
  rareza:   document.getElementById('filtroRareza'),
  elemento: document.getElementById('filtroElemento'),
  arma:     document.getElementById('filtroArma'),
  region:   document.getElementById('filtroRegion'),
};
const contador = document.getElementById('filtroContador');

// Escucha cambios en cualquier filtro
Object.values(filtros).forEach(el => {
  if (el) { // Verificamos que el filtro existe en el HTML
    const evento = el.tagName === 'INPUT' ? 'input' : 'change';
    el.addEventListener(evento, aplicarFiltros);
  }
});

function aplicarFiltros() {
  const nombre   = filtros.nombre.value.toLowerCase().trim();
  const rareza   = filtros.rareza.value;
  const elemento = filtros.elemento.value;
  const arma     = filtros.arma.value;
  const region   = filtros.region.value;

  // Todas las cards del grid
  const cards = document.querySelectorAll('#gridPersonajes .glass-card');
  let visibles = 0;

  cards.forEach(card => {
    const coincide =
      (!nombre   || card.dataset.nombre.includes(nombre))   &&
      (!rareza   || card.dataset.rareza   === rareza)        &&
      (!elemento || card.dataset.elemento === elemento)      &&
      (!arma     || card.dataset.arma     === arma)          &&
      (!region   || card.dataset.region   === region);

    card.style.display = coincide ? '' : 'none';
    if (coincide) visibles++;
  });

  // Actualiza el contador
  if (contador) {
    contador.textContent = visibles === cards.length
      ? ''
      : `${visibles} de ${cards.length}`;
  }
}

function resetFiltros() {
  Object.values(filtros).forEach(el => {
    if (el) {
      el.tagName === 'INPUT' ? (el.value = '') : (el.selectedIndex = 0);
    }
  });
  aplicarFiltros();
}