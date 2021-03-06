//Abrir la barra de comentarios poniendo la anchura al 35%
function openNav() {
    document.getElementById("mySidenav").style.width = "35%";
  }
  
//Cerrar la barra de comentarios poniendo la anchura a 0
  function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
  }

//Abrir la barra de busqueda
  function openSearch() {
    document.getElementById("myOverlay").style.display = "block";
  }

//Cerrar la barra de busqueda
  function closeSearch() {
    document.getElementById("myOverlay").style.display = "none";
  }

  function alerta(){
    alert("ESTO ES UNA ALERTA")
  }

  function openEditar(id) {
    var nombre = "editar_comentario" + id;
    console.log(nombre);
    
    if(document.getElementById(nombre).style.display != "inline"){
      document.getElementById(nombre).style.display = "inline";
    }
    else{
      document.getElementById(nombre).style.display = "none";
    }
    
  } 



//Añadir comentario a la lista de comentarios
function addComentario(event){
  event.preventDefault();
  var nombre = document.getElementById('name');
  var mail = document.getElementById('mail');
  var comentario = document.getElementById('msg');

  if (nombre.value.length==0 || mail.value.length==0 || comentario.value.length==0){
    alert("Hay algun campo obligatorio vacio");
    return false;
  }
  
  if (!emailValido(mail)){
    alert("Email no valido");
    return false;
  }
  
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
var palabras_cen = [];

function censurar(event) {
  //Comprobar cada palabra (cada vez que se pulsa el espacio)
  var tecla  = String.fromCharCode(event.keyCode).toLowerCase();
  var re = /[a-zA-Z]/;
  var mensaje = document.getElementById("msg");

  if(re.test(tecla) && tecla != " "){
    palabraAux += tecla;
  }
  else{
    if(tecla === " " || tecla === "."){
      compruebaCensura(palabraAux);
      palabraAux = "";
    }
  }

  index = mensaje.value.length;
}

function compruebaCensura(palabra) {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      palabras_cen = JSON.parse(this.responseText);
    }
    var i;
      //alert("Aqui estoy llegando");
      for(i = 0; i< palabras_cen.length; i++){
        if(palabra === palabras_cen[i]){
          censura(palabra);
        }
      }
  };
  
  xmlhttp.open("GET", "getPalabras.php", true);
  xmlhttp.send();

  
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


function buscar(event){
  var barra = document.getElementById("barra_busqueda");
  var search = $(barra).val();
  console.log("Estoy buscando: " + search);

  buscarEventos(search);
}

function buscarEventos(query) {
  $.ajax({
    url:"busqueda.php",
    method:"POST",
    data:{query:query},
    success:function(data)
    {
      cargarEventos(data);
    }
  });
}

function cargarEventos(data) {
  const result = JSON.parse(data);

  //console.log("Tamaño: " + result.length);
  //Añadir cada resultado
  var divHTML = document.getElementById("overlay-content");
  divHTML.innerHTML = "";
  for (var i =0; i < result.length; i++){
    var code = "\n" +
    "<a href=\"evento.php?ev=" + result[i]["evento"] + "\">" + result[i]["nombre"] + "</a>";

    divHTML.innerHTML += code;
  }
        
}