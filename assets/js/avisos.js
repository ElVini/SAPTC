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
  $('[data-toggle="popover"]').popover();
  $("[data-toggle=tooltip]").tooltip();
  function desplegarDialogo(fecha,titulo,descripcion){
	  BootstrapDialog.show({
		  size: BootstrapDialog.SIZE_NORMAL,
		  closable: true,
		  title: 'Nuevo recordatorio',
		  type: BootstrapDialog.TYPE_PRIMARY,
		  message: `<div id="divPrueba"> <form id="formulario" method="post"> <input type="text" hidden id="idrecordatorios" name="idrecordatorios"value="">
		  	          <label>Fecha: </label>
		  	          <input type="date" id="fecha" name="date" value="`+fecha+`" class="form-control">
		  	          <label>Título: </label>
		  	          <input type="text" id="titulo" name="title" value="`+titulo+`" class="form-control">
		  	          <label>Descripción: </label>
		  	          <input type="text" id="descripcion" name="description" value="`+descripcion+`" class="form-control"><br>
		  	          <p id="error">  </p>   </form>   </div>`,
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


  $('#tabla').on('click', 'tbody tr td', function(event) {
	  if($(this).parent().attr('class') == 'highlight'){
		  $(this).parent().removeClass('highlight');
	  }
	  //cuando no la tiene la asigna al tr y la elimina de los demas
	  else{
		  $(this).parent().addClass('highlight').siblings().removeClass('highlight');
		  id = -1;
		  $(".DivELetrasrojas").hide('slow');
	  }
  });

  /*--------------------------DELETE BUTTON (NO JQUERY HERE)-----------------------*/
  var btnElim = document.getElementById('delete');
  btnElim.addEventListener('click', function(event) {
  event.preventDefault();
  var seleccionado = $(".highlight ").children('td:not(#noRegistro):nth-child(1)').first().html();
  if(seleccionado != undefined){
	  BootstrapDialog.confirm({
		  title: "Advertencia",
		  type: BootstrapDialog.TYPE_DANGER,
		  message: "¿Seguro que desea eliminar el registro actual?",
		  btnCancelLabel: 'Cancelar',
		  btnOKLabel: 'Eliminar',
		  closable: true,
		  callback: function(result){
			  if(result){
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
	  });
 }
 else
 {
   $(".DivELetrasrojas").show();
   $(".DivELetrasrojas p").text('Por favor seleccione una fila');
 }
});
/*--------------------------EDIT BUTTON-----------------------*/
  var btnEdit = document.getElementById('edit');
  btnEdit.addEventListener('click', function(event) {
  event.preventDefault();
  bandera=true;
  var id = $(".highlight ").children('td:not(#noRegistro):nth-child(1)').first().html();
  if(id != undefined){
	var fecha = $(".highlight").children('td:nth-child(2)').first().html();
	var titulo =  $(".highlight").children('td:nth-child(4)').first().html();
	var descripcion =  $(".highlight").children('td:nth-child(5)').first().html();

	desplegarDialogo(fecha,titulo,descripcion);
  }
  else
  {
	$(".DivELetrasrojas").show();
    $(".DivELetrasrojas p").text('Por favor seleccione una fila');
  }
  });
});
