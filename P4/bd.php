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
      $stmt = $mysqli->prepare("SELECT user FROM USUARIO where id=?");
      $stmt->bind_param("i", $res['user_id']);
      $stmt->execute();
      $usuario = $stmt->get_result();
      while($u = $usuario->fetch_assoc()){
        $res['user'] = $u['user'];
      }
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

  function getAllUsuarios() {
    $mysqli = conectar();
    //Realizamos la consulta para ver cuantos eventos hay
    $resultado = $mysqli->query("SELECT * FROM USUARIO");

    $usuarios = array();


    while($res = $resultado->fetch_assoc()) {
        $usuarios[] = $res;
    }
    return $usuarios;
  }

  function addComentario($idEv, $text, $mysqli, $user) {
    //Ponemos las variables del usuario de forma segura
    $user_msg  = mysqli_real_escape_string($mysqli, $text);
    if( !is_numeric($idEv)){
      $idEv = -1;
    }
    $fecha = date("Y-m-d H:i:s");

    //Ejecutamos la peticion de inserción
    $sql = "INSERT INTO COMENTARIO (contenido, fecha, user_id, evento) VALUES ('$user_msg', '$fecha', '$user', $idEv)";
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

  function getUsuario($user) {
    $mysqli = conectar();
    $stmt = $mysqli->prepare("SELECT * from USUARIO where user=?");
    $stmt->bind_param("s", $user);
    $stmt->execute();

    $resultado = $stmt->get_result();

    while($res = $resultado->fetch_assoc()) {
      $usuario = $res;
    }
    return $usuario;
  }

  function checkLogin($user, $pass){
    $usuario = getUsuario($user);
      if (password_verify($pass, $usuario['pass'])){
        return true;
      }
      return false;
  }


  function addUsuario($nick, $pass, $email) {
    $mysqli = conectar();
    //Ponemos las variables del usuario de forma segura
    $user = mysqli_real_escape_string($mysqli, $nick);
    $pass = password_hash($pass, PASSWORD_DEFAULT);
    $mail  = mysqli_real_escape_string($mysqli, $email);
    

    //Ejecutamos la peticion de inserción
    $sql = "INSERT INTO USUARIO (user, pass, email, tipo) VALUES ('$user', '$pass', '$mail', 'USER')";
    $mysqli->query($sql);
  }

  function modificarUsuario($nickAntiguo, $nick, $email) {
    $mysqli = conectar();
    //Ponemos las variables del usuario de forma segura
    $nickAntiguo = mysqli_real_escape_string($mysqli, $nickAntiguo);
    $email  = mysqli_real_escape_string($mysqli, $email);
    $nick  = mysqli_real_escape_string($mysqli, $nick);
    

    //Ejecutamos la peticion de inserción
    $sql = "UPDATE USUARIO SET user = '$nick', email='$email' WHERE user = '$nickAntiguo'";
    $mysqli->query($sql);
  }

  function cambiarPermisos($id, $permiso) {
    $mysqli = conectar();

    $sql = "UPDATE USUARIO SET tipo = '$permiso' WHERE id = '$id'";
    $mysqli->query($sql);
  }

  function eliminarComentario($id) {
    $mysqli = conectar();
    if( !is_numeric($id)){
      $id = -1;
      
    }
    
    $sql = "DELETE FROM COMENTARIO WHERE comentario='$id'";
    $mysqli->query($sql);
  }

  function editarComentario($id, $msg) {
    $mysqli = conectar();
    $msg_  = mysqli_real_escape_string($mysqli, $msg);
    if( !is_numeric($id)){
      $id = -1;
      
    }
    
    $sql = "UPDATE COMENTARIO SET contenido='$msg_', editado=true WHERE comentario='$id'";
    $mysqli->query($sql);
  }

  
?>
