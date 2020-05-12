<?php
    
    include include("bd.php"); 
    header("Access-Control-Allow-Origin: *");

    session_start();

    $usuario = array();
    if (isset($_SESSION['user'])) {
        $usuario = getUsuario($_SESSION['user']);
        
    }

    if( $usuario['tipo'] == "SUPER" or $usuario['tipo'] == "GESTOR" ){ //RESTRINGIR esta opcion solo a usuarios SUPER o MOD
        $idEv = -1;
        
        if( isset($_GET['idEv']) ){
            $idEv = $_GET['idEv'];
        }

        $mysqli = conectar();
        $comentarios = getComentariosEvento($idEv, $mysqli);


        echo json_encode($comentarios);
    }

    
    # echo var_dump($palabras);
    
    
?>