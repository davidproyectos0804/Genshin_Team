<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Banners | Abyss Overdrive</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="icon" type="image/png" href="../../public/assets/img/armas/catalizador.webp">
  <link rel="stylesheet" href="../../public/assets/css/personajes_principal.css">
</head>

<body class="text-white bg-[#0a0a1a]">

<?php include '../../reusables/nav.html'; ?>

<main class="w-full flex-1 px-6 md:px-12 py-10">

<!-- FOREACH VERSIONES -->
<!-- foreach ($dataToView["data"] as $version) -->

<div class="glass-card rounded-2xl p-8 border border-indigo-500/10 mb-12">

  <!-- VERSION TITLE -->
  <div class="flex items-center gap-4 mb-8">
    <span class="text-indigo-400 text-2xl font-black italic">
      v6.x
    </span>
    <div class="flex-1 h-px bg-white/10"></div>
  </div>

  <!-- BANNERS GRID (4 POR VERSION) -->
  <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">

    <!-- FOREACH BANNERS -->
    <!-- foreach ($version["banners"] as $banner) -->

    <!-- 🃏 BANNER (ESTO ES LO IMPORTANTE) -->
    <div class="glass-card rounded-xl p-4 flex flex-col gap-4 border border-white/10 hover:scale-[1.02] transition">

      <!-- PERSONAJE 5★ -->
      <div class="rounded-lg overflow-hidden bg-slate-900/60 aspect-[3/4] flex items-center justify-center">
        <span class="text-slate-700 text-5xl">5★</span>
      </div>

      <!-- 3 PERSONAJES 4★ -->
      <div class="grid grid-cols-3 gap-2">

        <!-- FOREACH 4★ -->
        <!-- foreach ($banner["characters_4"] as $char) -->

        <div class="aspect-square bg-slate-800/60 rounded-md flex items-center justify-center text-xs">
          4★
        </div>

        <!-- END FOREACH -->

      </div>

      <!-- BOTONES DEL BANNER (CRUD REAL) -->
      <div class="flex gap-2 pt-2">

        <button class="w-full text-xs bg-indigo-600 hover:bg-indigo-500 py-1 rounded">
          Editar banner
        </button>

        <button class="w-full text-xs bg-red-600 hover:bg-red-500 py-1 rounded">
          Borrar banner
        </button>

      </div>

    </div>

    <!-- END FOREACH BANNERS -->

  </div>
</div>

<!-- END FOREACH VERSIONES -->

</main>

<?php include '../../reusables/fotter.html'; ?>

</body>
</html>