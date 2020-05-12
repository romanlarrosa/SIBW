<?php
    require_once "vendor/autoload.php"; 
    include include("bd.php"); 
    
    $loader = new \Twig\Loader\FilesystemLoader('plantillas');
    $twig = new \Twig\Environment($loader);

    $action = "misDatos";
    
    if (isset($_GET['act'])){
        $action = $_GET['act'];
    }
    session_start();
    $usuario = array();
    if (isset($_SESSION['user'])) {
        $usuario = getUsuario($_SESSION['user']);
        
    }

    switch ($action) {
        case "permisos":
            $usuarios = getAllUsuarios();
            echo $twig->render('configuracion.html', ['act' => $action, 'usuario' => $usuario, 'users' => $usuarios]);
            break;

        case "comentarios":
            $eventos = getAllEventos();
            echo $twig->render('configuracion.html', ['act' => $action, 'usuario' => $usuario, 'eventos' => $eventos]);
            break;

        case "gestoreventos":
            $eventos = getAllEventos();
            echo $twig->render('configuracion.html', ['act' => $action, 'usuario' => $usuario, 'eventos' => $eventos]);
            break;

        default:
            echo $twig->render('configuracion.html', ['act' => $action, 'usuario' => $usuario]);
            break;
        
    }
    
    
?>
