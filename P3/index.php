<?php
    require_once "vendor/autoload.php"; 
    
    $loader = new \Twig\Loader\FilesystemLoader('plantillas');
    $twig = new \Twig\Environment($loader);

    echo $twig->render('portada.html', []);
    
    
?>
