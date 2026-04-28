<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Team Builder | Abyss Overdrive</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="../../public/assets/css/personajes_principal.css">
  <script type="module" src="../../public/assets/js/teambuilder.js" defer></script>
</head>

<body class="text-white bg-[#0a0a1a]">

<?php include 'reusables/nav.html'; ?>

<main class="w-full flex-1 px-6 md:px-12 py-10">
  <div class="p-10">

    <!-- TÍTULO -->
    <div class="mb-8">
      <h1 class="text-4xl md:text-6xl font-black uppercase italic tracking-tighter leading-none">
        Team <span class="text-indigo-400">Builder</span>
      </h1>
      <p class="text-slate-400 text-xs uppercase tracking-[5px] font-bold mt-3 opacity-70">
        Construye y guarda tus equipos
      </p>
    </div>

    <!-- EQUIPOS -->
    <div id="equiposContainer" class="flex flex-col gap-10 mb-10"></div>

    <!-- BOTÓN AÑADIR -->
    <button id="addEquipo"
      class="flex items-center gap-2 px-6 py-3 bg-indigo-600/20 hover:bg-indigo-600/40
             border border-indigo-500/30 hover:border-indigo-400/60
             text-indigo-400 hover:text-indigo-300
             font-black uppercase text-xs tracking-widest rounded-lg transition-all">
      <span class="text-lg leading-none">+</span> Añadir equipo
    </button>

    <!-- MODAL -->
    <div id="selectorModal" class="hidden fixed inset-0 bg-black/80 flex items-center justify-center z-50">
      <div class="bg-[#0a0a1a] p-6 rounded-xl w-[90%] max-w-6xl max-h-[85vh] flex flex-col relative">

        <!-- Cruz -->
        <button id="cerrarModal"
          class="absolute top-3 right-3 text-slate-500 hover:text-white text-xl font-black leading-none transition-colors">
          ✕
        </button>

        <!-- FILTROS -->
        <div class="flex flex-wrap gap-3 mb-4 items-end shrink-0">
          <div class="flex flex-col gap-1">
            <label class="text-[10px] font-black uppercase text-slate-500 tracking-wider">Nombre</label>
            <input id="filtroNombre" type="text" placeholder="Buscar..."
              class="w-44 p-2 input-cyber rounded text-xs font-bold text-white placeholder-slate-600">
          </div>
          <div class="flex flex-col gap-1">
            <label class="text-[10px] font-black uppercase text-slate-500 tracking-wider">Rareza</label>
            <select id="filtroRareza" class="p-2 input-cyber rounded text-xs font-bold text-white">
              <option value="">Todas</option>
              <option value="4">★★★★</option>
              <option value="5">★★★★★</option>
            </select>
          </div>
          <div class="flex flex-col gap-1">
            <label class="text-[10px] font-black uppercase text-slate-500 tracking-wider">Elemento</label>
            <select id="filtroElemento" class="p-2 input-cyber rounded text-xs font-bold text-white">
              <option value="">Todos</option>
              <option value="1">Pyro</option>
              <option value="2">Hydro</option>
              <option value="3">Electro</option>
              <option value="4">Cryo</option>
              <option value="5">Anemo</option>
              <option value="6">Geo</option>
              <option value="7">Dendro</option>
            </select>
          </div>
          <div class="flex flex-col gap-1">
            <label class="text-[10px] font-black uppercase text-slate-500 tracking-wider">Arma</label>
            <select id="filtroArma" class="p-2 input-cyber rounded text-xs font-bold text-white">
              <option value="">Todas</option>
              <option value="1">Espada</option>
              <option value="2">Mandoble</option>
              <option value="3">Lanza</option>
              <option value="4">Arco</option>
              <option value="5">Catalizador</option>
            </select>
          </div>
          <div class="flex flex-col gap-1">
            <label class="text-[10px] font-black uppercase text-slate-500 tracking-wider">Región</label>
            <select id="filtroRegion" class="p-2 input-cyber rounded text-xs font-bold text-white">
              <option value="">Todas</option>
              <option value="1">Mondstadt</option>
              <option value="2">Liyue</option>
              <option value="3">Inazuma</option>
              <option value="4">Sumeru</option>
              <option value="5">Fontaine</option>
              <option value="6">Natlan</option>
              <option value="7">Snezhnaya</option>
              <option value="8">Nod-Krai</option>
            </select>
          </div>
          <button id="resetBtn"
            class="px-5 py-2 bg-slate-800 hover:bg-slate-700 text-slate-400 hover:text-white font-black uppercase text-[10px] tracking-widest rounded border border-white/5 transition-all self-end">
            Limpiar
          </button>
          <span id="filtroContador" class="self-end text-[10px] text-slate-600 uppercase tracking-widest font-bold ml-auto"></span>
        </div>

        <!-- GRID -->
        <div id="selectorGrid" class="grid grid-cols-6 gap-3 overflow-y-auto flex-1">
          <?php foreach ($dataToView["data"] as $p): ?>
            <div class="glass-card cursor-pointer rounded-lg overflow-hidden flex flex-col group h-fit transition-transform hover:scale-[1.02]"
              data-nombre="<?= strtolower(htmlspecialchars($p['nombre'], ENT_QUOTES)) ?>"
              data-rareza="<?= $p['rareza'] ?>"
              data-elemento="<?= $p['idElemento'] ?>"
              data-arma="<?= $p['idArma'] ?>"
              data-region="<?= $p['idRegion'] ?>"
              data-foto-elemento="<?= $p['foto_elemento'] ?>"
              data-foto-arma="<?= $p['foto_arma'] ?>"
              data-foto-region="<?= $p['foto_region'] ?>"
              data-rareza-str="<?= str_repeat('★', $p['rareza']) ?>"
              data-estadistica="<?= $p['estadistica'] ?>"
              data-elemento-nombre="<?= $p['elemento'] ?>"
              data-arma-nombre="<?= $p['arma'] ?>"
              data-region-nombre="<?= $p['region'] ?>">

              <div class="relative aspect-[3/4] bg-slate-900/60 overflow-hidden">
                <img src="<?= $p['foto'] ?>" class="w-full h-full object-cover"
                     style="object-position: center 15%;" loading="lazy">
              </div>

              <div class="p-3 bg-black/30 flex flex-col">
                <p class="text-center text-[11px] font-black uppercase tracking-wider mb-3 text-white">
                  <?= $p['nombre'] ?>
                </p>
                <div class="flex justify-around items-center gap-1 mb-3">
                  <div class="h-8 w-8 rounded-full bg-slate-800/80 flex items-center justify-center border border-white/10">
                    <img src="<?= $p['foto_elemento'] ?>" class="w-6" title="<?= $p['elemento'] ?>">
                  </div>
                  <div class="h-8 w-8 rounded-full bg-slate-800/80 flex items-center justify-center border border-white/10">
                    <img src="<?= $p['foto_arma'] ?>" class="w-full h-full object-cover" title="<?= $p['arma'] ?>">
                  </div>
                  <div class="h-8 w-8 rounded-full bg-slate-800/80 flex items-center justify-center border border-white/10">
                    <img src="<?= $p['foto_region'] ?>" class="w-7" title="<?= $p['region'] ?>">
                  </div>
                </div>
                <p class="text-center text-yellow-400 text-xs mb-1 tracking-widest">
                  <?= str_repeat('★', $p['rareza']) ?>
                </p>
                <p class="text-center text-[8px] text-indigo-400/70 uppercase tracking-[2px] font-black italic">
                  <?= $p['estadistica'] ?>
                </p>
              </div>
            </div>
          <?php endforeach; ?>
        </div>

      </div>
    </div>

  </div>
</main>

<?php include 'reusables/fotter.html'; ?>

</body>
</html>