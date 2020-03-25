<?php
    require_once "vendor/autoload.php"; 
    include include("bd.php"); 
    
    $loader = new \Twig\Loader\FilesystemLoader('plantillas');
    $twig = new \Twig\Environment($loader);

    
    $resultado = getAllEventos();
    $eventos = array();


    while($res = $resultado->fetch_assoc()) {
        $eventos[] = $res;
    }


    echo $twig->render('portada.html', ['eventos' => $eventos]);
    
    
?>
