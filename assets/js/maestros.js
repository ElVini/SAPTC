$(document).on("ready",inicio());
console.log("ENTRO");

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

      html="<table class='table table-responsive'><thead class='thead-inverse'>";
      html+="<tr><th>#</th><th>NOMBRE DEL PROFESOR</th><th>APELLIDO PATERNO</th><th>APELLIDO MATERNO</th><th>CARRERA</th><th>NIVEL ACADEMICO</th></tr>";
      html+="</thead> <tbody>";
      var contador=1;
      for (var i = 0; i < registros.length; i++) {
        html+="<tr><td>"+contador+"</td><td>"+registros[i]["Nombres"]+"</td><td>"+registros[i]["Primerapellido"]+"</td><td>"+registros[i]["Segundoapellido"]+"</td><td>"+registros[i]["Disciplina"]+"</td><td>"+registros[i]["Nivelestudios"]+"</td></tr>"
        contador++;
      }
      html+="</tbody> </table>";
      $('#listaProfesores').html(html);
    }

  });
}
