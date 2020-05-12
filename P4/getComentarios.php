<?php
    
    include include("bd.php"); 
    header("Access-Control-Allow-Origin: *");

    $idEv = -1;
    
    if( isset($_GET['idEv']) ){
        $idEv = $_GET['idEv'];
    }

    $mysqli = conectar();
    $comentarios = getComentariosEvento($idEv, $mysqli);


    echo json_encode($comentarios);
    # echo var_dump($palabras);
    
    
?>