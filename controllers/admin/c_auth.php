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
        $this->vista = null;
        header('Content-Type: application/json');

        if (empty($_POST['usuario']) || empty($_POST['password'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Rellena todos los campos.']);
            exit();
        }

        $usuario  = $_POST['usuario'];
        $password = $_POST['password'];

        $resultado = $this->objauth->mLogin($usuario);

       if (!$resultado || !password_verify($password, $resultado['password'])) {
        http_response_code(401);
        echo json_encode(['error' => 'Credenciales incorrectas.']);
        exit();
        }

        $_SESSION['admin']   = true;
        $_SESSION['usuario'] = $resultado['nombre'];

        session_write_close();

        echo json_encode(['success' => true]);
        exit();
    }

    public function logout()
    {
        session_destroy();
        header("Location: ./index.php");
        exit();
    }
}