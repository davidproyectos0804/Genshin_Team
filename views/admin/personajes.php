<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Personajes | Abyss Overdrive</title>
  
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/alpinejs@3.10.2/dist/cdn.min.js" defer></script>
  <link rel="stylesheet" href="../../public/assets/css/personajes_principal.css">
</head>
<body class="text-white bg-[#0a0a1a]" x-data="{ mAdd: false, mEdit: false, mDel: false, name: '' }">

  <?php include 'reusables/nav.html'; ?>

  <main class="w-full flex-1 px-6 md:px-12 py-10">
    
    <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-6 mb-12 border-b border-white/10 pb-10">
      <div>
        <h1 class="text-4xl md:text-6xl font-black uppercase italic tracking-tighter leading-none">
          Base de <span class="text-indigo-400">Datos</span>
        </h1>
        <p class="text-slate-400 text-xs md:text-sm uppercase tracking-[5px] font-bold mt-3 opacity-70">
          Registro de Personajes de Teyvat
        </p>
      </div>
      
      <button @click="mAdd = true" class="w-full md:w-auto px-10 py-4 bg-indigo-600 hover:bg-indigo-500 text-white font-black uppercase text-xs tracking-widest rounded-md transition-all shadow-[0_0_25px_rgba(79,70,229,0.4)]">
        + Añadir Personaje
      </button>
    </div>

    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-7 2xl:grid-cols-9 gap-6 pb-20">
  <?php foreach ($dataToView["data"] as $p): ?>

  <div class="glass-card rounded-lg overflow-hidden flex flex-col group h-fit">
    <div class="relative aspect-[3/4] bg-slate-900/60 overflow-hidden">
      <img src="<?= $p['foto'] ?>" class="w-full h-full object-cover object-top">
    </div>

    <div class="p-3 bg-black/30 flex flex-col">
      
      <p class="text-center text-[10px] font-black uppercase tracking-wider mb-3 text-slate-200">
        <?= $p['nombre'] ?>
      </p>

      <div class="flex justify-around items-center gap-1 mb-3">
        
        <div class="h-8 w-8 rounded-full bg-slate-800/80 flex items-center justify-center border border-white/10">
          <img src="<?= $p['foto_elemento'] ?>" class="w-4">
        </div>

        <div class="h-8 w-8 rounded-full bg-slate-800/80 flex items-center justify-center border border-white/10">
          <img src="<?= $p['foto_arma'] ?>" class="w-full h-full object-cover">
        </div>

        <div class="h-8 w-8 rounded-full bg-slate-800/80 flex items-center justify-center border border-white/10">
          <img src="<?= $p['foto_estadistica'] ?>" class="w-4">
        </div>

      </div>

    </div>
  </div>

  <?php endforeach; ?>
    </div>
  </main>

  <div x-show="mDel" x-cloak class="fixed inset-0 z-[100] flex items-center justify-center p-4 modal-overlay">
    <div @click.away="mDel = false" class="modal-glass max-w-sm w-full p-8 rounded-xl text-center">
      <h2 class="text-xl font-black uppercase italic mb-4 text-white">¿Borrar a <span class="text-red-500" x-text="name"></span>?</h2>
      <div class="flex gap-4 mt-6">
        <button @click="mDel = false" class="flex-1 py-3 bg-slate-700 hover:bg-slate-600 rounded font-black uppercase text-xs tracking-widest transition-all">No</button>
        <button @click="mDel = false" class="flex-1 py-3 bg-red-600 hover:bg-red-500 rounded font-black uppercase text-xs tracking-widest transition-all shadow-lg shadow-red-500/20">Sí</button>
      </div>
    </div>
  </div>

  <div x-show="mAdd" x-cloak class="fixed inset-0 z-[100] flex items-center justify-center p-4 modal-overlay">
    <div @click.away="mAdd = false" class="modal-glass max-w-4xl w-full p-10 rounded-2xl relative">
      <h2 class="text-4xl font-black uppercase italic mb-10 tracking-tighter text-white">Nuevo <span class="text-indigo-400">Personaje</span></h2>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
        <div class="space-y-6">
          <div class="grid grid-cols-2 gap-4 text-left">
            <div class="col-span-2">
              <label class="text-[10px] font-black uppercase text-slate-400 tracking-wider">Nombre</label>
              <input type="text" class="w-full p-3 input-cyber rounded mt-1 text-sm font-bold" placeholder="Nombre del PJ">
            </div>
            <div>
              <label class="text-[10px] font-black uppercase text-slate-400 tracking-wider">Rareza</label>
              <select class="w-full p-3 input-cyber rounded mt-1 text-sm font-bold text-white"><option>5 Estrellas</option></select>
            </div>
            <div>
              <label class="text-[10px] font-black uppercase text-slate-400 tracking-wider">Arma</label>
              <select class="w-full p-3 input-cyber rounded mt-1 text-sm font-bold text-white"><option>Sword</option></select>
            </div>
            <div>
              <label class="text-[10px] font-black uppercase text-slate-400 tracking-wider">Ascensión</label>
              <select class="w-full p-3 input-cyber rounded mt-1 text-sm font-bold text-white"><option>ATK%</option></select>
            </div>
            <div>
              <label class="text-[10px] font-black uppercase text-slate-400 tracking-wider">Elemento</label>
              <select class="w-full p-3 input-cyber rounded mt-1 text-sm font-bold text-white"><option>Pyro</option></select>
            </div>
          </div>
          <button class="w-full py-4 bg-indigo-600 hover:bg-indigo-500 font-black uppercase text-xs rounded mt-4 tracking-widest transition-all">Añadir Registro</button>
        </div>
        <div class="flex flex-col items-center justify-center border-l border-white/5 pl-10">
          <div class="w-40 aspect-[3/4] bg-slate-900/60 rounded-lg border border-white/10 mb-6 flex items-center justify-center">
             <span class="text-[10px] text-white/20 uppercase font-black">Previsualización</span>
          </div>
          <button class="px-8 py-2 bg-slate-800 text-slate-300 font-bold uppercase text-[10px] tracking-widest rounded-lg border border-white/5 transition-all">Subir Foto</button>
        </div>
      </div>
      <button @click="mAdd = false" class="absolute top-6 right-6 text-slate-500 hover:text-white text-3xl font-light">&times;</button>
    </div>
  </div>

  <div x-show="mEdit" x-cloak class="fixed inset-0 z-[100] flex items-center justify-center p-4 modal-overlay">
    <div @click.away="mEdit = false" class="modal-glass max-w-4xl w-full p-10 rounded-2xl relative">
      <h2 class="text-4xl font-black uppercase italic mb-10 tracking-tighter text-white">Editar <span class="text-indigo-400">Personaje</span></h2>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
        <div class="space-y-6">
          <div class="grid grid-cols-2 gap-4 text-left">
            <div class="col-span-2">
              <label class="text-[10px] font-black uppercase text-slate-400 tracking-wider">Nombre</label>
              <input type="text" class="w-full p-3 input-cyber rounded mt-1 text-sm font-bold text-indigo-300" value="Nombre actual">
            </div>
            <div><label class="text-[10px] font-black uppercase text-slate-400 tracking-wider">Rareza</label>
              <select class="w-full p-3 input-cyber rounded mt-1 text-sm font-bold text-white"><option selected>5 Estrellas</option></select>
            </div>
            <div><label class="text-[10px] font-black uppercase text-slate-400 tracking-wider">Arma</label>
              <select class="w-full p-3 input-cyber rounded mt-1 text-sm font-bold text-white"><option selected>Sword</option></select>
            </div>
            <div><label class="text-[10px] font-black uppercase text-slate-400 tracking-wider">Ascensión</label>
              <select class="w-full p-3 input-cyber rounded mt-1 text-sm font-bold text-white"><option selected>ATK%</option></select>
            </div>
            <div><label class="text-[10px] font-black uppercase text-slate-400 tracking-wider">Elemento</label>
              <select class="w-full p-3 input-cyber rounded mt-1 text-sm font-bold text-white"><option selected>Pyro</option></select>
            </div>
          </div>
          <button class="w-full py-4 bg-indigo-600 hover:bg-indigo-500 font-black uppercase text-xs rounded mt-4 tracking-widest transition-all">Guardar Cambios</button>
        </div>
        <div class="flex flex-col items-center justify-center border-l border-white/5 pl-10">
          <div class="w-40 aspect-[3/4] bg-slate-900/60 rounded-lg border border-indigo-500/20 mb-6 flex items-center justify-center">
             <span class="text-[10px] text-indigo-400/30 uppercase font-black">Carta Actual</span>
          </div>
          <button class="px-8 py-2 bg-slate-800 text-slate-300 font-bold uppercase text-[10px] tracking-widest rounded-lg border border-white/5 transition-all">Cambiar Foto</button>
        </div>
      </div>
      <button @click="mEdit = false" class="absolute top-6 right-6 text-slate-500 hover:text-white text-3xl font-light">&times;</button>
    </div>
  </div>

  <?php include 'reusables/fotter.html'; ?>

</body>
</html>