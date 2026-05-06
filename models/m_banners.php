<?php
class M_banners
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
  public function mMostrarBanners()
{
    $SQL = "SELECT 
        b.idBanner,
        b.numero_banner,
        b.fecha_inicio,
        b.fecha_fin,
        b.activo,
        v.idVersion,
        v.numero AS version,
        p.idPersonaje,
        p.nombre AS personaje,
        p.foto AS foto_personaje,
        p.rareza
        FROM Banners b
        JOIN Versiones v ON b.idVersion = v.idVersion
        JOIN BannerPersonajes bp ON b.idBanner = bp.idBanner
        JOIN Personajes p ON bp.idPersonaje = p.idPersonaje
        ORDER BY v.numero DESC, b.numero_banner ASC, p.rareza DESC";
    $stmt = $this->conexion->prepare($SQL);
    $stmt->execute();
    $datos = $stmt->get_result();
    $resultado = [];
    while ($fila = $datos->fetch_assoc()) {
        $idBanner = $fila['idBanner'];
        if (!isset($resultado[$idBanner])) {
            $resultado[$idBanner] = [
                "idBanner"      => $fila['idBanner'],
                "numero_banner" => $fila['numero_banner'],
                "fecha_inicio"  => $fila['fecha_inicio'],
                "fecha_fin"     => $fila['fecha_fin'],
                "activo"        => $fila['activo'],
                "idVersion"     => $fila['idVersion'],
                "version"       => $fila['version'],
                "personajes"    => []
            ];
        }
        $resultado[$idBanner]["personajes"][] = [
            "idPersonaje" => $fila['idPersonaje'],
            "nombre"      => $fila['personaje'],
            "foto"        => $fila['foto_personaje'],
            "rareza"      => $fila['rareza']
        ];
    }
    return array_values($resultado);
}

  public function mAnadirBanner($idVersion, $numero_banner, $fecha_inicio, $fecha_fin, $activo, $personajes)
{
  // $personajes = array de 5 idPersonaje

  $this->conexion->begin_transaction();
  try {
    // Insertar el banner
    $SQL = "INSERT INTO Banners (idVersion, numero_banner, fecha_inicio, fecha_fin, activo) 
            VALUES (?, ?, ?, ?, ?)";
    $stmt = $this->conexion->prepare($SQL);
    $stmt->bind_param("iissi", $idVersion, $numero_banner, $fecha_inicio, $fecha_fin, $activo);
    $stmt->execute();
    $idBanner = $this->conexion->insert_id;

    // Insertar los 5 personajes
    $SQL2 = "INSERT INTO BannerPersonajes (idBanner, idPersonaje) VALUES (?, ?)";
    $stmt2 = $this->conexion->prepare($SQL2);
    foreach ($personajes as $idPersonaje) {
      $stmt2->bind_param("ii", $idBanner, $idPersonaje);
      $stmt2->execute();
    }

    $this->conexion->commit();
    return true;
  } catch (mysqli_sql_exception $e) {
    $this->conexion->rollback();
    return false;
  }
}

  public function mBorrarBanner($id)
  {
    $SQL = "DELETE FROM Banners WHERE idBanner = ?";
    $stmt = $this->conexion->prepare($SQL);
    $stmt->bind_param("i", $id);
    try {
      $stmt->execute();
      return true;
    } catch (mysqli_sql_exception $e) {
      return false;
    }
  }

 public function mEditarBanner($id, $idVersion, $numero_banner, $fecha_inicio, $fecha_fin, $activo, $personajes)
{
  $this->conexion->begin_transaction();
  try {
    // Actualizar el banner
    $SQL = "UPDATE Banners 
            SET idVersion = ?, 
                numero_banner = ?, 
                fecha_inicio = ?, 
                fecha_fin = ?, 
                activo = ?
            WHERE idBanner = ?";
    $stmt = $this->conexion->prepare($SQL);
    $stmt->bind_param("iissii", $idVersion, $numero_banner, $fecha_inicio, $fecha_fin, $activo, $id);
    $stmt->execute();

    // Borrar personajes actuales y reinsertar los nuevos
    $SQL2 = "DELETE FROM BannerPersonajes WHERE idBanner = ?";
    $stmt2 = $this->conexion->prepare($SQL2);
    $stmt2->bind_param("i", $id);
    $stmt2->execute();

    $SQL3 = "INSERT INTO BannerPersonajes (idBanner, idPersonaje) VALUES (?, ?)";
    $stmt3 = $this->conexion->prepare($SQL3);
    foreach ($personajes as $idPersonaje) {
      $stmt3->bind_param("ii", $id, $idPersonaje);
      $stmt3->execute();
    }

    $this->conexion->commit();
    return true;
  } catch (mysqli_sql_exception $e) {
    $this->conexion->rollback();
    return false;
  }
}
public function mMostrarVersiones()
{
    $SQL = "SELECT idVersion, numero FROM Versiones ORDER BY numero DESC";
    $stmt = $this->conexion->prepare($SQL);
    $stmt->execute();
    $datos = $stmt->get_result();
    $resultado = [];
    while ($fila = $datos->fetch_assoc()) {
        $resultado[] = [
            "idVersion" => $fila['idVersion'],
            "numero"    => $fila['numero']
        ];
    }
    return $resultado;
}

public function mMostrarPersonajes()
{
    $SQL = "SELECT idPersonaje, nombre, foto, rareza FROM Personajes ORDER BY rareza DESC, nombre ASC";
    $stmt = $this->conexion->prepare($SQL);
    $stmt->execute();
    $datos = $stmt->get_result();
    $resultado = [];
    while ($fila = $datos->fetch_assoc()) {
        $resultado[] = [
            "idPersonaje" => $fila['idPersonaje'],
            "nombre"      => $fila['nombre'],
            "foto"        => $fila['foto'],
            "rareza"      => $fila['rareza']
        ];
    }
    return $resultado;
}

public function mObtenerBanner($id)
{
    $SQL = "SELECT 
        b.idBanner,
        b.numero_banner,
        b.fecha_inicio,
        b.fecha_fin,
        b.activo,
        b.idVersion,
        GROUP_CONCAT(bp.idPersonaje) AS personajes
        FROM Banners b
        JOIN BannerPersonajes bp ON b.idBanner = bp.idBanner
        WHERE b.idBanner = ?
        GROUP BY b.idBanner";
    $stmt = $this->conexion->prepare($SQL);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $fila = $stmt->get_result()->fetch_assoc();
    if (!$fila) return false;
    return [
        "idBanner"      => $fila['idBanner'],
        "numero_banner" => $fila['numero_banner'],
        "fecha_inicio"  => $fila['fecha_inicio'],
        "fecha_fin"     => $fila['fecha_fin'],
        "activo"        => $fila['activo'],
        "idVersion"     => $fila['idVersion'],
        "personajes"    => explode(",", $fila['personajes'])
    ];
}
}