<?php
    require_once "vendor/autoload.php"; 
    
    $loader = new \Twig\Loader\FilesystemLoader('plantillas');
    $twig = new \Twig\Environment($loader);

    
    
    $mysqli = new mysqli("localhost", "web", "web", "SIBW");
    if ($mysqli->connect_errno) {
        print ("FALLO AL CONECTAR: " . $mysqli->connect_error);
    }
    

    echo $twig->render('portada.html', []);
    
    
?>
