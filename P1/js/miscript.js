//Abrir la barra de comentarios poniendo la anchura al 35%
function openNav() {
    document.getElementById("mySidenav").style.width = "35%";
  }
  
//Cerrar la barra de comentarios poniendo la anchura a 0
  function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
  } 

//Añadir comentario a la lista de comentarios
function addComentario(event){
  event.preventDefault();
  var nombre = document.getElementById('name');
  var mail = document.getElementById('mail');
  var comentario = document.getElementById('msg');

  if (nombre.value.length==0 || mail.value.length==0 || comentario.value.length==0){
    alert("Hay algun campo obligatorio vacio");
    return false
  }
  
  if (!emailValido(mail)){
    alert("Email no valido");
    return false;
  }

  //Una vez que comprobamos que estan todos los campos y que el email es correcto, procedemos a insertar el comentario
}

function vacio(campo) {
  var vacio = false;
  if(campo.value.trim() == "" || value === null || value === undefined) {
    vacio = true;
  }
  return vacio;
}

function emailValido(mail) {
  var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(String(mail.value).toLowerCase());
}