<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Genshin TeamBuilder | Abyss Overdrive</title>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap');
    
    body { 
      margin: 0; padding: 0;
      height: 100vh; width: 100vw;
      overflow: hidden; 
      font-family: 'Plus Jakarta Sans', sans-serif;
      background: 
        radial-gradient(circle at center, rgba(26, 26, 58, 0.65) 0%, rgba(10, 10, 25, 0.98) 100%),
        url('../../public/assets/img/fondos/admin_menu.png') center 0% / cover no-repeat fixed;
      background-color: #0a0a1a; 
    }

    .title-gradient {
      background: linear-gradient(to bottom, #ffffff 60%, #94a3b8 100%);
      -webkit-background-clip: text;
      background-clip: text;
      -webkit-text-fill-color: transparent;
      color: transparent;
    }
  </style>
</head>
<body class="text-white flex flex-col">

  <?php include '../../reusables/nav.html'; ?>

  <main class="flex-1 flex flex-col items-center justify-center px-6 text-center z-10">
    <div class="mb-4 px-3 py-1 border border-indigo-500/20 bg-indigo-500/5 rounded-full text-indigo-400/80 text-[8px] font-black tracking-[0.4em] uppercase">
      Consola de Administración
    </div>

    <h1 class="text-6xl md:text-[6.5rem] font-black tracking-tighter leading-none mb-4 title-gradient uppercase">
      Panel de Control
    </h1>

    <div class="h-1 w-24 bg-indigo-500/30 mx-auto rounded-full mb-8"></div>

    <p class="text-slate-300 text-base md:text-xl max-w-3xl font-medium leading-relaxed mb-12 opacity-90 px-4">
      Gestión avanzada de metadatos para <span class="text-indigo-400 font-bold italic border-b border-indigo-500/20 pb-1">Genshin Impact</span>. <br>
      Optimiza tus equipos, analiza el meta y comparte estrategias con precisión técnica.
    </p>

    <div class="flex gap-8 w-full max-w-4xl">
      <a href="personajes.php" class="flex-1 group p-10 bg-black/50 border border-white/5 rounded-2xl backdrop-blur-xl transition-all duration-300 hover:border-indigo-500/40 hover:bg-indigo-900/10">
        <h3 class="text-3xl font-black mb-2 uppercase group-hover:text-indigo-400">Personajes</h3>
        <p class="text-slate-500 text-[10px] font-bold tracking-[2px] uppercase">Base de Datos • Filtros</p>
      </a>

      <a href="#" class="flex-1 group p-10 bg-black/50 border border-white/5 rounded-2xl backdrop-blur-xl transition-all duration-300 hover:border-purple-500/40 hover:bg-purple-900/10">
        <h3 class="text-3xl font-black mb-2 uppercase group-hover:text-purple-400">Banners</h3>
        <p class="text-slate-500 text-[10px] font-bold tracking-[2px] uppercase">Gachapón • Rotaciones</p>
      </a>
    </div>
  </main>

  <?php include '../../reusables/fotter.html'; ?>

</body>
</html>