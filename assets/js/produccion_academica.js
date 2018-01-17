var id= -1;
$(document).ready(function(){
	var base_url = $('#base_url').val();
	$('#Agregar').click(function(){
		$('tr').removeClass('highlight');
		$('#ajax').append("<div id='formu'></div>");
		$.ajax({
			url: "produccion_form",
			success: function (data) {
				cargarDialogo();
			  }
			});
	});

	$('#Modificar').click(function(){
		id = $(".highlight ").children('td:not(#noRegistro):nth-child(1)').first().html();
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
		  id=-1;
		  $(".DivELetrasrojas").show('slow');
		}
	});

	$('#EliminarB').click(function(){
		id = $(".highlight ").children('td:not(#noRegistro):nth-child(1)').first().html();
		if(id!= undefined)
		{
			BootstrapDialog.confirm({
				title: "Advertencia",
				type: BootstrapDialog.TYPE_DANGER,
				message: "¿Seguro que desea eliminar el registro actual?",
				btnCancelLabel: 'Cancelar',
				btnOKLabel: 'Eliminar',
				closable: true,
				callback: function(result){
					if(result){
						$('#delete_form').append('<form id="form"method="post" action="'+base_url+'index.php/User/addProduccion"><input type="hidden"name="id" value="'+id+'"></form>');
						$('#form').submit();
					}
				}
			});
		}
		else{
			$(".DivELetrasrojas").show('slow');
			id=-1;
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
			id = -1;
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

	$('#btnCitas').click(function(){
		$('#ajax').append("<div id='formu'></div>");
		id = $(".highlight ").children('td:not(#noRegistro):nth-child(1)').first().html();
		if(id!= undefined)
		{
			BootstrapDialog.show({
			  size: BootstrapDialog.SIZE_MEDIUM,
			  closable: true,
			  title: 'Citas',
			  type: BootstrapDialog.TYPE_PRIMARY,
			  message: $('#formu').load(base_url+'index.php/User/getCitas?id='+id),
			  buttons: [{
				label: 'Ok',
				id: 'cancel',
				action: function(dialogRef){
						id=-1;
						dialogRef.close();
				  }
			  }]
			});
		}
		else{
			$(".DivELetrasrojas").show('slow');
			id=-1;
		}
	})
});


function cargarDialogo(){

	BootstrapDialog.show({
	  size: BootstrapDialog.SIZE_NORMAL,
	  closable: true,
	  title: 'Nueva producción acádemica',
	  type: BootstrapDialog.TYPE_PRIMARY,
	  message: $('#formu').load(base_url+'index.php/User/produccion_form'),
	  buttons: [{
		label: 'Cancelar',
		cssClass: 'btn-danger',
		id: 'cancel',
		action: function(dialogRef){
				id=-1;
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

//esta función verifica que los valores no se envien vacios
function notNullValues(){
	var object = {
		titulopro : document.getElementById('Titulo').value,
		anopro : document.getElementById('Ano').value,
		// citaspro : document.getElementById('Citas').value,
		tipopro : document.getElementById('tipoproduccion').value,
		indpro : $('#lgacInd').val(),
		// capro :document.getElementById('CA').value,
		parapro :document.getElementById('para').value
	}

	$('#lgacIndPost').val(object.indpro.join());
	//condición en caso de que sea parte de cuerpo academico
	if(object.parapro==1){
		var miembros = $('#Miembros').val();
		$('#MiembrosPost').val(miembros.join());
		object.miembros = miembros;
		document.getElementById('lgacAC').value;
		object.lgacAC = document.getElementById('lgacAC').value;
	}

	//condicion en caso de que en tipo de producción seleecione "Otra"
	if(object.tipopro=="Otra"){
		object.otroTipoPro = document.getElementById('OtraProduccion').value;
	}
	//checa todos los elementos del objeto
	for (var key in object) {
		if (object.hasOwnProperty(key)) {
			if(object[key] == "")
			{
				return false;
			}
		}
	}
	return true;
}

function detallesDialogo(){
	 var lgacInd = $(".detalles ").children('td:nth-child(10)').first().html();
	  var miembros = $(".detalles ").children('td:nth-child(8)').first().html();
	$('#ajax').append("<div id='formu'></div>");
	BootstrapDialog.show({
	  size: BootstrapDialog.SIZE_MEDIUM,
	  closable: true,
	  title: 'Detalles',
	  type: BootstrapDialog.TYPE_PRIMARY,
	  message: $('#formu').load(base_url+'index.php/User/mostrarDetalles?lineas='+lgacInd+'&miembros='+miembros),
	  buttons: [{
		label: 'OK',
		id: 'cancel',
		action: function(dialogRef){
				dialogRef.close();
				id=-1;
		  }
		}]
	});
}
