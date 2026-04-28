import { initFiltros } from './personajesC.js';

const { resetFiltros } = initFiltros({
  filtros: {
    nombre:   document.getElementById('filtroNombre'),
    rareza:   document.getElementById('filtroRareza'),
    elemento: document.getElementById('filtroElemento'),
    arma:     document.getElementById('filtroArma'),
    region:   document.getElementById('filtroRegion'),
  },
  grid:     document.getElementById('gridPersonajes'),
  contador: document.getElementById('filtroContador'),
});

document.getElementById('btnLimpiar')
  ?.addEventListener('click', resetFiltros);