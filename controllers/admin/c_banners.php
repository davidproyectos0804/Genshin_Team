<?php
class C_banners {
    private $objbanners;
    public $vista;
    public $error;

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
        $this->vista = 'banners';
        if (
            !isset($_POST['idVersion']) ||
            !isset($_POST['numero_banner']) ||
            empty($_POST['fecha_inicio']) ||
            empty($_POST['fecha_fin']) ||
            !isset($_POST['personajes']) ||
            count($_POST['personajes']) !== 5
        ) {
            header("Location: ./index.php?controlador=banners&accion=cMostrarBanners&error=" . urlencode("Faltan datos obligatorios"));
            exit();
        }

        // comprobar q no haya personajes duplicados
        $personajes = $_POST['personajes'];
        if (count($personajes) !== count(array_unique($personajes))) {
            header("Location: ./index.php?controlador=banners&accion=cMostrarBanners&error=" . urlencode("No puedes repetir personajes en el mismo banner"));
            exit();
        }

        $idVersion     = $_POST['idVersion'];
        $numero_banner = $_POST['numero_banner'];
        $fecha_inicio  = $_POST['fecha_inicio'];
        $fecha_fin     = $_POST['fecha_fin'];
        $activo        = isset($_POST['activo']) ? 1 : 0;

        // comprobar q fecha fin no sea antes q fecha inicio
        if ($fecha_fin < $fecha_inicio) {
            header("Location: ./index.php?controlador=banners&accion=cMostrarBanners&error=" . urlencode("La fecha de fin no puede ser anterior a la de inicio"));
            exit();
        }

        $resultado = $this->objbanners->mAnadirBanner($idVersion, $numero_banner, $fecha_inicio, $fecha_fin, $activo, $personajes);

        if ($resultado === true) {
            header("Location: ./index.php?controlador=banners&accion=cMostrarBanners");
            exit();
        }

        header("Location: ./index.php?controlador=banners&accion=cMostrarBanners&error=" . urlencode("Error al añadir el banner, puede que ya exista ese banner para esa versión"));
        exit();
    }

    public function cModificarBanner() {
        $this->vista = 'banners';

        if (
            !isset($_POST['idBanner']) ||
            !isset($_POST['idVersion']) ||
            !isset($_POST['numero_banner']) ||
            empty($_POST['fecha_inicio']) ||
            empty($_POST['fecha_fin']) ||
            !isset($_POST['personajes']) ||
            count($_POST['personajes']) !== 5
        ) {
            header("Location: ./index.php?controlador=banners&accion=cMostrarBanners&error=" . urlencode("Faltan datos obligatorios"));
            exit();
        }

        $personajes = $_POST['personajes'];
        if (count($personajes) !== count(array_unique($personajes))) {
            header("Location: ./index.php?controlador=banners&accion=cMostrarBanners&error=" . urlencode("No puedes repetir personajes en el mismo banner"));
            exit();
        }

        $idbanner      = $_POST['idBanner'];
        $idVersion     = $_POST['idVersion'];
        $numero_banner = $_POST['numero_banner'];
        $fecha_inicio  = $_POST['fecha_inicio'];
        $fecha_fin     = $_POST['fecha_fin'];
        $activo        = isset($_POST['activo']) ? 1 : 0;

        if ($fecha_fin < $fecha_inicio) {
            header("Location: ./index.php?controlador=banners&accion=cMostrarBanners&error=" . urlencode("La fecha de fin no puede ser anterior a la de inicio"));
            exit();
        }

        $banner = $this->objbanners->mObtenerBanner($idbanner);
        if (!$banner) {
            header("Location: ./index.php?controlador=banners&accion=cMostrarBanners&error=" . urlencode("Banner no encontrado"));
            exit();
        }

        $resultado = $this->objbanners->mEditarBanner($idbanner, $idVersion, $numero_banner, $fecha_inicio, $fecha_fin, $activo, $personajes);

        if ($resultado === true) {
            header("Location: ./index.php?controlador=banners&accion=cMostrarBanners");
            exit();
        }

        header("Location: ./index.php?controlador=banners&accion=cMostrarBanners&error=" . urlencode("Error al modificar el banner"));
        exit();
    }

    public function cBorrarBanner() {
        $this->vista = 'banners';
        if (!isset($_GET['id'])) {
            header("Location: ./index.php?controlador=banners&accion=cMostrarBanners&error=" . urlencode("Faltan datos obligatorios"));
            exit();
        }

        $idbanner = $_GET['id'];
        $banner = $this->objbanners->mObtenerBanner($idbanner);
        if (!$banner) {
            header("Location: ./index.php?controlador=banners&accion=cMostrarBanners&error=" . urlencode("Banner no encontrado"));
            exit();
        }

        $resultado = $this->objbanners->mBorrarBanner($idbanner);
        if ($resultado === true) {
            header("Location: ./index.php?controlador=banners&accion=cMostrarBanners");
            exit();
        }

        header("Location: ./index.php?controlador=banners&accion=cMostrarBanners&error=" . urlencode("Error al borrar el banner"));
        exit();
    }
}
?>