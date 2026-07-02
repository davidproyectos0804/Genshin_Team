<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Banners | Genshin Teambuilder</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="icon" type="image/png" href="../../public/assets/img/favicon/favicon-16x16.png">
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
      <button onclick="abrirModal('modalAdd')"
        class="w-full md:w-auto px-10 py-4 bg-indigo-600 hover:bg-indigo-500 text-white font-black uppercase text-xs tracking-widest rounded-md transition-all shadow-[0_0_25px_rgba(79,70,229,0.4)]">
        + Añadir Banner
      </button>
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
                  <div class="flex items-center gap-3">
                    <?php if ($b['activo']): ?>
                      <span class="px-3 py-1 bg-green-500/10 text-green-400 text-[10px] font-black uppercase tracking-widest rounded-full border border-green-500/20">
                        Activo
                      </span>
                    <?php else: ?>
                      <span class="px-3 py-1 bg-slate-800 text-slate-500 text-[10px] font-black uppercase tracking-widest rounded-full border border-white/5">
                        Inactivo
                      </span>
                    <?php endif; ?>
                    <button onclick="abrirModalEditar(this)"
                      data-id="<?= $b['idBanner'] ?>"
                      data-version="<?= $b['idVersion'] ?>"
                      data-numero="<?= $b['numero_banner'] ?>"
                      data-inicio="<?= $b['fecha_inicio'] ?>"
                      data-fin="<?= $b['fecha_fin'] ?>"
                      data-activo="<?= $b['activo'] ?>"
                      data-personajes="<?= htmlspecialchars(json_encode(array_column($b['personajes'], 'idPersonaje')), ENT_QUOTES) ?>"
                      class="text-slate-500 hover:text-indigo-400 transition-all transform hover:scale-110">
                      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                        <circle cx="12" cy="12" r="3"></circle>
                      </svg>
                    </button>
                    <button onclick="abrirModalBorrar(this)"
                      data-id="<?= $b['idBanner'] ?>"
                      data-version="<?= htmlspecialchars($version) ?>"
                      data-numero="<?= $b['numero_banner'] ?>"
                      class="text-slate-500 hover:text-red-500 transition-all transform hover:scale-110">
                      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                      </svg>
                    </button>
                  </div>
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


  <!-- MODAL: AÑADIR -->
  <div id="modalAdd" class="hidden fixed inset-0 z-[100] flex items-center justify-center p-4">
    <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" onclick="cerrarModal('modalAdd')"></div>
    <div class="relative modal-glass max-w-2xl w-full p-10 rounded-2xl">
      <button onclick="cerrarModal('modalAdd')" class="absolute top-6 right-6 text-slate-500 hover:text-white text-3xl">&times;</button>
      <form id="formAdd" method="POST">
        <h2 class="text-4xl font-black uppercase italic mb-10 tracking-tighter text-white">
          Nuevo <span class="text-indigo-400">Banner</span>
        </h2>
        <div class="grid grid-cols-2 gap-4 mb-6">
          <div>
            <label class="text-[10px] font-black uppercase text-slate-400 tracking-wider">Versión</label>
            <select name="idVersion" class="w-full p-3 input-cyber rounded mt-1 text-sm font-bold text-white">
              <option value="" disabled selected>Selecciona versión</option>
              <?php foreach ($dataToView["data"][1] as $v): ?>
                <option value="<?= $v['idVersion'] ?>"><?= htmlspecialchars($v['numero']) ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div>
            <label class="text-[10px] font-black uppercase text-slate-400 tracking-wider">Número de banner</label>
            <select name="numero_banner" class="w-full p-3 input-cyber rounded mt-1 text-sm font-bold text-white">
              <option value="1">Banner 1</option>
              <option value="2">Banner 2</option>
            </select>
          </div>
          <div>
            <label class="text-[10px] font-black uppercase text-slate-400 tracking-wider">Fecha inicio</label>
            <input type="date" name="fecha_inicio" class="w-full p-3 input-cyber rounded mt-1 text-sm font-bold text-white">
          </div>
          <div>
            <label class="text-[10px] font-black uppercase text-slate-400 tracking-wider">Fecha fin</label>
            <input type="date" name="fecha_fin" class="w-full p-3 input-cyber rounded mt-1 text-sm font-bold text-white">
          </div>
          <div class="col-span-2 flex items-center gap-3">
            <input type="checkbox" name="activo" id="addActivo" value="1" class="w-4 h-4 accent-indigo-500">
            <label for="addActivo" class="text-[10px] font-black uppercase text-slate-400 tracking-wider">Banner activo actualmente</label>
          </div>
        </div>
        <p class="text-[10px] font-black uppercase text-slate-500 tracking-wider mb-3">Personajes 5 ★</p>
        <div class="grid grid-cols-2 gap-4 mb-6">
          <?php for ($i = 0; $i < 2; $i++): ?>
            <select name="personajes[]" class="w-full p-3 input-cyber rounded text-sm font-bold text-white">
              <option value="" disabled selected>Selecciona personaje</option>
              <?php foreach ($dataToView["data"][2] as $p): ?>
                <?php if ($p['rareza'] == 5): ?>
                  <option value="<?= $p['idPersonaje'] ?>"><?= htmlspecialchars($p['nombre']) ?></option>
                <?php endif; ?>
              <?php endforeach; ?>
            </select>
          <?php endfor; ?>
        </div>
        <p class="text-[10px] font-black uppercase text-slate-500 tracking-wider mb-3">Personajes 4 ★</p>
        <div class="grid grid-cols-3 gap-4 mb-8">
          <?php for ($i = 0; $i < 3; $i++): ?>
            <select name="personajes[]" class="w-full p-3 input-cyber rounded text-sm font-bold text-white">
              <option value="" disabled selected>Selecciona personaje</option>
              <?php foreach ($dataToView["data"][2] as $p): ?>
                <?php if ($p['rareza'] == 4): ?>
                  <option value="<?= $p['idPersonaje'] ?>"><?= htmlspecialchars($p['nombre']) ?></option>
                <?php endif; ?>
              <?php endforeach; ?>
            </select>
          <?php endfor; ?>
        </div>
        <button type="submit"
          class="w-full py-4 bg-indigo-600 hover:bg-indigo-500 font-black uppercase text-xs rounded tracking-widest transition-all">
          Añadir Banner
        </button>
      </form>
    </div>
  </div>


  <!-- MODAL: EDITAR -->
  <div id="modalEdit" class="hidden fixed inset-0 z-[100] flex items-center justify-center p-4">
    <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" onclick="cerrarModal('modalEdit')"></div>
    <div class="relative modal-glass max-w-2xl w-full p-10 rounded-2xl">
      <button onclick="cerrarModal('modalEdit')" class="absolute top-6 right-6 text-slate-500 hover:text-white text-3xl">&times;</button>
      <form id="formEdit" method="POST">
        <h2 class="text-4xl font-black uppercase italic mb-10 tracking-tighter text-white">
          Editar <span class="text-indigo-400">Banner</span>
        </h2>
        <input type="hidden" id="editIdBanner" name="idBanner" value="">
        <div class="grid grid-cols-2 gap-4 mb-6">
          <div>
            <label class="text-[10px] font-black uppercase text-slate-400 tracking-wider">Versión</label>
            <select id="editVersion" name="idVersion" class="w-full p-3 input-cyber rounded mt-1 text-sm font-bold text-white">
              <?php foreach ($dataToView["data"][1] as $v): ?>
                <option value="<?= $v['idVersion'] ?>"><?= htmlspecialchars($v['numero']) ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div>
            <label class="text-[10px] font-black uppercase text-slate-400 tracking-wider">Número de banner</label>
            <select id="editNumero" name="numero_banner" class="w-full p-3 input-cyber rounded mt-1 text-sm font-bold text-white">
              <option value="1">Banner 1</option>
              <option value="2">Banner 2</option>
            </select>
          </div>
          <div>
            <label class="text-[10px] font-black uppercase text-slate-400 tracking-wider">Fecha inicio</label>
            <input type="date" id="editInicio" name="fecha_inicio" class="w-full p-3 input-cyber rounded mt-1 text-sm font-bold text-white">
          </div>
          <div>
            <label class="text-[10px] font-black uppercase text-slate-400 tracking-wider">Fecha fin</label>
            <input type="date" id="editFin" name="fecha_fin" class="w-full p-3 input-cyber rounded mt-1 text-sm font-bold text-white">
          </div>
          <div class="col-span-2 flex items-center gap-3">
            <input type="checkbox" name="activo" id="editActivo" value="1" class="w-4 h-4 accent-indigo-500">
            <label for="editActivo" class="text-[10px] font-black uppercase text-slate-400 tracking-wider">Banner activo actualmente</label>
          </div>
        </div>
        <p class="text-[10px] font-black uppercase text-slate-500 tracking-wider mb-3">Personajes 5 ★</p>
        <div class="grid grid-cols-2 gap-4 mb-6">
          <?php for ($i = 0; $i < 2; $i++): ?>
            <select id="editPersonaje5_<?= $i ?>" name="personajes[]" class="w-full p-3 input-cyber rounded text-sm font-bold text-white">
              <?php foreach ($dataToView["data"][2] as $p): ?>
                <?php if ($p['rareza'] == 5): ?>
                  <option value="<?= $p['idPersonaje'] ?>"><?= htmlspecialchars($p['nombre']) ?></option>
                <?php endif; ?>
              <?php endforeach; ?>
            </select>
          <?php endfor; ?>
        </div>
        <p class="text-[10px] font-black uppercase text-slate-500 tracking-wider mb-3">Personajes 4 ★</p>
        <div class="grid grid-cols-3 gap-4 mb-8">
          <?php for ($i = 0; $i < 3; $i++): ?>
            <select id="editPersonaje4_<?= $i ?>" name="personajes[]" class="w-full p-3 input-cyber rounded text-sm font-bold text-white">
              <?php foreach ($dataToView["data"][2] as $p): ?>
                <?php if ($p['rareza'] == 4): ?>
                  <option value="<?= $p['idPersonaje'] ?>"><?= htmlspecialchars($p['nombre']) ?></option>
                <?php endif; ?>
              <?php endforeach; ?>
            </select>
          <?php endfor; ?>
        </div>
        <button type="submit"
          class="w-full py-4 bg-indigo-600 hover:bg-indigo-500 font-black uppercase text-xs rounded tracking-widest transition-all">
          Guardar Cambios
        </button>
      </form>
    </div>
  </div>


  <!-- MODAL: BORRAR -->
  <div id="modalDel" class="hidden fixed inset-0 z-[100] flex items-center justify-center p-4 modal-overlay">
    <div class="modal-glass max-w-sm w-full p-8 rounded-xl text-center">
      <h2 class="text-xl font-black uppercase italic mb-4 text-white">
        ¿Borrar banner <span id="delInfo" class="text-red-500"></span>?
      </h2>
      <form id="formDel">
        <input type="hidden" id="delId" name="idBanner" value="">
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


  <!-- MODAL: ERROR -->
  <div id="modalError" class="hidden fixed inset-0 z-[110] flex items-center justify-center p-4 modal-overlay">
    <div class="modal-glass max-w-sm w-full p-8 rounded-xl text-center">
      <div class="text-red-500 text-5xl mb-4">✕</div>
      <h2 class="text-xl font-black uppercase italic mb-2 text-white">Error</h2>
      <p id="errorMsg" class="text-slate-400 text-xs uppercase tracking-widest"></p>
      <button onclick="cerrarModalError()"
        class="w-full mt-6 py-3 bg-red-600 hover:bg-red-500 rounded font-black uppercase text-xs tracking-widest transition-all">
        Cerrar
      </button>
    </div>
  </div>

  <?php include 'reusables/fotter.html'; ?>

  <script src="../../public/assets/js/banners.js"></script>
  <script src="../../public/assets/js/models/bannersModel.js"></script>
  <script src="../../public/assets/js/controllers/bannersController.js"></script>

</body>
</html>