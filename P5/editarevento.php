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
            if (($key = array_search("", $etiquetas)) !== false) {
                unset($etiquetas[$key]);
            }
        }
        
        $publicar = "";
        if(isset($_POST['publish'])){
            
            $publish = $_POST['publish'];
            if($publish == "Publicar"){
                $publicar = true;
            }
            elseif ($publish == "Guardar"){
                $publicar = true;
            } 
            else {
                $publicar = false;
            }
            
            
        }
        echo $publicar;
        
        

        if (isset($_POST['idEv'])) { //Se edita un evento existente
            $idEv = $_POST['idEv'];

            //echo $idEv . $etiquetas . $publicar;
            
            editarEvento($idEv, $etiquetas, $publicar);

        }
        else { //Se añade un evento nuevo

            //echo $idEv . $etiquetas . $publicar;
            $idEv = addEvento($etiquetas, $publicar);
        }

        header("Location: gestorevento.php?idEv=".$idEv);

    }

    header("Location: index.php");

    

?>
