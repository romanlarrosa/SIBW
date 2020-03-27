<?php
  
  require_once "vendor/autoload.php"; 
  include("bd.php");  


  $loader = new \Twig\Loader\FilesystemLoader('plantillas');
  $twig = new \Twig\Environment($loader);
  
  $evento = array('nombre' => "ERROR404", 'contenido' => "No encontrado");
  $fotos = array();
  $estilo = "css/estilos.css";
  
  if (isset($_GET['ev'])) {
    $idEv = $_GET['ev'];
    $mysqli = conectar();
    //Info evento
    $evento = getEvento($idEv, $mysqli);
    //Fotos
    $fotos = getFotosEvento($idEv, $mysqli);

    //Añade el comentario
    addComentario($idEv, $_REQUEST, $mysqli);

    //Comentarios
    $comentarios = getComentariosEvento($idEv, $mysqli);
    $openC = true; 

  } else {
    $idEv = -1;
  }

  
  echo $twig->render('evento.html', ['evento' => $evento, 'fotos' => $fotos, 'comentarios' => $comentarios, 'estilo' => $estilo]);
?>
