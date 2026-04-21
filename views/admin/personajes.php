<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Personajes | Abyss Overdrive</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="../../public/assets/css/personajes_principal.css">
</head>

<body class="text-white bg-[#0a0a1a]">

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

      <button onclick="abrirModal('modalAdd')" class="w-full md:w-auto px-10 py-4 bg-indigo-600 hover:bg-indigo-500 text-white font-black uppercase text-xs tracking-widest rounded-md transition-all shadow-[0_0_25px_rgba(79,70,229,0.4)]">
        + Añadir Personaje
      </button>
    </div>

    <!-- GRID DE PERSONAJES -->
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-7 2xl:grid-cols-9 gap-6 pb-20">
      <?php foreach ($dataToView["data"] as $p): ?>

        <div class="glass-card rounded-lg overflow-hidden flex flex-col group h-fit">
          <div class="relative aspect-[3/4] bg-slate-900/60 overflow-hidden">
            <img src="<?= $p['foto'] ?>" class="w-full h-full object-cover" style="object-position: center 10%;">
          </div>

          <div class="p-3 bg-black/30 flex flex-col">

            <p class="text-center text-[10px] font-black uppercase tracking-wider mb-3 text-slate-200">
              <?= $p['nombre'] ?>
            </p>

            <div class="flex justify-around items-center gap-1 mb-3">
              <!-- ELEMENTO -->
              <div class="relative group/elem h-8 w-8 rounded-full bg-slate-800/80 flex items-center justify-center border border-white/10">
                <img src="<?= $p['foto_elemento'] ?>" class="w-6">
                <div class="absolute bottom-10 left-1/2 -translate-x-1/2 bg-slate-900 text-white text-[9px] font-black uppercase tracking-wider px-2 py-1 rounded whitespace-nowrap opacity-0 group-hover/elem:opacity-100 transition-all pointer-events-none border border-white/10 z-10">
                  <?= $p['elemento'] ?>
                </div>
              </div>
              <!-- ARMA -->
              <div class="relative group/arma h-8 w-8 rounded-full bg-slate-800/80 flex items-center justify-center border border-white/10">
                <img src="<?= $p['foto_arma'] ?>" class="w-full h-full object-cover">
                <div class="absolute bottom-10 left-1/2 -translate-x-1/2 bg-slate-900 text-white text-[9px] font-black uppercase tracking-wider px-2 py-1 rounded whitespace-nowrap opacity-0 group-hover/arma:opacity-100 transition-all pointer-events-none border border-white/10 z-10">
                  <?= $p['arma'] ?>
                </div>
              </div>
              <!-- REGION -->
              <div class="relative group/region h-8 w-8 rounded-full bg-slate-800/80 flex items-center justify-center border border-white/10">
                <img src="<?= $p['foto_region'] ?>" class="w-7">
                <div class="absolute bottom-10 left-1/2 -translate-x-1/2 bg-slate-900 text-white text-[9px] font-black uppercase tracking-wider px-2 py-1 rounded whitespace-nowrap opacity-0 group-hover/region:opacity-100 transition-all pointer-events-none border border-white/10 z-10">
                  <?= $p['region'] ?>
                </div>
              </div>
            </div>

            <p class="text-center text-yellow-400 text-xs mb-3 tracking-widest">
              <?= str_repeat('★', $p['rareza']) ?>
            </p>
            <p class="text-center text-[9px] text-slate-500 uppercase tracking-widest font-bold mb-3">
              <?= $p['estadistica'] ?>
            </p>

            <div class="flex border-t border-white/10 pt-2 justify-center gap-5">

              <!-- BOTÓN EDITAR — pasa todos los datos del personaje como atributos data-* -->
              <button
                onclick="abrirModalEditar(this)"
                data-id="<?= $p['idPersonaje'] ?>"
                data-nombre="<?= htmlspecialchars($p['nombre'], ENT_QUOTES) ?>"
                data-rareza="<?= $p['rareza'] ?>"
                data-arma="<?= $p['idArma'] ?>"
                data-elemento="<?= $p['idElemento'] ?>"
                data-estadistica="<?= $p['idEstadistica'] ?>"
                data-region="<?= $p['idRegion'] ?>"
                data-foto="<?= $p['foto'] ?>"
                class="text-slate-500 hover:text-indigo-400 transition-all transform hover:scale-110">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                  <circle cx="12" cy="12" r="3"></circle>
                </svg>
              </button>

              <!-- BOTÓN BORRAR — pasa id y nombre -->
              <button
                onclick="abrirModalBorrar(this)"
                data-id="<?= $p['idPersonaje'] ?>"
                data-nombre="<?= htmlspecialchars($p['nombre'], ENT_QUOTES) ?>"
                class="text-slate-500 hover:text-red-500 transition-all transform hover:scale-110">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                </svg>
              </button>

            </div>
          </div>
        </div>

      <?php endforeach; ?>
    </div>
  </main>


  <!-- ============================
       MODAL: BORRAR
  ============================= -->
  <div id="modalDel" class="hidden fixed inset-0 z-[100] flex items-center justify-center p-4 modal-overlay">
    <div class="modal-glass max-w-sm w-full p-8 rounded-xl text-center">

      <h2 class="text-xl font-black uppercase italic mb-4 text-white">
        ¿Borrar a <span id="delNombre" class="text-red-500"></span>?
      </h2>

      <form method="POST" action="index.php?controlador=personajes&accion=cBorrarPersonaje">
        <input type="hidden" id="delId" name="idPersonaje" value="">
        <div class="flex gap-4 mt-6">
          <button type="button" onclick="cerrarModal('modalDel')"
            class="flex-1 py-3 bg-slate-700 hover:bg-slate-600 rounded font-black uppercase text-xs tracking-widest transition-all">
            No
          </button>
          <button type="submit"
            class="flex-1 py-3 bg-red-600 hover:bg-red-500 rounded font-black uppercase text-xs tracking-widest transition-all shadow-lg shadow-red-500/20">
            Sí
          </button>
        </div>
      </form>

    </div>
  </div>


  <!-- ============================
       MODAL: AÑADIR
  ============================= -->
  <div id="modalAdd" class="hidden fixed inset-0 z-[100] flex items-center justify-center p-4">
    <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" onclick="cerrarModal('modalAdd')"></div>

    <div class="relative modal-glass max-w-4xl w-full p-10 rounded-2xl">

      <form id="formInsert" action="index.php?controlador=personajes&accion=cAnadirPersonaje" method="POST" enctype="multipart/form-data">

        <h2 class="text-4xl font-black uppercase italic mb-10 tracking-tighter text-white">
          Nuevo <span class="text-indigo-400">Personaje</span>
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">

          <!-- IZQUIERDA -->
          <div class="space-y-6">
            <div class="grid grid-cols-2 gap-4 text-left">

              <div class="col-span-2">
                <label class="text-[10px] font-black uppercase text-slate-400 tracking-wider">Nombre</label>
                <input name="nombre" type="text" placeholder="Nombre del personaje"
                  class="w-full p-3 input-cyber rounded mt-1 text-sm font-bold">
              </div>

              <div>
                <label class="text-[10px] font-black uppercase text-slate-400 tracking-wider">Rareza</label>
                <select name="rareza" class="w-full p-3 input-cyber rounded mt-1 text-sm font-bold text-white">
                  <option value="" disabled selected>Selecciona rareza</option>
                  <option value="4">4 Estrellas</option>
                  <option value="5">5 Estrellas</option>
                </select>
              </div>

              <div>
                <label class="text-[10px] font-black uppercase text-slate-400 tracking-wider">Arma</label>
                <select name="arma" class="w-full p-3 input-cyber rounded mt-1 text-sm font-bold text-white">
                  <option value="" disabled selected>Selecciona arma</option>
                  <option value="1">Espada</option>
                  <option value="2">Mandoble</option>
                  <option value="3">Lanza</option>
                  <option value="4">Arco</option>
                  <option value="5">Catalizador</option>
                </select>
              </div>

              <div>
                <label class="text-[10px] font-black uppercase text-slate-400 tracking-wider">Ascensión</label>
                <select name="ascension" class="w-full p-3 input-cyber rounded mt-1 text-sm font-bold text-white">
                  <option value="" disabled selected>Selecciona estadística</option>
                  <option value="1">ATK%</option>
                  <option value="2">HP%</option>
                  <option value="3">DEF%</option>
                  <option value="4">Crit Rate</option>
                  <option value="5">Crit DMG</option>
                  <option value="6">Recarga de Energía</option>
                  <option value="7">Maestría Elemental</option>
                  <option value="8">Bono de Curación</option>
                  <option value="13">Bono Físico</option>
                  <option value="14">Bono Pyro</option>
                  <option value="15">Bono Hydro</option>
                  <option value="16">Bono Electro</option>
                  <option value="17">Bono Cryo</option>
                  <option value="18">Bono Anemo</option>
                  <option value="19">Bono Geo</option>
                  <option value="20">Bono Dendro</option>
                </select>
              </div>

              <div>
                <label class="text-[10px] font-black uppercase text-slate-400 tracking-wider">Elemento</label>
                <select name="elemento" class="w-full p-3 input-cyber rounded mt-1 text-sm font-bold text-white">
                  <option value="" disabled selected>Selecciona elemento</option>
                  <option value="1">Pyro</option>
                  <option value="2">Hydro</option>
                  <option value="3">Electro</option>
                  <option value="4">Cryo</option>
                  <option value="5">Anemo</option>
                  <option value="6">Geo</option>
                  <option value="7">Dendro</option>
                </select>
              </div>

              <div class="col-span-2">
                <label class="text-[10px] font-black uppercase text-slate-400 tracking-wider">Región</label>
                <select name="region" class="w-full p-3 input-cyber rounded mt-1 text-sm font-bold text-white">
                  <option value="" disabled selected>Selecciona región</option>
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

            </div>

            <div class="flex gap-4 mt-4">
              <button type="submit"
                class="w-full py-4 bg-indigo-600 hover:bg-indigo-500 font-black uppercase text-xs rounded tracking-widest transition-all">
                Añadir
              </button>
              <button type="button" onclick="limpiarFormulario('formInsert')"
                class="w-full py-4 bg-red-600 hover:bg-red-500 font-black uppercase text-xs rounded tracking-widest transition-all">
                Limpiar
              </button>
            </div>
          </div>

          <!-- DERECHA — preview -->
          <div class="flex flex-col items-center justify-center border-l border-white/5 pl-10">
            <div class="w-40 aspect-[3/4] bg-slate-900/60 rounded-lg border border-white/10 mb-6 flex items-center justify-center overflow-hidden">
              <span id="previewText" class="text-[10px] text-white/20 uppercase font-black">Previsualización</span>
              <img id="previewImg" class="hidden w-full h-full object-cover">
            </div>
            <input type="file" name="foto" id="fotoInput" class="hidden" accept="image/*">
            <label for="fotoInput"
              class="px-8 py-2 bg-slate-800 text-slate-300 font-bold uppercase text-[10px] tracking-widest rounded-lg border border-white/5 cursor-pointer">
              Subir Foto
            </label>
          </div>

        </div>
      </form>

      <button onclick="cerrarModal('modalAdd')" class="absolute top-6 right-6 text-slate-500 hover:text-white text-3xl">&times;</button>
    </div>
  </div>


  <!-- ============================
       MODAL: EDITAR
  ============================= -->
  <div id="modalEdit" class="hidden fixed inset-0 z-[100] flex items-center justify-center p-4">
    <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" onclick="cerrarModal('modalEdit')"></div>

    <div class="relative modal-glass max-w-4xl w-full p-10 rounded-2xl">

      <form id="formEdit" action="index.php?controlador=personajes&accion=cEditarPersonaje" method="POST" enctype="multipart/form-data">

        <h2 class="text-4xl font-black uppercase italic mb-10 tracking-tighter text-white">
          Editar <span class="text-indigo-400">Personaje</span>
        </h2>

        <input type="hidden" id="editId" name="idPersonaje" value="">
        <input type="hidden" id="editFotoActual" name="foto_actual" value="">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">

          <div class="space-y-6">
            <div class="grid grid-cols-2 gap-4 text-left">

              <div class="col-span-2">
                <label class="text-[10px] font-black uppercase text-slate-400 tracking-wider">Nombre</label>
                <input id="editNombre" name="nombre" type="text"
                  class="w-full p-3 input-cyber rounded mt-1 text-sm font-bold text-indigo-300">
              </div>

              <div>
                <label class="text-[10px] font-black uppercase text-slate-400 tracking-wider">Rareza</label>
                <select id="editRareza" name="rareza" class="w-full p-3 input-cyber rounded mt-1 text-sm font-bold text-white">
                  <option value="4">4 Estrellas</option>
                  <option value="5">5 Estrellas</option>
                </select>
              </div>

              <div>
                <label class="text-[10px] font-black uppercase text-slate-400 tracking-wider">Arma</label>
                <select id="editArma" name="arma" class="w-full p-3 input-cyber rounded mt-1 text-sm font-bold text-white">
                  <option value="1">Espada</option>
                  <option value="2">Mandoble</option>
                  <option value="3">Lanza</option>
                  <option value="4">Arco</option>
                  <option value="5">Catalizador</option>
                </select>
              </div>

              <div>
                <label class="text-[10px] font-black uppercase text-slate-400 tracking-wider">Ascensión</label>
                <select id="editAscension" name="ascension" class="w-full p-3 input-cyber rounded mt-1 text-sm font-bold text-white">
                  <option value="1">ATK%</option>
                  <option value="2">HP%</option>
                  <option value="3">DEF%</option>
                  <option value="4">Crit Rate</option>
                  <option value="5">Crit DMG</option>
                  <option value="6">Recarga de Energía</option>
                  <option value="7">Maestría Elemental</option>
                  <option value="8">Bono de Curación</option>
                  <option value="13">Bono Físico</option>
                  <option value="14">Bono Pyro</option>
                  <option value="15">Bono Hydro</option>
                  <option value="16">Bono Electro</option>
                  <option value="17">Bono Cryo</option>
                  <option value="18">Bono Anemo</option>
                  <option value="19">Bono Geo</option>
                  <option value="20">Bono Dendro</option>
                </select>
              </div>

              <div>
                <label class="text-[10px] font-black uppercase text-slate-400 tracking-wider">Elemento</label>
                <select id="editElemento" name="elemento" class="w-full p-3 input-cyber rounded mt-1 text-sm font-bold text-white">
                  <option value="1">Pyro</option>
                  <option value="2">Hydro</option>
                  <option value="3">Electro</option>
                  <option value="4">Cryo</option>
                  <option value="5">Anemo</option>
                  <option value="6">Geo</option>
                  <option value="7">Dendro</option>
                </select>
              </div>

              <div>
                <label class="text-[10px] font-black uppercase text-slate-400 tracking-wider">Región</label>
                <select id="editRegion" name="region" class="w-full p-3 input-cyber rounded mt-1 text-sm font-bold text-white">
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

            </div>

            <div class="flex gap-4 mt-4">
              <button type="submit"
                class="w-full py-4 bg-indigo-600 hover:bg-indigo-500 font-black uppercase text-xs rounded tracking-widest transition-all">
                Guardar Cambios
              </button>
              <button type="button" onclick="cerrarModal('modalEdit')"
                class="w-full py-4 bg-slate-700 hover:bg-slate-600 font-black uppercase text-xs rounded tracking-widest transition-all">
                Cancelar
              </button>
            </div>
          </div>

          <!-- DERECHA — preview foto actual -->
          <div class="flex flex-col items-center justify-center border-l border-white/5 pl-10">
            <div class="w-40 aspect-[3/4] bg-slate-900/60 rounded-lg border border-indigo-500/20 mb-6 overflow-hidden flex items-center justify-center">
              <img id="editFotoPreview" src="" class="hidden w-full h-full object-cover" style="object-position: center 10%;">
              <span id="editFotoPlaceholder" class="text-[10px] text-indigo-400/30 uppercase font-black">Foto Actual</span>
            </div>
            <input type="file" name="foto" id="fotoEditInput" class="hidden" accept="image/*">
            <label for="fotoEditInput"
              class="px-8 py-2 bg-slate-800 text-slate-300 font-bold uppercase text-[10px] tracking-widest rounded-lg border border-white/5 cursor-pointer hover:bg-slate-700 transition-all">
              Cambiar Foto
            </label>
            <p class="text-[9px] text-slate-600 mt-2 uppercase tracking-widest">Opcional — deja vacío para mantener</p>
          </div>

        </div>
      </form>

      <button onclick="cerrarModal('modalEdit')" class="absolute top-6 right-6 text-slate-500 hover:text-white text-3xl font-light">&times;</button>
    </div>
  </div>


  <!-- ============================
       MODAL: ERROR
  ============================= -->
  <div id="modalError" class="hidden fixed inset-0 z-[110] flex items-center justify-center p-4 modal-overlay">
    <div class="modal-glass max-w-sm w-full p-8 rounded-xl text-center">
      <div class="text-red-500 text-5xl mb-4">✕</div>
      <h2 class="text-xl font-black uppercase italic mb-2 text-white">Error</h2>
      <p id="errorMsg" class="text-slate-400 text-xs uppercase tracking-widest"></p>
      <button onclick="cerrarModal('modalError')"
        class="w-full mt-6 py-3 bg-red-600 hover:bg-red-500 rounded font-black uppercase text-xs tracking-widest transition-all">
        Cerrar
      </button>
    </div>
  </div>

  <!-- Si PHP manda un error de sesión, lo mostramos al cargar -->
  <?php if (isset($_SESSION['error'])): ?>
  <script>
    window.addEventListener('DOMContentLoaded', () => {
      document.getElementById('errorMsg').textContent = "<?= addslashes($_SESSION['error']) ?>";
      abrirModal('modalError');
    });
  </script>
  <?php unset($_SESSION['error']); ?>
  <?php endif; ?>

  <?php include 'reusables/fotter.html'; ?>

  <script src="../../public/assets/js/personajes.js"></script>
</body>
</html>