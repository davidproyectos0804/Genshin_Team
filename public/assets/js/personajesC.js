export function initFiltros({ filtros, grid, contador, onSelect }) {

  function aplicarFiltros() {
    const nombre   = filtros.nombre.value.toLowerCase().trim();
    const rareza   = filtros.rareza.value;
    const elemento = filtros.elemento.value;
    const arma     = filtros.arma.value;
    const region   = filtros.region.value;

    const cards = grid.querySelectorAll('.glass-card');
    let visibles = 0;

    cards.forEach(card => {
      const ok =
        (!nombre   || card.dataset.nombre.includes(nombre)) &&
        (!rareza   || card.dataset.rareza   === rareza)     &&
        (!elemento || card.dataset.elemento === elemento)   &&
        (!arma     || card.dataset.arma     === arma)       &&
        (!region   || card.dataset.region   === region);

      card.style.display = ok ? '' : 'none';
      if (ok) visibles++;
    });

    if (contador) {
      contador.textContent =
        visibles === cards.length ? '' : `${visibles} de ${cards.length}`;
    }
  }

  function resetFiltros() {
    Object.values(filtros).forEach(el => {
      el.tagName === 'INPUT'
        ? (el.value = '')
        : (el.selectedIndex = 0);
    });
    aplicarFiltros();
  }

  // Listeners filtros
  Object.values(filtros).forEach(el => {
    el.addEventListener(
      el.tagName === 'INPUT' ? 'input' : 'change',
      aplicarFiltros
    );
  });

  // Listener selección de personaje
  if (onSelect) {
    grid.addEventListener('click', (e) => {
      const card = e.target.closest('.glass-card');
      if (!card) return;
      onSelect(card);
    });
  }

  return { aplicarFiltros, resetFiltros };
}