var error;
var date;
var title
var description;
var submit;
var bandera = false;
$(document).ready(function()
{
  $("#add").click(function()
  {
      $("#divPrueba").show("slow");
      window.scrollTo(0,document.body.scrollHeight);
      $(".DivELetrasrojas").hide();
  });
  $("#send").click(function(event)
  {
    $(this).prop('disabled', true);
  	event.preventDefault();
    error = document.getElementById('error');
    id = document.getElementById('id');
    date = document.getElementById('fecha');
    title = document.getElementById('titulo');
    description = document.getElementById('descripcion');
    submit = document.getElementById('#send');
  	if (date.value != "" && title.value != "" && description.value != "") {
         var formulario = document.getElementById('formulario');
  		if(bandera==true)
      {
          var id = $(".highlight ").children('td:nth-child(1)').first().html();
          var send_id = document.getElementById('idrecordatorios');
           send_id.setAttribute('value', id);
           formulario.appendChild(send_id);
           formulario.setAttribute('action', 'index.php?a=e');
           formulario.submit();
           bandera=true;
      }
      else
      {
          formulario.setAttribute('action', 'index.php?a=aa');
          formulario.submit();
          bandera=false;
      }
  	}
  	else {
  		error.innerHTML = 'Uno o más elementos están vacíos';
       $(this).removeAttr('disabled');
  	}
  });

  $("#cancel").click(function()
  {
      event.preventDefault();
      $("#divPrueba").hide("slow");
      $("#formulario")[0].reset();
  });
  $('#tabla').on('click', 'tbody tr', function(event) {


    $(this).addClass('highlight').siblings().removeClass('highlight');

    $(".DivELetrasrojas").hide('slow');
  });

  /*--------------------------DELETE BUTTON (NO JQUERY HERE)-----------------------*/
  var btnElim = document.getElementById('delete');
  btnElim.addEventListener('click', function(event) {
  event.preventDefault();
  var seleccionado = $(".highlight ").children('td').first().html();
  console.log(seleccionado);
  if(seleccionado != undefined){
    if(confirm('El elemento seleccionado será elminado. Esta acción no se puede deshacer, ¿Desea continuar?') == true) {
     var formulario = document.getElementById('formu');
     formulario.setAttribute('action', 'index.php?a=d');
     formulario.setAttribute('method', 'post');
     var idAborrar = document.createElement('input');
     idAborrar.setAttribute('type', 'text');
     idAborrar.setAttribute('name', 'idAborrar');
     idAborrar.setAttribute('value', seleccionado);
     formulario.appendChild(idAborrar);
     formulario.submit();
   }
 }
 else{
   $(".DivELetrasrojas").show('slow');
 }
});
/*--------------------------EDIT BUTTON-----------------------*/
  var btnEdit = document.getElementById('edit');
  btnEdit.addEventListener('click', function(event) {
  event.preventDefault();
  bandera=true;
  var id = $(".highlight ").children('td:nth-child(1)').first().html();
  if(id != undefined){
    document.getElementById('fecha').value = $(".highlight").children('td:nth-child(2)').first().html();
    document.getElementById('titulo').value = $(".highlight").children('td:nth-child(4)').first().html();
    document.getElementById('descripcion').value = $(".highlight").children('td:nth-child(5)').first().html();
    document.getElementById('#send');
    $("#divPrueba").show("slow");
  }
  else
  {
    $(".DivELetrasrojas").show('slow');
  }
  });
});
