<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Team Builder | Abyss Overdrive</title>

  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="../../public/assets/css/personajes_principal.css">

  <!-- IMPORTANTE: defer para esperar DOM -->
  <script type="module" src="../../public/assets/js/teambuilder.js" defer></script>
</head>

<body class="text-white bg-[#0a0a1a]">

<?php include 'reusables/nav.html'; ?>

<main class="w-full flex-1 px-6 md:px-12 py-10">
  <div class="p-10">

    <h1 class="text-3xl font-black mb-6">Team Builder</h1>

    <!-- EQUIPO -->
    <div class="grid grid-cols-4 gap-4 mb-10">
      <div class="slot bg-slate-800 h-40 flex items-center justify-center cursor-pointer" data-slot="0">+</div>
      <div class="slot bg-slate-800 h-40 flex items-center justify-center cursor-pointer" data-slot="1">+</div>
      <div class="slot bg-slate-800 h-40 flex items-center justify-center cursor-pointer" data-slot="2">+</div>
      <div class="slot bg-slate-800 h-40 flex items-center justify-center cursor-pointer" data-slot="3">+</div>
    </div>

    <!-- MODAL -->
    <div id="selectorModal" class="hidden fixed inset-0 bg-black/80 p-10">

      <div class="bg-[#0a0a1a] p-6 rounded-xl max-h-[90vh] overflow-auto">

        <!-- FILTROS -->
        <div class="flex gap-2 mb-4">
          <input id="filtroNombre" placeholder="Nombre">

          <select id="filtroRareza">
            <option value="">Rareza</option>
            <option value="4">4★</option>
            <option value="5">5★</option>
          </select>

          <select id="filtroElemento">
            <option value="">Elemento</option>
            <option value="1">Pyro</option>
            <option value="2">Hydro</option>
            <option value="3">Electro</option>
            <option value="4">Cryo</option>
            <option value="5">Anemo</option>
            <option value="6">Geo</option>
            <option value="7">Dendro</option>
          </select>

          <select id="filtroArma">
            <option value="">Arma</option>
            <option value="1">Espada</option>
            <option value="2">Mandoble</option>
            <option value="3">Lanza</option>
            <option value="4">Arco</option>
            <option value="5">Catalizador</option>
          </select>

          <select id="filtroRegion">
            <option value="">Región</option>
            <option value="1">Mondstadt</option>
            <option value="2">Liyue</option>
            <option value="3">Inazuma</option>
            <option value="4">Sumeru</option>
            <option value="5">Fontaine</option>
            <option value="6">Natlan</option>
            <option value="7">Snezhnaya</option>
            <option value="8">Nod-Krai</option>
          </select>

          <button id="resetBtn" class="px-3 py-1 bg-slate-700 rounded">
            Reset
          </button>
        </div>

        <!-- GRID -->
        <div id="selectorGrid" class="grid grid-cols-6 gap-3">

          <?php foreach ($dataToView["data"] as $p): ?>

  <div class="glass-card"
    data-nombre="<?= strtolower(htmlspecialchars($p['nombre'], ENT_QUOTES)) ?>"
    data-rareza="<?= $p['rareza'] ?>"
    data-elemento="<?= $p['idElemento'] ?>"
    data-arma="<?= $p['idArma'] ?>"
    data-region="<?= $p['idRegion'] ?>"
  >

    <img src="<?= $p['foto'] ?>">
    <p><?= $p['nombre'] ?></p>

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