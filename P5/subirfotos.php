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


    

    if( $usuario['tipo'] == "SUPER" or $usuario['tipo'] == "GESTOR" ){ //RESTRINGIR esta opcion solo a usuarios SUPER o MOD
        $idEv = -1;
        if (isset($_GET['idEv'])) { //EDITAR UN EVENTO
            $idEv = $_GET['idEv'];
        }
        $archivos = $_FILES;
        subirFotos($_REQUEST, $idEv, $archivos);
        //else { //AÑADIR UN EVENTO

        //}
    }
    

    header("Location: gestorevento.php?idEv=".$idEv);


?>
