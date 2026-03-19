<?php
class C_personajes
{
public $vista;
private $objpersonajes;

public function __construct()
  {

    require_once 'models/m_personajes.php';
    $this->objpersonajes = new M_personajes();
  }
  
public function cMostrarPersonajes()
  {
    $this->vista = 'personajes';
    $resultado = $this->objpersonajes->mMostrarPersonajes();
    if (is_array($resultado)) {
      return $resultado;
    }
  }
public function cAnadirPersonaje()
{
    $this->vista = 'personajes';

    if (empty($_POST['nombre']) || empty($_POST['rareza']) || empty($_POST['arma']) || 
        empty($_POST['elemento']) || empty($_POST['ascension']) || empty($_FILES['foto']['name'])) {
        // modal de error
        return;
    }

    $nombre = $_POST['nombre'];
    $rareza = $_POST['rareza'];
    $arma = $_POST['arma'];
    $elemento = $_POST['elemento'];
    $ascension = $_POST['ascension'];
    $foto = $_FILES['foto'];

    $tipos = ['image/png', 'image/jpeg', 'image/gif', 'image/webp'];
    if (!in_array($foto['type'], $tipos)) {
        // modal de error
        return;
    }

    // Gestión de la imagen aquí en el controlador
    $directorio = "public/assets/img/personajes/";
    if (!is_dir($directorio)) {
        mkdir($directorio, 0777, true);
    }

    $extension  = pathinfo($foto['name'], PATHINFO_EXTENSION);
    $nombreFoto = uniqid("personaje_", true) . "." . $extension;
    $rutaFinal  = $directorio . $nombreFoto;

    if (!move_uploaded_file($foto['tmp_name'], $rutaFinal)) {
        // modal de error
        return;
    }

    $resultado = $this->objpersonajes->mAnadirPersonaje($nombre, $rareza, $arma, $elemento, $rutaFinal, $ascension);

    if ($resultado) {
        header("Location: ./index.php?controlador=personajes&accion=cMostrarPersonajes");
        exit();
    }
    // modal de error
}
}
