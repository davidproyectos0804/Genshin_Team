<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | Abyss Overdrive</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Reutilizamos los estilos de tu archivo personajes_principal.css */
        .glass-card {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
        .input-cyber {
            background: rgba(15, 15, 35, 0.7);
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
            color: white;
        }
        .input-cyber:focus {
            border-color: #6366f1;
            outline: none;
            box-shadow: 0 0 15px rgba(99, 102, 241, 0.2);
        }
    </style>
</head>

<body class="text-white bg-[#0a0a1a] min-h-screen flex flex-col justify-center items-center p-6">

    <div class="fixed top-[-10%] left-[-10%] w-[40%] h-[40%] bg-indigo-900/20 blur-[120px] rounded-full -z-10"></div>
    <div class="fixed bottom-[-10%] right-[-10%] w-[40%] h-[40%] bg-purple-900/10 blur-[120px] rounded-full -z-10"></div>

    <main class="w-full max-w-md">
        
        <div class="text-center mb-10">
            <h1 class="text-5xl font-black uppercase italic tracking-tighter leading-none mb-2">
                ADMIN <span class="text-indigo-400">ACCESS</span>
            </h1>
            <p class="text-slate-400 text-[10px] uppercase tracking-[5px] font-bold opacity-70">
                Protocolo de Seguridad Teyvat
            </p>
        </div>

        <div class="glass-card p-10 rounded-2xl shadow-2xl relative overflow-hidden">
            <div class="absolute top-0 left-0 w-full h-[2px] bg-gradient-to-r from-transparent via-indigo-500 to-transparent"></div>

            <form method="POST" action="index.php?controlador=auth&accion=login" class="space-y-6">
                
                <div class="flex flex-col gap-2 text-left">
                    <label class="text-[10px] font-black uppercase text-slate-400 tracking-widest ml-1">Usuario</label>
                    <input 
                        type="text" 
                        name="usuario" 
                        placeholder="Introduce tu usuario" 
                        class="w-full p-4 input-cyber rounded-lg text-sm font-bold placeholder-slate-600"
                    >
                </div>

                <div class="flex flex-col gap-2 text-left">
                    <label class="text-[10px] font-black uppercase text-slate-400 tracking-widest ml-1">Contraseña</label>
                    <input 
                        type="password" 
                        name="password" 
                        placeholder="••••••••" 
                        class="w-full p-4 input-cyber rounded-lg text-sm font-bold placeholder-slate-600"
                    >
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full py-4 bg-indigo-600 hover:bg-indigo-500 text-white font-black uppercase text-xs tracking-[3px] rounded-md transition-all shadow-[0_0_25px_rgba(79,70,229,0.3)] hover:shadow-[0_0_35px_rgba(79,70,229,0.5)] active:scale-[0.98]">
                        Iniciar Sesión
                    </button>
                </div>
            </form>
        </div>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="mt-6 p-4 bg-red-500/10 border border-red-500/20 rounded-lg animate-pulse">
                <p class="text-red-400 text-[10px] font-black uppercase tracking-widest text-center">
                    ✕ <?= htmlspecialchars($_SESSION['error']) ?>
                </p>
            </div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

    </main>

    <footer class="mt-12 text-slate-600 text-[9px] font-bold uppercase tracking-[4px]">
        Abyss Overdrive &copy; 2026
    </footer>

</body>
</html>