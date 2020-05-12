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

    if( $usuario['tipo'] == "SUPER" or $usuario['tipo'] == "GESTOR" ){ //RESTRINGIR esta opcion solo a usuarios SUPER o GESTOR
        $idEv = -1;
        if (isset($_GET['idEv'])) { //Editar un evento
            $idEv = $_GET['idEv'];
            $mysqli = conectar();
            //Evento
            $evento = getEvento($idEv, $mysqli);
            //Fotos
            $fotos = getFotosEvento($idEv, $mysqli);
            $action = "editar";
            //Etiquetas
            $etiquetas = getEtiquetas($idEv);

            echo $twig->render('gestorevento.html', ['act' => $action, 'usuario' => $usuario, 'evento' => $evento, 'fotos' => $fotos, 'etiquetas' => $etiquetas ]);
        }
        else { //Crear un nuevo evento

            echo $twig->render('gestorevento.html', ['act' => $action, 'usuario' => $usuario]);
        }

        echo "Esta funcionando " . $idEv;
    }
    

    //header("Location: evento.php?ev=".$idEv);


?>
