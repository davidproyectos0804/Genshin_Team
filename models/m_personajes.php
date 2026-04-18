<?php
class M_personajes
{
  private $conexion;
  public function __construct()
  {
    require_once("config/config.php");
    $this->conexion = new mysqli(SERVIDOR, USUARIO, PASSWORD, BBDD);
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
    e.idElemento,
    e.nombre AS elemento,
    e.foto AS foto_elemento,
    a.idArma,
    a.nombre AS arma,
    a.foto AS foto_arma,
    s.idEstadistica,
    s.nombre AS estadistica,
    s.foto AS foto_estadistica,
    r.idRegion,
    r.nombre AS region,
    r.foto AS foto_region 
    FROM Personajes p
    JOIN Elementos e ON p.idElemento = e.idElemento
    JOIN Armas a ON p.idArma = a.idArma
    JOIN EstadisticasAscension s ON p.idEstadistica = s.idEstadistica
    JOIN Regiones r ON p.idRegion = r.idRegion
    ORDER BY p.nombre ASC";

    $stmt = $this->conexion->prepare($SQL);
    $stmt->execute();
    $datos = $stmt->get_result();
    $resultado = [];
    while ($fila = $datos->fetch_assoc()) {
        $resultado[] = [
            "idPersonaje"      => $fila['idPersonaje'],
            "nombre"           => $fila['personaje'],
            "foto"             => $fila['foto_personaje'],
            "rareza"           => $fila['rareza'],
            "idElemento"       => $fila['idElemento'],
            "elemento"         => $fila['elemento'],
            "foto_elemento"    => $fila['foto_elemento'],
            "idArma"           => $fila['idArma'],
            "arma"             => $fila['arma'],
            "foto_arma"        => $fila['foto_arma'],
            "idEstadistica"    => $fila['idEstadistica'],
            "estadistica"      => $fila['estadistica'],
            "foto_estadistica" => $fila['foto_estadistica'],
            "idRegion"         => $fila['idRegion'],
            "region"           => $fila['region'],
            "foto_region"      => $fila['foto_region'],
        ];
    }
    return $resultado;
  }

  public function mAnadirPersonaje($nombre, $rareza, $idArma, $idElemento, $foto, $idEstadistica, $idRegion)
  {
    $SQL = "INSERT INTO Personajes (nombre, rareza, idArma, idElemento, idEstadistica, idRegion, foto) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $this->conexion->prepare($SQL);
    $stmt->bind_param("siiiiis", $nombre, $rareza, $idArma, $idElemento, $idEstadistica, $idRegion, $foto);
    try {
        $stmt->execute();
        return true;
    } catch (mysqli_sql_exception $e) {
        return false;
    }
  }
  public function mBorrarPersonaje($id){
    $SQL = "DELETE FROM Personajes WHERE idPersonaje = ?";
    $stmt = $this->conexion->prepare($SQL);
    $stmt->bind_param("i", $id);
    try {
        $stmt->execute();
        return true;
    } catch (mysqli_sql_exception $e) {
        return false;
    }
  }
 public function mEditarPersonaje($id, $nombre, $rareza, $idArma, $idElemento, $foto, $idEstadistica, $idRegion){
    $SQL = "UPDATE Personajes 
            SET nombre = ?, 
                rareza = ?, 
                idArma = ?, 
                idElemento = ?, 
                idEstadistica = ?, 
                idRegion = ?, 
                foto = ?
            WHERE idPersonaje = ?";

    $stmt = $this->conexion->prepare($SQL);
    $stmt->bind_param("siiiiisi", $nombre, $rareza, $idArma, $idElemento, $idEstadistica, $idRegion, $foto, $id);

    try {
        $stmt->execute();
        return true;
    } catch (mysqli_sql_exception $e) {
        return false;
    }
}
}