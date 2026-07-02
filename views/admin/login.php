<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | Abyss Overdrive</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
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
    <link rel="icon" type="image/png" href="../../public/assets/img/favicon/favicon-16x16.png">
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

            <form id="formLogin" method="POST" class="space-y-6">
                
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
                    <div class="relative">
                        <input 
                            type="password"
                            id="passwordInput"
                            name="password" 
                            placeholder="••••••••" 
                            class="w-full p-4 input-cyber rounded-lg text-sm font-bold placeholder-slate-600 pr-12"
                        >
                        <button type="button" onclick="togglePassword()"
                            class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-500 hover:text-indigo-400 transition-colors">
                            <svg id="ojoCerrado" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 4.411m0 0L21 21"></path>
                            </svg>
                            <svg id="ojoAbierto" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full py-4 bg-indigo-600 hover:bg-indigo-500 text-white font-black uppercase text-xs tracking-[3px] rounded-md transition-all shadow-[0_0_25px_rgba(79,70,229,0.3)] hover:shadow-[0_0_35px_rgba(79,70,229,0.5)] active:scale-[0.98]">
                        Iniciar Sesión
                    </button>
                </div>
            </form>
        </div>

        <div id="errorDiv" class="hidden mt-6 p-4 bg-red-500/10 border border-red-500/20 rounded-lg">
            <p id="errorMsg" class="text-red-400 text-[10px] font-black uppercase tracking-widest text-center"></p>
        </div>

    </main>

    <footer class="mt-12 text-slate-600 text-[9px] font-bold uppercase tracking-[4px]">
        Abyss Overdrive &copy; 2026
    </footer>

    <script src="../../public/assets/js/login.js"></script>
    <script src="../../public/assets/js/models/loginModel.js"></script>
    <script src="../../public/assets/js/controllers/loginController.js"></script>
</body>
</html>