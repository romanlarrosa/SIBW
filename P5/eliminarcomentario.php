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
    if (isset($_GET['ev'])) {
        $idEv = $_GET['ev'];
    }

    if( $usuario['tipo'] == "SUPER" or $usuario['tipo'] == "MOD" ){ //RESTRINGIR esta opcion solo a usuarios SUPER o MOD
        $id = $_GET['id'];
        eliminarComentario($id);
    }
    

    header("Location: evento.php?ev=".$idEv);


?>
