<?php
  
  require_once "vendor/autoload.php"; 
  include("bd.php");  


  $loader = new \Twig\Loader\FilesystemLoader('plantillas');
  $twig = new \Twig\Environment($loader);

  session_start();
  $usuario = array();
  if (isset($_SESSION['user'])) {
      $usuario = getUsuario($_SESSION['user']);
      
  }
  
  $evento = array('nombre' => "ERROR404", 'contenido' => "No encontrado");
  $fotos = array();
  $etiquetas = array();
  $estilo = "css/estilos.css";
  
  if (isset($_GET['ev'])) {
    $idEv = $_GET['ev'];
    $mysqli = conectar();
    //Evento info
    $evento = getEvento($idEv, $mysqli);
    //Fotos
    $fotos = getFotosEvento($idEv, $mysqli);
    //Etiquetas
    $etiquetas = getEtiquetas($idEv);

    //Comentarios
    $comentarios = getComentariosEvento($idEv, $mysqli);
  } else {
    $idEv = -1;
  }

  if (isset($_GET['sty']) && $_GET['sty'] == 1) {
    $estilo = "css/estilo_imprimir.css";
  }
  
  echo $twig->render('evento.html', ['evento' => $evento, 'fotos' => $fotos, 'comentarios' => $comentarios, 'estilo' => $estilo, 'usuario' => $usuario, 'etiquetas' => $etiquetas]);
?>
