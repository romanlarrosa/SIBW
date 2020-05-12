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
    
    $idEv = -1;
    if( $usuario['tipo'] == "SUPER" or $usuario['tipo'] == "GESTOR" ){ //RESTRINGIR esta opcion solo a usuarios SUPER o MOD
        $idEv = $_GET['idEv'];
        $id = $_GET['id'];

        eliminarFoto($id);
    }
    

    header("Location: gestorevento.php?idEv=".$idEv);


?>
