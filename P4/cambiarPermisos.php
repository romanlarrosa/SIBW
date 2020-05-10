<?php
    require_once "vendor/autoload.php"; 
    include include("bd.php"); 
    
    $loader = new \Twig\Loader\FilesystemLoader('plantillas');
    $twig = new \Twig\Environment($loader);

    session_start();
    $usuario = array();
    if (isset($_SESSION['user'])) {
        $usuario = getUsuario($_SESSION['user']);
        
    }
    
    if( $usuario['tipo'] == "SUPER" ){ //RESTRINGIR esta opcion solo a usuarios SUPER
        $id = $_GET['id'];
        $tipo = $_POST['permiso'];
        cambiarPermisos($id, $tipo);
    }
    

    header("Location: configuracion.php?act=permisos");


?>
