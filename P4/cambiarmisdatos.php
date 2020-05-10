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

    
    $action = "misDatos";
    
    $nick = $_POST['nick'];
    $email = $_POST['email'];
    $nickAntiguo = $usuario['user'];

    
    #mirar si el usuario ya existe
    $u = getUsuario($nick);

    if(empty($u)){
        modificarUsuario($nickAntiguo, $nick, $email);
        $msg = "Datos actualizados con éxito";
        $usuario['user'] = $nick;
        $_SESSION['user'] = $nick;
    }
    else{
        $msg = "ERROR, nick ya existente";
    }

    

    echo $twig->render('configuracion.html', ['act' => $action, 'usuario' => $usuario, 'msg' => $msg ]);
    
    
?>
