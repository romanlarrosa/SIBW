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
    $evento = getEvento($idEv, $mysqli);
    $fotos = getFotosEvento($idEv, $mysqli);
  } else {
    $idEv = -1;
  }

  if (isset($_GET['sty']) && $_GET['sty'] == 1) {
    $estilo = "css/estilo_imprimir.css";
  }



  
  
  //print("Algo estoy haciendo " . $evento['contenido']);
  echo $twig->render('evento.html', ['evento' => $evento, 'fotos' => $fotos, 'estilo' => $estilo, 'ev' => $idEv]);
?>
