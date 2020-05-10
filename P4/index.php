<?php
    require_once "vendor/autoload.php"; 
    include include("bd.php"); 
    
    $loader = new \Twig\Loader\FilesystemLoader('plantillas');
    $twig = new \Twig\Environment($loader);


    $eventos = getAllEventos();
    session_start();

    $usuario = array();
    if (isset($_SESSION['user'])) {
        $usuario = getUsuario($_SESSION['user']);
        
    }
    echo $twig->render('portada.html', ['eventos' => $eventos, 'usuario' => $usuario]);
    
?>
