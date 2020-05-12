<?php
    
    include include("bd.php"); 
    header("Access-Control-Allow-Origin: *");

    session_start();

    $usuario = array();
    if (isset($_SESSION['user'])) {
        $usuario = getUsuario($_SESSION['user']);
        
    }

    if( $usuario['tipo'] == "SUPER" or $usuario['tipo'] == "GESTOR" ){ //RESTRINGIR 
        //Eventos publicados y no publicados
        $publicados = false;
    }
    else {
        //Solo eventos publicados
        $publicados = true;
    }

    $eventos = array();
    if( isset($_POST["query"]) ){
        $query = $_POST["query"];
        $eventos = buscarEventos($query, $publicados);
    }

    echo json_encode($eventos);
    # echo var_dump($palabras);
    
    
?>