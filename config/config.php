<?php
if ($_SERVER['SERVER_NAME'] === 'localhost') {
    define("SERVIDOR", "localhost");
    define("USUARIO", "root");
    define("PASSWORD", '');
    define("BBDD", "gestion_genshin");
} else {
    define("SERVIDOR", "sql201.infinityfree.com");
    define("USUARIO", "if0_42320678");
    define("PASSWORD", "fPp8S1gMSjN");
    define("BBDD", "if0_42320678_gestiongenshin");
}
#http://localhost/index.php?controlador=auth&accion=loginForm
#https://genshin-teambuilder.infinityfree.me/index.php?controlador=auth&accion=loginForm
