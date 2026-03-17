<?php
class M_personajes
{
  private $conexion;

  public function __construct()
  {
    require_once("config/config.php");
    $this->conexion = new mysqli(SERVIDOR, USUARIO, PASSWORD, BBDD);

    // Verifica la conexión
    if ($this->conexion->connect_error) {
      die("Conexión fallida: " . $this->conexion->connect_error);
    }
  }

 public function mMostrarPersonajes()
{
    $SQL = "SELECT 
        p.idPersonaje,
        p.nombre AS personaje,
        p.foto AS foto_personaje,
        p.rareza,

        e.nombre AS elemento,
        e.foto AS foto_elemento,

        a.nombre AS arma,
        a.foto AS foto_arma,

        s.nombre AS estadistica,
        s.foto AS foto_estadistica

    FROM Personajes p
    JOIN Elementos e ON p.idElemento = e.idElemento
    JOIN Armas a ON p.idArma = a.idArma
    JOIN EstadisticasAscension s ON p.idEstadistica = s.idEstadistica";

    $stmt = $this->conexion->prepare($SQL);
    $stmt->execute();
    $datos = $stmt->get_result();

    $resultado = [];
    while ($fila = $datos->fetch_assoc()) {
        $resultado[] = [
            "idPersonaje" => $fila['idPersonaje'],
            "nombre" => $fila['personaje'],
            "foto" => $fila['foto_personaje'],
            "rareza" => $fila['rareza'],

            "elemento" => $fila['elemento'],
            "foto_elemento" => $fila['foto_elemento'],

            "arma" => $fila['arma'],
            "foto_arma" => $fila['foto_arma'],

            "estadistica" => $fila['estadistica'],
            "foto_estadistica" => $fila['foto_estadistica']
        ];
    }

    return $resultado;
}
public function mAnadirPersonaje(){
    
}
}