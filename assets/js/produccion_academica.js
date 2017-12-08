var id= null;
$(document).ready(function(){
	var base_url = $('#base_url').val();
	$('#Agregar').click(function(){
		$('#ajax').append("<div id='formu'></div>");
		$.ajax({
			url: "produccion_form",
			success: function (data) {
				cargarDialogo($("#formu").html(data), -1);
			  }
			});
	});

	$('#Modificar').click(function(){
		id = $(".highlight ").children('td:nth-child(1)').first().html();
		if(id != undefined)
		{
			$('#ajax').append("<div id='formu'></div>");
			$.ajax({
				type: "POST",
				url: "produccion_form",
				data: "id="+id,
				cache: false,
				success: function (data) {
					cargarDialogo();
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
		if(id!= undefined)
		{
			$('#delete_form').append('<form id="form"method="post" action="'+base_url+'index.php/User/addProduccion"><input type="hidden"name="id" value="'+id+'"></form>');
			$('#form').submit();
		}
		else{
			$(".DivELetrasrojas").show('slow');
		}
	});

	//$('#tablaEstudios').on('click', 'tbody tr', function(event) {
	$('td:not(#detalles)').click(function(){
		$('tr').removeClass('detalles');
		//cuando ya tiene la clase
		if($(this).parent().attr('class') == 'highlight'){
			$(this).parent().removeClass('highlight');
		}
		//cuando no la tiene la asigna al tr y la elimina de los demas
		else{
			$(this).parent().addClass('highlight').siblings().removeClass('highlight');
			id = null;
			$(".DivELetrasrojas").hide('slow');
		}
	});
	//remueve el highlight de todos los tr cuando se le pica a la etiqueta a
	$('#detalles a').click(function(){
		$(this).parent().parent().addClass('detalles').siblings().removeClass('detalles');
		$('tr').removeClass('highlight');
		id = null;
		detallesDialogo();
	});
});
//segundo parametro define la funcion
//-1 agregar
//si recibe id es para modificar
function cargarDialogo(){

	BootstrapDialog.show({
	  size: BootstrapDialog.SIZE_WIDE,
	  closable: true,
	  title: 'Nueva producción acádemica',
	  type: BootstrapDialog.TYPE_PRIMARY,
	  message: $('#formu').load(base_url+'index.php/User/produccion_form'),
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
		  BootstrapDialog.alert({
            title: '¡Atención!',
            message: 'Favor de llenar todos los campos',
            type: BootstrapDialog.TYPE_DANGER, // <-- Default value is BootstrapDialog.TYPE_PRIMARY
            closable: true, // <-- Default value is false
            buttonLabel: 'OK', // <-- Default value is 'OK',
        });
	  }
}


function notNullValues(){
	var object = {
		titulopro : document.getElementById('Titulo').value,
		anopro : document.getElementById('Ano').value,
		citaspro : document.getElementById('Citas').value,
		tipopro : document.getElementById('tipoproduccion').value,
		indpro : document.getElementById('Ind').value,
		capro :document.getElementById('CA').value,
		//horaspro :document.getElementById('Horas').value,
		parapro :document.getElementById('para').value
	}

	if(object.parapro == 1)
	{
		object.miembrospro = document.getElementById('Miembros').value;
	}
	for (var key in object) {
		if (object.hasOwnProperty(key)) {
			if(object[key] == "")
				return false;
		}
	}
	return true;
}

function detallesDialogo(){
	$('#ajax').append("<div id='formu'></div>");
	BootstrapDialog.show({
	  size: BootstrapDialog.SIZE_MEDIUM,
	  closable: true,
	  title: 'Detalles',
	  type: BootstrapDialog.TYPE_PRIMARY,
	  message: $('#formu').load(base_url+'index.php/User/mostrarDetalles'),
	  buttons: [{
		label: 'OK',
		id: 'cancel',
		action: function(dialogRef){
				dialogRef.close();
		  }
		}]
	});
}
