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
        $this->vista = null;
        header('Content-Type: application/json');

        if (empty($_POST['nombre']) || empty($_POST['rareza']) || empty($_POST['arma']) ||
            empty($_POST['elemento']) || empty($_POST['ascension']) || empty($_POST['region']) ||
            !isset($_FILES['foto']) || $_FILES['foto']['error'] !== UPLOAD_ERR_OK) {
            http_response_code(400);
            echo json_encode(['error' => 'Rellena todos los campos correctamente.']);
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
            http_response_code(400);
            echo json_encode(['error' => 'Formato de imagen no permitido.']);
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
            http_response_code(500);
            echo json_encode(['error' => 'Error al subir la imagen.']);
            exit();
        }

        $resultado = $this->objpersonajes->mAnadirPersonaje($nombre, $rareza, $arma, $elemento, $rutaFinal, $ascension, $region);

        if (!$resultado) {
            http_response_code(500);
            echo json_encode(['error' => 'Error al guardar en la base de datos.']);
            exit();
        }

        echo json_encode(['success' => true]);
        exit();
    }

    public function cBorrarPersonaje()
    {
        $this->vista = null;
        header('Content-Type: application/json');

        if (empty($_POST['idPersonaje'])) {
            http_response_code(400);
            echo json_encode(['error' => 'ID de personaje no recibido.']);
            exit();
        }

        $id = $_POST['idPersonaje'];
        $resultado = $this->objpersonajes->mBorrarPersonaje($id);

        if (!$resultado) {
            http_response_code(500);
            echo json_encode(['error' => 'Error al borrar en la base de datos.']);
            exit();
        }

        echo json_encode(['success' => true]);
        exit();
    }

    public function cEditarPersonaje()
    {
        $this->vista = null;
        header('Content-Type: application/json');

        if (empty($_POST['idPersonaje']) || empty($_POST['nombre']) || empty($_POST['rareza']) ||
            empty($_POST['arma']) || empty($_POST['elemento']) || empty($_POST['ascension']) || empty($_POST['region'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Rellena todos los campos correctamente.']);
            exit();
        }

        $id        = $_POST['idPersonaje'];
        $nombre    = $_POST['nombre'];
        $rareza    = $_POST['rareza'];
        $arma      = $_POST['arma'];
        $elemento  = $_POST['elemento'];
        $ascension = $_POST['ascension'];
        $region    = $_POST['region'];

        if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
            $tipos = ['image/png', 'image/jpeg', 'image/gif', 'image/webp'];
            if (!in_array($_FILES['foto']['type'], $tipos)) {
                http_response_code(400);
                echo json_encode(['error' => 'Formato de imagen no permitido.']);
                exit();
            }

            $directorio = "public/assets/img/personajes/";
            if (!is_dir($directorio)) mkdir($directorio, 0777, true);

            $extension  = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
            $nombreFoto = uniqid("personaje_", true) . "." . $extension;
            $rutaFinal  = $directorio . $nombreFoto;

            if (!move_uploaded_file($_FILES['foto']['tmp_name'], $rutaFinal)) {
                http_response_code(500);
                echo json_encode(['error' => 'Error al subir la imagen.']);
                exit();
            }
        } else {
            $rutaFinal = $_POST['foto_actual'] ?? '';
        }

        $resultado = $this->objpersonajes->mEditarPersonaje($id, $nombre, $rareza, $arma, $elemento, $rutaFinal, $ascension, $region);

        if (!$resultado) {
            http_response_code(500);
            echo json_encode(['error' => 'Error al actualizar en la base de datos.']);
            exit();
        }

        echo json_encode(['success' => true]);
        exit();
    }
}