<?php
session_start();
require_once 'config/config_rutas.php';

/* 1. Detectar estado y parámetros */
$isAdmin = $_SESSION['admin'] ?? false;
$controladorNombre = strtolower($_GET["controlador"] ?? DEFAULT_CONTROLADOR);
$accion = $_GET["accion"] ?? DEFAULT_ACCION;

/* 2. Determinar la ruta del archivo del controlador */
// El controlador de 'auth' siempre está en la carpeta admin según tu captura
if ($controladorNombre === 'auth' || $isAdmin) {
    $rutaControlador = CONTROLADOR_ADMIN . 'c_' . $controladorNombre . '.php';
} else {
    $rutaControlador = CONTROLADOR . 'c_' . $controladorNombre . '.php';
}

/* 3. Fallback: Si el archivo no existe, cargar el default de frontend */
if (!file_exists($rutaControlador)) {
    $controladorNombre = DEFAULT_CONTROLADOR;
    $rutaControlador = CONTROLADOR . 'c_' . $controladorNombre . '.php';
}

// Cargar el archivo físicamente
require_once $rutaControlador;

/* 4. Instanciar el controlador */
$nombreClase = 'C_' . $controladorNombre;
$controlador = new $nombreClase();

/* 5. Ejecutar la acción */
$dataToView["data"] = [];
if (method_exists($controlador, $accion)) {
    $dataToView["data"] = $controlador->{$accion}();
} else {
    // Si la acción no existe, podrías ejecutar una por defecto
    $accionDefecto = DEFAULT_ACCION;
    $controlador->$accionDefecto();
}

/* 6. Carga de la Vista (Aquí estaba el lío) */
if (isset($controlador->vista) && !empty($controlador->vista)) {
    
    // Decidir carpeta de la vista
    // 'auth' siempre usa vistas de admin. Si está logueado, también.
    if ($controladorNombre === 'auth' || $isAdmin) {
        $carpetaVista = 'views/admin/';
    } else {
        $carpetaVista = 'views/frontend/';
    }

    $rutaCompletaVista = $carpetaVista . $controlador->vista . '.php';

    if (file_exists($rutaCompletaVista)) {
        require_once $rutaCompletaVista;
    } else {
        echo "Error: La vista {$rutaCompletaVista} no existe.";
    }
}