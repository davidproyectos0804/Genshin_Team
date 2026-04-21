<?php

class C_auth
{
    public $vista;
    private $objauth;

    public function __construct()
    {
        require_once 'models/m_auth.php';
        $this->objauth = new M_auth();
    }

    public function loginForm()
    {
        $this->vista = 'login';
    }

    public function login()
    {
        $this->vista = 'login';

        if (empty($_POST['usuario']) || empty($_POST['password'])) {
            $_SESSION['error'] = "Rellena todos los campos.";
            header("Location: ./index.php?controlador=auth&accion=loginForm");
            exit();
        }

        $usuario  = $_POST['usuario'];
        $password = $_POST['password'];

        $resultado = $this->objauth->mLogin($usuario);

        if (!$resultado) {
            $_SESSION['error'] = "Usuario incorrecto.";
            header("Location: ./index.php?controlador=auth&accion=loginForm");
            exit();
        }

       if ($password !== $resultado['password']) {
            $_SESSION['error'] = "Contraseña incorrecta.";
            header("Location: ./index.php?controlador=auth&accion=loginForm");
            exit();
        }

        $_SESSION['admin'] = true;
        $_SESSION['usuario'] = $resultado['nombre'];
        session_write_close(); // Forza el guardado
        header("Location: index.php");
        exit();
    }

    public function logout()
    {
        session_destroy();
        header("Location: ./index.php");
        exit();
    }
}