<?php
class C_banners {
    public $vista;

    public function __construct() {
        require_once("models/m_banners.php");
        $this->objbanners = new M_banners();
    }

    public function cMostrarBanners() {
        $this->vista = 'banners';
        $banners = $this->objbanners->mMostrarBanners();
        return [$banners];
    }
}
?>