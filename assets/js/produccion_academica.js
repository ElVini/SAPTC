
$(document).ready(function(){
	var base_url = $('#base_url').val();
	$('#Agregar').click(function(){
		$('#ajax').append("<div id='formu'></div>");
		$.ajax({
			type: "POST",
			url: base_url+"index.php/User/produccion_form",
			success: function (data) {
				cargarDialogo($("#formu").html(data), -1);
			  }
			});
	});

	$('#Modificar').click(function(){
		var id = $(".highlight ").children('td:nth-child(1)').first().html();
		if(id!=undefined)
		{
			$('#ajax').append("<div id='formu'></div>");
			$.ajax({
				type: "POST",
				url: base_url+"index.php/User/produccion_form",
				success: function (data) {
					cargarDialogo($("#formu").html(data), id);
			  	}
			});
		}
		else
		{
		  $(".DivELetrasrojas").show('slow');
		}
	});

	$('#EliminarB').click(function(){
		var id = $(".highlight ").children('td:nth-child(1)').first().html();
		$('#delete_form').append('<form id="form"method="post" action="'+base_url+'index.php/User/addProduccion"><input type="hidden"name="id" value="'+id+'"></form>');
		$('#form').submit();
	});

	$('#tablaEstudios').on('click', 'tbody tr', function(event) {
  		$(this).addClass('highlight').siblings().removeClass('highlight');
  		$(".DivELetrasrojas").hide('slow');
	});

});
//segundo parametro define la funcion
//-1 agregar
//si recibe id es para modificar
function cargarDialogo(ajaxreturn,id){

	BootstrapDialog.show({
	  size: BootstrapDialog.SIZE_WIDE,
	  closable: true,
	  title: 'Nueva producción acádemica',
	  type: BootstrapDialog.TYPE_PRIMARY,
	  message: ajaxreturn,
	  onshown: function(){
		  if(id!= -1){
			  $('#id').val(id);
			  $('#Titulo').val($(".highlight ").children('td:nth-child(2)').first().html());
			  $('#Ano').val($(".highlight ").children('td:nth-child(3)').first().html());
			  $('#Citas').val($(".highlight ").children('td:nth-child(4)').first().html());
			  $('#tipoproduccion').val($(".highlight ").children('td:nth-child(5)').first().html());
			  $('#Para').val($(".highlight ").children('td:nth-child(6)').first().html());
			  $('#Miembros').importTags($(".highlight ").children('td:nth-child(7)').first().html());
			  $('#Ind').val($(".highlight ").children('td:nth-child(8)').first().html());
			  $('#CA').val($(".highlight ").children('td:nth-child(9)').first().html());
			  $('#Horas').val($(".highlight ").children('td:nth-child(10)').first().html());
		  }
	  },
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

function send(){
  	if(notNullValues())
	  {
		var formulario = document.getElementById('registro');
		$('#send').prop('disabled','true');
		formulario.submit();
	  }
	  else
	  {
		  $(".ErrorInputs").show('slow');
	  }
}

function notNullValues(){
	var object = {
		titulopro : document.getElementById('Titulo').value,
		anopro : document.getElementById('Ano').value,
		citaspro : document.getElementById('Citas').value,
		tipopro : document.getElementById('tipoproduccion').value,
		indpro : document.getElementById('Ind').value,
		miembrospro : document.getElementById('Miembros').value,
		capro :document.getElementById('CA').value,
		horaspro :document.getElementById('Horas').value,
		parapro :document.getElementById('Para').value
	}
	for (var key in object) {
		if (object.hasOwnProperty(key)) {
			if(object[key] == "")
				return false;
		}
	}
	return true;
}
