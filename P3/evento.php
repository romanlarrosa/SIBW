<?php
  
  require_once "vendor/autoload.php"; 
  include("bd.php");  


  $loader = new \Twig\Loader\FilesystemLoader('plantillas');
  $twig = new \Twig\Environment($loader);
  
  $evento = array('nombre' => "ERROR404", 'contenido' => "No encontrado");
  
  if (isset($_GET['ev'])) {
    $idEv = $_GET['ev'];
  } else {
    $idEv = -1;
  }

  $mysqli = conectar();
  $evento = getEvento($idEv, $mysqli);
  $fotos = getFotosEvento($idEv, $mysqli);
  
  //print("Algo estoy haciendo " . $evento['contenido']);
  echo $twig->render('evento.html', ['evento' => $evento, 'fotos' => $fotos]);
?>
