import { initFiltros } from './personajesC.js';

const STORAGE_KEY = 'abyss_equipos';

document.addEventListener('DOMContentLoaded', () => {
  const modal            = document.getElementById('selectorModal');
  const equiposContainer = document.getElementById('equiposContainer');
  const addEquipoBtn     = document.getElementById('addEquipo');

  let slotActivo    = null;
  let equipos       = [];
  let equipoCounter = 0;

  cargarDeStorage();
  addEquipoBtn.addEventListener('click', () => crearEquipo());

  // ── Storage ───────────────────────────────────────────────
  function guardarEnStorage() {
    const datos = equipos
      .map((equipo, id) => {
        if (equipo === null) return null;
        const wrapper = document.querySelector(`[data-equipo-id="${id}"]`);
        if (!wrapper) return null;
        return { id, slots: equipo };
      })
      .filter(Boolean);
    localStorage.setItem(STORAGE_KEY, JSON.stringify(datos));
  }

  function cargarDeStorage() {
    const raw = localStorage.getItem(STORAGE_KEY);
    if (!raw) { crearEquipo(); return; }
    try {
      const datos = JSON.parse(raw);
      if (!datos.length) { crearEquipo(); return; }
      datos.forEach((equipoData, i) => {
        crearEquipo(equipoData.slots, i === 0);
      });
      equipoCounter = datos.length;
    } catch {
      crearEquipo();
    }
  }

  // ── Crear equipo ──────────────────────────────────────────
  function crearEquipo(slotsData = null, esElPrimero = false) {
    const id = equipoCounter++;
    equipos[id] = slotsData ?? [null, null, null, null];

    const wrapper = document.createElement('div');
    wrapper.dataset.equipoId = id;
    wrapper.className = 'equipo-wrapper';
    wrapper.innerHTML = `
      <div class="flex items-center gap-3 mb-4">
        <span class="text-[10px] font-black uppercase tracking-[4px] text-slate-600">
          Equipo ${id + 1}
        </span>
        <div class="flex-1 h-px bg-slate-800"></div>
        ${!esElPrimero && id > 0 ? `
        <button class="btn-eliminar-equipo text-[10px] font-black uppercase tracking-widest
                       px-3 py-1 rounded border border-red-900/40 text-red-800
                       hover:bg-red-900/30 hover:text-red-400 transition-all">
          Eliminar
        </button>` : ''}
      </div>
      <div class="grid grid-cols-4 gap-6 w-full max-w-3xl">
        ${[0,1,2,3].map(i => `
         <div class="slot group relative flex items-center justify-center
            cursor-pointer rounded-xl overflow-hidden text-slate-700
            bg-slate-800/40 border border-slate-700/40
            hover:border-indigo-500/40 hover:bg-slate-800/80
            transition-all duration-300 min-h-[200px]"
     data-equipo-id="${id}" data-slot="${i}">
  <div class="flex flex-col items-center gap-2 pointer-events-none">
    <span class="text-3xl font-thin opacity-30 group-hover:opacity-60 transition-opacity">+</span>
  </div>
</div>
        `).join('')}
      </div>
    `;

    wrapper.querySelectorAll('.slot').forEach(slot => {
      slot.addEventListener('click', () => {
        slotActivo = {
          equipoId:  parseInt(slot.dataset.equipoId),
          slotIndex: parseInt(slot.dataset.slot),
        };
        modal.classList.remove('hidden');
      });
    });

    wrapper.querySelector('.btn-eliminar-equipo')
      ?.addEventListener('click', () => {
        equipos[id] = null;
        wrapper.remove();
        guardarEnStorage();
      });

    equiposContainer.appendChild(wrapper);

    if (slotsData) {
      slotsData.forEach((pj, i) => {
        if (pj) pintarSlot(id, i, pj);
      });
    }
  }

  // ── Pintar slot ───────────────────────────────────────────
  function pintarSlot(equipoId, slotIndex, pj) {
    const slot = document.querySelector(
      `.slot[data-equipo-id="${equipoId}"][data-slot="${slotIndex}"]`
    );
    if (!slot) return;

    slot.innerHTML = `
  <div class="relative w-full group flex flex-col">

    <!-- Foto -->
    <div class="relative w-full aspect-[3/4] overflow-hidden bg-slate-900/60">
      <img src="${pj.foto}" class="w-full h-full object-cover"
           style="object-position: center 15%;">
      <button class="slot-remove absolute top-2 right-2 text-white bg-black/60
                     hover:bg-red-600 rounded-full w-6 h-6 text-[10px]
                     flex items-center justify-center transition-all
                     opacity-0 group-hover:opacity-100 shadow-lg z-10">✕</button>
    </div>

    <!-- Info -->
    <div class="p-2 bg-black/30 flex flex-col">
      <p class="text-center text-[10px] font-black uppercase tracking-wider mb-2 text-white truncate">
        ${pj.nombre}
      </p>
      <div class="flex justify-around items-center gap-1 mb-1">
        ${pj.fotoElemento ? `
        <div class="h-6 w-6 rounded-full bg-slate-800/80 flex items-center justify-center border border-white/10">
          <img src="${pj.fotoElemento}" class="w-4" title="${pj.elementoNombre ?? ''}">
        </div>` : ''}
        ${pj.fotoArma ? `
        <div class="h-6 w-6 rounded-full bg-slate-800/80 flex items-center justify-center border border-white/10">
          <img src="${pj.fotoArma}" class="w-full h-full object-cover" title="${pj.armaNombre ?? ''}">
        </div>` : ''}
        ${pj.fotoRegion ? `
        <div class="h-6 w-6 rounded-full bg-slate-800/80 flex items-center justify-center border border-white/10">
          <img src="${pj.fotoRegion}" class="w-5" title="${pj.regionNombre ?? ''}">
        </div>` : ''}
      </div>
      ${pj.rareza ? `
      <p class="text-center text-yellow-400 text-[9px] tracking-widest">${pj.rareza}</p>` : ''}
    </div>

  </div>
`;
slot.classList.remove('items-center', 'justify-center');

    slot.querySelector('.slot-remove').addEventListener('click', (e) => {
      e.stopPropagation();
      equipos[equipoId][slotIndex] = null;
      slot.innerHTML = `
        <div class="flex flex-col items-center gap-2 pointer-events-none">
          <span class="text-3xl font-thin opacity-30">+</span>
        </div>
      `;
      slot.classList.add('items-center', 'justify-center');
      guardarEnStorage();
    });
  }

  // ── Cerrar modal ──────────────────────────────────────────
  document.getElementById('cerrarModal')
    .addEventListener('click', cerrarModal);
  modal.addEventListener('click', (e) => {
    if (e.target === modal) cerrarModal();
  });
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') cerrarModal();
  });

  function cerrarModal() {
    modal.classList.add('hidden');
    slotActivo = null;
  }

  // ── Seleccionar personaje ─────────────────────────────────
  function seleccionarPersonaje(card) {
    if (!slotActivo) return;

    const { equipoId, slotIndex } = slotActivo;
    const pj = {
      nombre:         card.querySelector('p').textContent.trim(),
      foto:           card.querySelector('img').src,
      fotoElemento:   card.dataset.fotoElemento  ?? null,
      fotoArma:       card.dataset.fotoArma       ?? null,
      fotoRegion:     card.dataset.fotoRegion     ?? null,
      rareza:         card.dataset.rarezaStr      ?? null,
      estadistica:    card.dataset.estadistica    ?? null,
      elementoNombre: card.dataset.elementoNombre ?? null,
      armaNombre:     card.dataset.armaNombre     ?? null,
      regionNombre:   card.dataset.regionNombre   ?? null,
    };

    equipos[equipoId][slotIndex] = pj;
    pintarSlot(equipoId, slotIndex, pj);
    guardarEnStorage();
    cerrarModal();
  }

  // ── Filtros ───────────────────────────────────────────────
  const { resetFiltros } = initFiltros({
    filtros: {
      nombre:   document.getElementById('filtroNombre'),
      rareza:   document.getElementById('filtroRareza'),
      elemento: document.getElementById('filtroElemento'),
      arma:     document.getElementById('filtroArma'),
      region:   document.getElementById('filtroRegion'),
    },
    grid:     document.getElementById('selectorGrid'),
    contador: document.getElementById('filtroContador'),
    onSelect: seleccionarPersonaje,
  });

  document.getElementById('resetBtn')
    ?.addEventListener('click', resetFiltros);
});