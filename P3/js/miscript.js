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
  var fecha = (new Date()).toLocaleString('es-ES',{timeZone:'Europe/Madrid'});
  var lista = document.getElementsByClassName('lista_comentarios');

  lista[0].insertAdjacentHTML('beforeend', "\n" +
    "<div class=\"comentario\">\n" +
    "                    <h4>\n" +
    "                        "+nombre.value+":\n"+
    "                    </h4>\n" +
    "                    <p class=\"texto_comentario\">\n" +
    "                        "+comentario.value+"\n" +
    "                    </p>\n" +
    "                    <p class=\"fecha_comentario\">\n" +
    "                        "+fecha+"\n"+
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
  return re.test(String(mail.value).toLowerCase());
}

palabraAux = "";
index = 0;
var palabras_censuradas = [
    "estafa",
    "marina",
    "prueba",
    "censura",
    "pago",
    "deiit",
    "delegacion"
];

function censurar(event) {
  //Comprobar cada palabra (cada vez que se pulsa el espacio)
  var tecla  = String.fromCharCode(event.keyCode).toLowerCase();
  var re = /[a-zA-Z]/;
  var mensaje = document.getElementById("msg");

  if(re.test(tecla)){
    palabraAux += tecla;
  }
  else{
    if(tecla === " " || tecla === "."){
      compruebaCensura(palabraAux);
      palabraAux = "";
    }
    if(event.keyCode === 8){
      palabraAux = palabraAux.substring(0, palabraAux.length - 1);
    }
  }

  index = mensaje.value.length;
}

function compruebaCensura(palabra) {
  var i;
  for(i = 0; i< palabras_censuradas.length; i++){
    if(palabra === palabras_censuradas[i]){
      censura(palabra);
    }
  }
}

function censura(palabra){
  var mensaje = document.getElementById("msg");
  var aux = "";

  for(var i = 0; i < palabra.length; i++){
    aux += "*";
  }

  //alert("Subcadena: " + mensaje.value.substring(0, index - palabra.length));
  var nuevomsj = mensaje.value.substring(0, index - palabra.length) + aux + " ";

  mensaje.value = nuevomsj;
}