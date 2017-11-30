var error;
var date;
var title
var description;
var submit;
var bandera = false;
$(document).ready(function()
{
  $('#add').click(function(){
	desplegarDialogo('','','');
  });

  function desplegarDialogo(fecha,titulo,descripcion){
	  BootstrapDialog.show({
		  size: BootstrapDialog.SIZE_NORMAL,
		  title: 'Nuevo recordatorio',
		  cssClass: 'dialog',
		  message: `<div id="divPrueba">
		  	        <form id="formulario" method="post">
		  	          <input type="text" hidden id="idrecordatorios" name="idrecordatorios"value="">
		  	          <label>Fecha: </label>
		  	          <input type="date" id="fecha" name="date" value="`+fecha+`" class="form-control">
		  	          <label>Titulo: </label>
		  	          <input type="text" id="titulo" name="title" value="`+titulo+`" class="form-control">
		  	          <label>Descripcion: </label>
		  	          <input type="text" id="descripcion" name="description" value="`+descripcion+`" class="form-control"><br>
		  	          <p id="error"></p>
		  	        </form>
		  	      </div>`,
		  closable: false,
		  buttons: [{
			label: 'Cancelar',
			cssClass: 'btn-danger',
			id: 'cancel',
			action: function(dialogRef){
				dialogRef.close();
			  }
			},{
			label: "Enviar",
			id: "send",
			cssClass: 'btn-primary',
			action: function(dialogRef){
				send();
			  }
		  }]
	  });
  }
  function send()
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
           formulario.setAttribute('action', 'index.php/User/funcionRecordatorio');
           formulario.submit();
           bandera=true;
      }
      else
      {
          formulario.setAttribute('action', 'index.php/User/funcionRecordatorio');
          formulario.submit();
          bandera=false;
      }
  	}
  	else {
  		error.innerHTML = 'Uno o más elementos están vacíos';
       $(this).removeAttr('disabled');
  	}
  }

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
     formulario.setAttribute('action', 'index.php/User/funcionRecordatorio');
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
	var fecha = $(".highlight").children('td:nth-child(2)').first().html();
	var titulo =  $(".highlight").children('td:nth-child(4)').first().html();
	var descripcion =  $(".highlight").children('td:nth-child(5)').first().html();

	desplegarDialogo(fecha,titulo,descripcion);
  }
  else
  {
    $(".DivELetrasrojas p").text('Por favor seleccione una fila');
  }
  });
});
