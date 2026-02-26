<?php
ob_start();
require_once 'config/config.php';

$controladorNombre = $_GET["controlador"] ?? DEFAULT_CONTROLADOR;
$accion = $_GET["accion"] ?? DEFAULT_ACCION;

$rutaControlador = CONTROLADORES . 'c_' . $controladorNombre . '.php';
if (!file_exists($rutaControlador)) {
  $controladorNombre = DEFAULT_CONTROLADOR;
  $rutaControlador = CONTROLADORES . 'c_' . $controladorNombre . '.php';
}

require_once $rutaControlador;
$nombreControlador = 'C_' . $controladorNombre;

$isJson = isset($_GET['j']);

if ($isJson) {
  $json = file_get_contents('php://input');
  $datos = json_decode($json, true) ?? [];

  $controlador = new $nombreControlador($datos);    

  if (method_exists($controlador, $accion)) {
    $controlador->{$accion}();
  }
} else {
  $controlador = new $nombreControlador();

  if (method_exists($controlador, $accion)) {
    $dataToView["data"] = $controlador->{$accion}();
  }

  if (isset($controlador->vista) && !empty($controlador->vista)) {
    include 'reusables/nav.php';
    require_once 'views/' . $controlador->vista . '.php';
  }
}
/*
require_once 'config/configR.php';

if(!isset($_GET["controlador"])){$_GET["controlador"] = DEFAULT_CONTROLADOR;}
if(!isset($_GET["accion"])){$_GET["accion"] = DEFAULT_ACCION;}

$rutaControlador = CONTROLADOR.'C'.$_GET["controlador"].'.php'; // 'controller/cControlador.php'

if(!file_exists($rutaControlador)){$rutaControlador = CONTROLADOR.'C'.DEFAULT_CONTROLADOR.'.php';} // 'controller/cPais.php'

require_once $rutaControlador;

$nombreControlador = 'C'.$_GET["controlador"]; //nombre de la clase controlador (Ejemplo: cPais)
$controlador = new $nombreControlador(); //Instanciamos objeto de la clase controlador

$dataToView["data"] = array();
if(method_exists($controlador,$_GET["accion"])){
    $dataToView["data"] = $controlador->{$_GET["accion"]}();
} else {
    // Manejar el error cuando el método no existe
    die("Error: El método ".$_GET["accion"]." no existe en el controlador ".$nombreControlador);
}

if (isset($controlador->vista) && !empty($controlador->vista)) {
    require_once 'vistas/'.$controlador->vista.'.php';
}
*/
