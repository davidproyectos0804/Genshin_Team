import { initFiltros } from './personajesC.js';

const filtros = {
  nombre: document.getElementById('filtroNombre'),
  rareza: document.getElementById('filtroRareza'),
  elemento: document.getElementById('filtroElemento'),
  arma: document.getElementById('filtroArma'),
  region: document.getElementById('filtroRegion'),
};

const contador = document.getElementById('filtroContador');

initFiltros({
  filtros,
  grid: document.getElementById('gridPersonajes'),
  contador
});