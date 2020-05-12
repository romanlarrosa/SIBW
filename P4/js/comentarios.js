document.getElementById('selector_evento_comentarios').addEventListener('change', function() {
  
  cargarComentarios(this.value);
});

function cargarComentarios(idEv){
  //Conseguir los comentarios del evento
  var comentarios;
  var url = 'http://85.136.47.127/P4/getComentarios.php?idEv=' + idEv;
  $.get(url)
    .done((data) => {
        const result = JSON.parse(data);
        //Para cada comentario
        console.log(result.length);

        var lista = document.getElementById('contenedor_comentarios');
        lista.innerHTML = "";
        for (var i = 0; i < result.length; i++) {
          const element = result[i];
          var evento = element["evento"];
          var id = element["comentario"];
          var usuario = element["user"];
          var contenido = element["contenido"];
          console.log(contenido);
          var fecha = element["fecha"];
          var editado = "";
          if (element["editado"] == 1 )
            var editado = "Editado por moderador";

          
          lista.insertAdjacentHTML('beforeend', "\n" +
          "<div class=\"conf_comentario\">" +
          "    <a href=\"eliminarcomentario.php?id="+id+"&ev="+evento+"\">&times;</a>" + 
          "    <h4>"+usuario+"</h4>" +
          "    <form action=\"editarcomentario.php?id="+id+"&ev="+evento+"\" method=\"POST\">" +
          "        <textarea name=\"msg_edit\" placeholder=\"Edita el comentario...\" required>"+ contenido +"</textarea>" +
          "        <input type=\"submit\" value=\"EDITAR\"></input>" +
          "    </form>" +
          "    <p>"+ editado +"</p>" +
          "    <p>"+ fecha +"</p>" +
          "</div>"
          );


          /*
          <div class="conf_comentario">
        
        <a class="" href="eliminarcomentario.php?id=&ev=">&times;</a>
        <h4>
            USER
        </h4>
            <form action="editarcomentario.php?id=&ev=" method="POST">
                <textarea id="" name="" placeholder="Edita el comentario..." required>contenido</textarea>
                <input type="submit" value="EDITAR"></input>
            </form>
        <p class="">
            Editado por mod.
        </p>
        <p class="">
            fecha
        </p>
    </div>
         */ 
        }
    });
}