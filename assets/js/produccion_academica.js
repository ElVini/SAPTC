
$(document).ready(function(){
	var base_url = $('#base_url').val();
	$('#Agregar').click(function(){
		$('#ajax').append("<div id='formu'></div>");
		$.ajax({
			type: "POST",
			url: base_url+"index.php/User/produccion_form",
			success: function (data) {
				cargarDialogo($("#formu").html(data));
			  }
			});
	});

});

function cargarDialogo(ajaxreturn){
	BootstrapDialog.show({
	  size: BootstrapDialog.SIZE_WIDE,
	  closable: true,
	  title: 'Nueva producción acádemica',
	  type: BootstrapDialog.TYPE_PRIMARY,
	  message: ajaxreturn,
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

		  }
	  }]
	});
}
