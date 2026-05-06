<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Banners | Genshin Teambuilder</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="icon" type="image/png" href="../../public/assets/img/armas/catalizador.webp">
  <link rel="stylesheet" href="../../public/assets/css/personajes_principal.css">
</head>

<body class="text-white bg-[#0a0a1a]">

  <?php include 'reusables/nav.html'; ?>

  <main class="w-full flex-1 px-6 md:px-12 py-10">

    <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-6 mb-12 border-b border-white/10 pb-10">
      <div>
        <h1 class="text-4xl md:text-6xl font-black uppercase italic tracking-tighter leading-none">
          Historial <span class="text-indigo-400">De Banners</span>
        </h1>
        <p class="text-slate-400 text-xs md:text-sm uppercase tracking-[5px] font-bold mt-3 opacity-70">
          Historial de banners por versión
        </p>
      </div>
    </div>

    <?php
      $porVersion = [];
      foreach ($dataToView["data"][0] as $banner) {
          $porVersion[$banner['version']][] = $banner;
      }
    ?>

    <div class="flex flex-col gap-16 pb-20">
      <?php foreach ($porVersion as $version => $banners): ?>
        <div>
          <h2 class="text-xs font-black uppercase tracking-[6px] text-slate-500 mb-6">
            Versión <?= htmlspecialchars($version) ?>
          </h2>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <?php foreach ($banners as $b): ?>
              <div class="glass-card rounded-xl overflow-hidden">

                <div class="flex items-center justify-between px-6 py-4 border-b border-white/5">
                  <div>
                    <p class="text-[10px] font-black uppercase tracking-widest text-slate-500">
                      Banner <?= $b['numero_banner'] ?>
                    </p>
                    <p class="text-xs text-slate-400 mt-1">
                      <?= $b['fecha_inicio'] ?> → <?= $b['fecha_fin'] ?>
                    </p>
                  </div>
                  <?php if ($b['activo']): ?>
                    <span class="px-3 py-1 bg-green-500/10 text-green-400 text-[10px] font-black uppercase tracking-widest rounded-full border border-green-500/20">
                      Activo
                    </span>
                  <?php else: ?>
                    <span class="px-3 py-1 bg-slate-800 text-slate-500 text-[10px] font-black uppercase tracking-widest rounded-full border border-white/5">
                      Inactivo
                    </span>
                  <?php endif; ?>
                </div>

                <div class="flex gap-3 p-4">
                  <?php foreach ($b['personajes'] as $p): ?>
                    <div class="flex flex-col items-center gap-2 flex-1">
                      <div class="w-full aspect-[3/4] rounded-lg overflow-hidden bg-slate-900/60 border <?= $p['rareza'] == 5 ? 'border-yellow-500/30' : 'border-purple-500/20' ?>">
                        <img src="<?= $p['foto'] ?>" class="w-full h-full object-cover" style="object-position: center 10%;">
                      </div>
                      <p class="text-[9px] font-black uppercase tracking-wider text-slate-300 text-center">
                        <?= htmlspecialchars($p['nombre']) ?>
                      </p>
                      <p class="text-[9px] text-yellow-400 tracking-widest">
                        <?= str_repeat('★', $p['rareza']) ?>
                      </p>
                    </div>
                  <?php endforeach; ?>
                </div>

              </div>
            <?php endforeach; ?>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

  </main>

  <?php include 'reusables/fotter.html'; ?>

</body>
</html>