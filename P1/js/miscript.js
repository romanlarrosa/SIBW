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
  var nombre = document.getElementById('name');
  var mail = document.getElementById('mail');
  var comentario = document.getElementById('msg');

  if (vacio(nombre) || vacio(mail) || vacio(comentario)){
    alert("Hay algun campo obligatorio vacio");
    return false;
  }

  if (emailValido(mail)){
    alert("E-mail no valido");
    return false;
  }

  var fecha = (new Date()).toLocaleString('es-ES',{timeZone:'Europe/Madrid'});
  var lista = document.getElementsByClassName('lista_comentarios');

  lista[0].insertAdjacentHTML('beforeend', "\n" +
    "<div class=\"comentario\">\n" +
    "                    <h4>\n" +
    "                        "+name.value+":\n"+
    "                    </h4>\n" +
    "                    <p class=\"texto_comentario\">\n" +
    "                        "+comentario.value+"\n" +
    "                    </p>\n" +
    "                    <p class=\"fecha_comentario\">\n" +
    "                        "+date+"\n"+
    "                    </p>" +
    "               </div>");

  return false;
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
  return re.test(String(email.value).toLowerCase());
}