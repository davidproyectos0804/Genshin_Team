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
}
