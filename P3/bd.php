<?php
  function getEvento($idEv, $mysqli) {

    $res = $mysqli->query("SELECT * FROM EVENTO WHERE evento=" . $idEv);
    
    $evento = array('nombre' => 'XXX', 'contenido' => 'YYY');
    
    if ($res->num_rows > 0) {
      $row = $res->fetch_assoc();
      //print("Nombre: " . $row['nombre']);
      $evento = array('nombre' => $row['nombre'], 'contenido' => $row['contenido']);
    }
    
    return $evento;
  }
  function getFotosEvento($idEv, $mysqli) {
    $resultado = $mysqli->query("SELECT * FROM FOTO WHERE evento=" . $idEv);
    $fotos = array();

    while($res = $resultado->fetch_assoc()) {
      $fotos[] = $res;
    }
    return $fotos;
  }

  function getAllEventos() {
    $mysqli = conectar();
    //Realizamos la consulta para ver cuantos eventos hay
    $resultado = $mysqli->query("SELECT * FROM EVENTO");
    return $resultado;
  }

  function conectar() {
    $mysqli = new mysqli("localhost", "web", "web", "SIBW");
    if ($mysqli->connect_errno) {
      echo ("Fallo al conectar: " . $mysqli->connect_error);
    }
    return $mysqli;
  }
?>
