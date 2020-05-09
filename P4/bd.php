<?php
  function getEvento($idEv, $mysqli) {

    //Impedir inyeccion de codigo
    $stmt = $mysqli->prepare("SELECT * FROM EVENTO WHERE evento=?");
    $stmt->bind_param("i", $idEv);
    $stmt->execute();

    $res = $stmt->get_result();
    $evento = array('nombre' => 'ERROR 404', 'contenido' => 'Contenido no encontrado');
    
    if ($res->num_rows > 0) {
      $row = $res->fetch_assoc();
      $evento = array('nombre' => $row['nombre'], 'contenido' => $row['contenido'], 'evento' => $row['evento']);
    }
    
    return $evento;
  }

  function getFotosEvento($idEv, $mysqli) {
    $stmt = $mysqli->prepare("SELECT * FROM FOTO WHERE evento=?");
    $stmt->bind_param("i", $idEv);
    $stmt->execute();

    $resultado = $stmt->get_result();
    $fotos = array();

    while($res = $resultado->fetch_assoc()) {
      $fotos[] = $res;
    }
    return $fotos;
  }

  function getComentariosEvento($idEv, $mysqli) {
    $stmt = $mysqli->prepare("SELECT * FROM COMENTARIO WHERE evento=?");
    $stmt->bind_param("i", $idEv);
    $stmt->execute();

    $resultado = $stmt->get_result();
    $comentarios = array();

    while($res = $resultado->fetch_assoc()) {
      $comentarios[] = $res;
    }
    return $comentarios;
  }

  function getAllEventos() {
    $mysqli = conectar();
    //Realizamos la consulta para ver cuantos eventos hay
    $resultado = $mysqli->query("SELECT * FROM EVENTO");

    $eventos = array();


    while($res = $resultado->fetch_assoc()) {
        $eventos[] = $res;
    }
    return $eventos;
  }

  function addComentario($idEv, $peticion, $mysqli) {
    //Ponemos las variables del usuario de forma segura
    $user_name = mysqli_real_escape_string($mysqli, $peticion['name']);
    $user_mail = mysqli_real_escape_string($mysqli, $peticion['mail']);
    $user_msg  = mysqli_real_escape_string($mysqli, $peticion['msg']);
    if( !is_numeric($idEv)){
      $idEv = -1;
    }
    $fecha = date("Y-m-d H:i:s");

    //Ejecutamos la peticion de inserción
    $sql = "INSERT INTO COMENTARIO (contenido, fecha, user, mail, evento) VALUES ('$user_msg', '$fecha', '$user_name', '$user_mail', $idEv)";
    $mysqli->query($sql);
  }

  function conectar() {
    $mysqli = new mysqli("localhost", "web", "web", "SIBW");
    if ($mysqli->connect_errno) {
      echo ("Fallo al conectar: " . $mysqli->connect_error);
    }
    return $mysqli;
  }

  function getPalabras() {
    $mysqli = conectar();
    $sql = "SELECT palabra FROM CENSURA";

    $resultado = $mysqli->query($sql);
    $palabras = array();

    while($res = $resultado->fetch_assoc()) {
      $palabras[] = $res['palabra'];
    }

    return $palabras;
  }
?>
