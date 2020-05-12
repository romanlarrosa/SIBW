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
    
    
    if( $usuario['tipo'] == "SUPER" or $usuario['tipo'] == "GESTOR" ){ //RESTRINGIR esta opcion solo a usuarios SUPER o GESTOR
        $idEv = -1;
        if (isset($_POST['idEv'])) { //Se elimina un evento existente
            $idEv = $_POST['idEv'];
            eliminarEvento($idEv);
        }
        
    }
    
    header("Location: configuracion.php?act=gestoreventos");

?>
