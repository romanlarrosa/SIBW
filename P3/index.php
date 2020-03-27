<?php
    require_once "vendor/autoload.php"; 
    include include("bd.php"); 
    
    $loader = new \Twig\Loader\FilesystemLoader('plantillas');
    $twig = new \Twig\Environment($loader);

    
    $eventos = getAllEventos();


    echo $twig->render('portada.html', ['eventos' => $eventos]);
    
    
?>
