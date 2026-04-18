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
        empty($_POST['elemento']) || empty($_POST['ascension']) || empty($_POST['region']) ||
        !isset($_FILES['foto']) || $_FILES['foto']['error'] !== UPLOAD_ERR_OK) {
        $_SESSION['error'] = "Rellena todos los campos correctamente.";
        header("Location: ./index.php?controlador=personajes&accion=cMostrarPersonajes");
        exit();
    }

    $nombre    = $_POST['nombre'];
    $rareza    = $_POST['rareza'];
    $arma      = $_POST['arma'];
    $elemento  = $_POST['elemento'];
    $ascension = $_POST['ascension'];
    $region    = $_POST['region'];
    $foto      = $_FILES['foto'];

    $tipos = ['image/png', 'image/jpeg', 'image/gif', 'image/webp'];
    if (!in_array($foto['type'], $tipos)) {
        $_SESSION['error'] = "Formato de imagen no permitido.";
        header("Location: ./index.php?controlador=personajes&accion=cMostrarPersonajes");
        exit();
    }

    $directorio = "public/assets/img/personajes/";
    if (!is_dir($directorio)) {
        mkdir($directorio, 0777, true);
    }

    $extension  = pathinfo($foto['name'], PATHINFO_EXTENSION);
    $nombreFoto = uniqid("personaje_", true) . "." . $extension;
    $rutaFinal  = $directorio . $nombreFoto;

    if (!move_uploaded_file($foto['tmp_name'], $rutaFinal)) {
        $_SESSION['error'] = "Error al subir la imagen.";
        header("Location: ./index.php?controlador=personajes&accion=cMostrarPersonajes");
        exit();
    }

    $resultado = $this->objpersonajes->mAnadirPersonaje($nombre, $rareza, $arma, $elemento, $rutaFinal, $ascension, $region);

    if (!$resultado) {
        $_SESSION['error'] = "Error al guardar en la base de datos.";
    }

    header("Location: ./index.php?controlador=personajes&accion=cMostrarPersonajes");
    exit();
}
public function cBorrarPersonaje(){
  $this->vista='personajes';
  if(empty($_POST["idPersonaje"])){
    $_SESSION['error'] = "Error al borrar el personaje.";
        header("Location: ./index.php?controlador=personajes&accion=cMostrarPersonajes");
        exit();
  }
  $id = $_POST["idPersonaje"];
  $resultado = $this->objpersonajes->mBorrarPersonaje($id);
   if (!$resultado) {
        $_SESSION['error'] = "Error al Borrar en la base de datos.";
    }

    header("Location: ./index.php?controlador=personajes&accion=cMostrarPersonajes");
    exit();
}
public function cEditarPersonaje() {
    $this->vista = 'personajes';

    if (empty($_POST['idPersonaje']) || empty($_POST['nombre']) || empty($_POST['rareza']) ||
        empty($_POST['arma']) || empty($_POST['elemento']) || empty($_POST['ascension']) || empty($_POST['region'])) {
        $_SESSION['error'] = "Rellena todos los campos correctamente.";
        header("Location: ./index.php?controlador=personajes&accion=cMostrarPersonajes");
        exit();
    }

    $id        = $_POST['idPersonaje'];
    $nombre    = $_POST['nombre'];
    $rareza    = $_POST['rareza'];
    $arma      = $_POST['arma'];
    $elemento  = $_POST['elemento'];
    $ascension = $_POST['ascension'];
    $region    = $_POST['region'];

    // Si sube foto nueva, procesarla; si no, recuperar la actual de la BD
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $tipos = ['image/png', 'image/jpeg', 'image/gif', 'image/webp'];
        if (!in_array($_FILES['foto']['type'], $tipos)) {
            $_SESSION['error'] = "Formato de imagen no permitido.";
            header("Location: ./index.php?controlador=personajes&accion=cMostrarPersonajes");
            exit();
        }
        $directorio = "public/assets/img/personajes/";
        if (!is_dir($directorio)) mkdir($directorio, 0777, true);
        $extension  = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
        $nombreFoto = uniqid("personaje_", true) . "." . $extension;
        $rutaFinal  = $directorio . $nombreFoto;
        if (!move_uploaded_file($_FILES['foto']['tmp_name'], $rutaFinal)) {
            $_SESSION['error'] = "Error al subir la imagen.";
            header("Location: ./index.php?controlador=personajes&accion=cMostrarPersonajes");
            exit();
        }
    } else {
        // Mantener foto actual: el modelo necesita la ruta, la pasamos desde un hidden input o la obtenemos de BD
        $rutaFinal = $_POST['foto_actual'] ?? '';
    }

    $resultado = $this->objpersonajes->mEditarPersonaje($id, $nombre, $rareza, $arma, $elemento, $rutaFinal, $ascension, $region);

    if (!$resultado) {
        $_SESSION['error'] = "Error al actualizar en la base de datos.";
    }

    header("Location: ./index.php?controlador=personajes&accion=cMostrarPersonajes");
    exit();
}
}
