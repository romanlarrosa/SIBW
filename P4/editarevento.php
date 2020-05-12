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
        if(isset($_POST['etiquetas'])){
            $etiquetas = $_POST['etiquetas'];
            if($etiquetas != ""){
               $etiquetas = explode(', ', $etiquetas); 
            }
            else{
                $etiquetas = array();
            }  
        }

        if (isset($_GET['idEv'])) { //Se edita un evento existente
            $idEv = $_GET['idEv'];
            
            editarEvento($idEv, $etiquetas);

        }
        else { //Se añade un evento nuevo
            $idEv = addEvento($etiquetas);
        }
    }
    
    header("Location: gestorevento.php?idEv=".$idEv);

?>
