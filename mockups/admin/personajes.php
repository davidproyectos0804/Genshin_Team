<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Personajes | Abyss Overdrive</title>
  
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/alpinejs@3.10.2/dist/cdn.min.js" defer></script>
  <link rel="stylesheet" href="../../public/assets/css/personajes_principal.css">
  
  <style>
    [x-cloak] { display: none !important; }

    /* DISEÑO PREMIUM SIN LAG */
    .modal-glass {
      background: #0f101d; /* Fondo oscuro sólido para evitar lag */
      border: 1px solid rgba(255, 255, 255, 0.1);
      box-shadow: 0 0 50px rgba(0, 0, 0, 0.8);
    }

    .input-cyber {
      background: rgba(255, 255, 255, 0.05);
      border: 1px solid rgba(255, 255, 255, 0.1);
      color: white;
      transition: border-color 0.2s;
    }

    .input-cyber:focus {
      border-color: #6366f1;
      outline: none;
    }

    /* Fondo oscuro de la pantalla al abrir modal */
    .modal-overlay {
      background: rgba(0, 0, 0, 0.8);
    }

    .glow-icon {
      box-shadow: 0 0 10px currentColor;
    }
  </style>
</head>
<body class="text-white bg-[#0a0a1a]" x-data="{ mAdd: false, mEdit: false, mDel: false, name: '' }">

  <?php include '../../reusables/nav.html'; ?>

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
      
      <div class="glass-card rounded-lg overflow-hidden flex flex-col group h-fit">
        <div class="relative aspect-[3/4] bg-slate-900/60 overflow-hidden">
          <div class="absolute inset-0 flex items-center justify-center opacity-10">
             <svg class="w-14 h-14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
          </div>
        </div>

        <div class="p-3 bg-black/30 flex flex-col">
          <p class="text-center text-[10px] font-black uppercase tracking-wider mb-3 text-slate-200">Nombre del PJ</p>
          
          <div class="flex justify-around items-center gap-1 mb-3">
            <div class="h-8 w-8 rounded-full bg-slate-800/80 flex items-center justify-center border border-white/10 text-orange-500">
               <div class="w-3 h-3 bg-current rounded-full glow-icon"></div>
            </div>
            <div class="h-8 w-8 rounded-full bg-slate-800/80 flex items-center justify-center border border-white/10 text-indigo-500">
               <div class="w-3 h-3 bg-current rounded-full glow-icon"></div>
            </div>
            <div class="h-8 w-8 rounded-full bg-slate-800/80 flex items-center justify-center border border-white/10 text-slate-400">
               <div class="w-3 h-3 bg-current rounded-full glow-icon"></div>
            </div>
          </div>

          <div class="flex border-t border-white/10 pt-2 justify-center gap-5">
            <button @click="mEdit = true" class="text-slate-500 hover:text-indigo-400 transition-all transform hover:scale-110">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><circle cx="12" cy="12" r="3"></circle></svg>
            </button>
            <button @click="mDel = true; name = 'Nombre del PJ'" class="text-slate-500 hover:text-red-500 transition-all transform hover:scale-110">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
            </button>
          </div>
        </div>
      </div>

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

  <?php include '../../reusables/fotter.html'; ?>

</body>
</html>