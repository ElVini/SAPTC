$(document).on("ready",inicio());
//console.log("ENTRO");

function inicio()
{
  $("#busqueda").keyup(function(){
      buscar = $("#busqueda").val();
      mostrarDatos(buscar);
  });
}

function mostrarDatos(valor){
  var base_url = $('#base_url').val();
  $.ajax({
    url: base_url+"index.php/User/mostrar",
    type:"POST",
    data:{buscar:valor},
    success:function(respuesta){
    //  alert (respuesta);
      var registros = eval(respuesta);

      html="<table class='table table-hover'><thead id='TablaCabeza'";
      html+="<tr><th hidden>ID</th><th>Nombre</th><th>Apellido paterno</th><th>Apellido materno</th><th>Carrera</th><th>Nivel academico</th><th>Ver</th></tr>";
      html+="</thead> <tbody>";
      var contador=1;
      for (var i = 0; i < registros.length; i++) {
        html+="<tr id='TablaLinea'><td hidden>"+registros[i]["idDatosprofesor"]+"</td><td>"+registros[i]["Nombres"]+"</td><td>"+registros[i]["Primerapellido"]+"</td><td>"+registros[i]["Segundoapellido"]+
        "</td><td>"+registros[i]["Disciplina"]+"</td><td>"+registros[i]["Nivelestudios"]+"</td><td><button class='btn btn-default' onclick='muestraInf("+registros[i]["idDatosprofesor"]+")'><span class='glyphicon glyphicon-eye-open'></span></button></td></tr>"
        contador++;
      }
      html+="</tbody></table>";
      $('#listaProfesores').html(html);
    }

  });
}
function muestraInf(id)
{ BootstrapDialog.show({
      size: BootstrapDialog.SIZE_WIDE,
      title: 'Información',
      message: $('<div></div>').load( base_url+'index.php/User/vistaProfe/'+id)
  });
}
