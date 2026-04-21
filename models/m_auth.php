<?php

class M_auth
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

    public function mLogin($usuario)
{
    $SQL = "SELECT idUsuario, nombre, password 
            FROM usuarios 
            WHERE nombre = ?";

    $stmt = $this->conexion->prepare($SQL);
    $stmt->bind_param("s", $usuario);
    $stmt->execute();

    $resultado = $stmt->get_result();

    if ($fila = $resultado->fetch_assoc()) {
        return $fila;
    }

    return false;
}
}