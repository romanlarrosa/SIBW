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
        $publicados = false;
        if( isset($_GET["search"]) ){
            $query = $_GET["search"];
            $eventos = buscarEventos($query, $publicados);
        }
        else{
           $eventos = getAllEventos($publicados); 
        }
        


    }
    else {
        $publicados = true;
        if( isset($_GET["search"]) ){
            $query = $_GET["search"];
            $eventos = buscarEventos($query, $publicados);
        }
        else{
           $eventos = getAllEventos($publicados); 
        }
    }

    
    

    echo $twig->render('portada.html', ['eventos' => $eventos, 'usuario' => $usuario]);
    
?>
