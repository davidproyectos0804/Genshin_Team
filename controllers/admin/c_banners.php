<?php
class C_banners {
    private $objbanners;
    public $vista;

    public function __construct() {
        require_once("models/m_banners.php");
        $this->objbanners = new M_banners();
    }

    public function cMostrarBanners() {
        $this->vista = 'banners';
        $banners    = $this->objbanners->mMostrarBanners();
        $versiones  = $this->objbanners->mMostrarVersiones();
        $personajes = $this->objbanners->mMostrarPersonajes();
        return [$banners, $versiones, $personajes];
    }

    public function cAnadirBanner() {
        $this->vista = null;
        header('Content-Type: application/json');

        if (
            !isset($_POST['idVersion']) ||
            !isset($_POST['numero_banner']) ||
            empty($_POST['fecha_inicio']) ||
            empty($_POST['fecha_fin']) ||
            !isset($_POST['personajes']) ||
            count($_POST['personajes']) !== 5
        ) {
            http_response_code(400);
            echo json_encode(['error' => 'Faltan datos obligatorios']);
            exit();
        }

        $personajes = $_POST['personajes'];
        if (count($personajes) !== count(array_unique($personajes))) {
            http_response_code(400);
            echo json_encode(['error' => 'No puedes repetir personajes en el mismo banner']);
            exit();
        }

        $fecha_inicio = $_POST['fecha_inicio'];
        $fecha_fin    = $_POST['fecha_fin'];
        if ($fecha_fin < $fecha_inicio) {
            http_response_code(400);
            echo json_encode(['error' => 'La fecha de fin no puede ser anterior a la de inicio']);
            exit();
        }

        $resultado = $this->objbanners->mAnadirBanner(
            $_POST['idVersion'],
            $_POST['numero_banner'],
            $fecha_inicio,
            $fecha_fin,
            isset($_POST['activo']) ? 1 : 0,
            $personajes
        );

        if ($resultado === true) {
            echo json_encode(['success' => true]);
            exit();
        }

        http_response_code(500);
        echo json_encode(['error' => 'Error al añadir el banner, puede que ya exista ese banner para esa versión']);
        exit();
    }

    public function cModificarBanner() {
        $this->vista = null;
        header('Content-Type: application/json');

        if (
            !isset($_POST['idBanner']) ||
            !isset($_POST['idVersion']) ||
            !isset($_POST['numero_banner']) ||
            empty($_POST['fecha_inicio']) ||
            empty($_POST['fecha_fin']) ||
            !isset($_POST['personajes']) ||
            count($_POST['personajes']) !== 5
        ) {
            http_response_code(400);
            echo json_encode(['error' => 'Faltan datos obligatorios']);
            exit();
        }

        $personajes = $_POST['personajes'];
        if (count($personajes) !== count(array_unique($personajes))) {
            http_response_code(400);
            echo json_encode(['error' => 'No puedes repetir personajes en el mismo banner']);
            exit();
        }

        $fecha_inicio = $_POST['fecha_inicio'];
        $fecha_fin    = $_POST['fecha_fin'];
        if ($fecha_fin < $fecha_inicio) {
            http_response_code(400);
            echo json_encode(['error' => 'La fecha de fin no puede ser anterior a la de inicio']);
            exit();
        }

        $banner = $this->objbanners->mObtenerBanner($_POST['idBanner']);
        if (!$banner) {
            http_response_code(404);
            echo json_encode(['error' => 'Banner no encontrado']);
            exit();
        }

        $resultado = $this->objbanners->mEditarBanner(
            $_POST['idBanner'],
            $_POST['idVersion'],
            $_POST['numero_banner'],
            $fecha_inicio,
            $fecha_fin,
            isset($_POST['activo']) ? 1 : 0,
            $personajes
        );

        if ($resultado === true) {
            echo json_encode(['success' => true]);
            exit();
        }

        http_response_code(500);
        echo json_encode(['error' => 'Error al modificar el banner']);
        exit();
    }

    public function cBorrarBanner() {
        $this->vista = null;
        header('Content-Type: application/json');

        if (empty($_POST['idBanner'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Faltan datos obligatorios']);
            exit();
        }

        $banner = $this->objbanners->mObtenerBanner($_POST['idBanner']);
        if (!$banner) {
            http_response_code(404);
            echo json_encode(['error' => 'Banner no encontrado']);
            exit();
        }

        $resultado = $this->objbanners->mBorrarBanner($_POST['idBanner']);
        if ($resultado === true) {
            echo json_encode(['success' => true]);
            exit();
        }

        http_response_code(500);
        echo json_encode(['error' => 'Error al borrar el banner']);
        exit();
    }
}
?>