import { initFiltros } from './personajesC.js';

document.addEventListener('DOMContentLoaded', () => {

  const slots = document.querySelectorAll('.slot');
  const modal = document.getElementById('selectorModal');

  let slotActivo = null;
  let equipo = [null, null, null, null];

  slots.forEach(slot => {
    slot.addEventListener('click', () => {
      slotActivo = slot.dataset.slot;
      modal.classList.remove('hidden');
    });
  });

  const { resetFiltros } = initFiltros({
    filtros: {
      nombre: document.getElementById('filtroNombre'),
      rareza: document.getElementById('filtroRareza'),
      elemento: document.getElementById('filtroElemento'),
      arma: document.getElementById('filtroArma'),
      region: document.getElementById('filtroRegion'),
    },
    grid: document.getElementById('selectorGrid'),
    contador: null
  });

  document.getElementById('resetBtn')
    ?.addEventListener('click', resetFiltros);

});