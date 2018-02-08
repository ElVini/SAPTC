
$(document).ready(function(){
	$('#Agregar').click(function(){
		$('#div-form').append("<div id='formu'></div>");
		BootstrapDialog.show({
					title: 'Agregar gestión académica',
					message: `<div>Seleccione el tipo de gestión académica:<br>
								<input type="radio" id="colectiva" value="Colectiva" name="gestion"><label for="colectiva">&nbsp;Gestión colectiva</label>
								<input type="radio" id="individual" value="Individual" name="gestion"><label for="individual">&nbsp;Gestión individual</label></div>`,
					size: BootstrapDialog.SIZE_SMALL,
					buttons: [{
						label: 'Cancelar',
						cssClass: 'btn-danger',
						action: function(dialog) {
							dialog.close();
						}
					}, {
						label: 'Continuar',
						cssClass: 'btn-primary',
						action: function(dialog) {
							var seleccion = $("input[name='gestion']:checked").val();
							if(seleccion != undefined){	//Al darle click para escoger Colectiva o individual
								dialog.setMessage($('#formu').load(base_url+'index.php/User/gestionAca_form?seleccion='+seleccion));
								dialog.setSize(BootstrapDialog.SIZE_WIDE);
								$(this).text('Guardar');
							}
							else if($(this).text()=='Guardar'){ //cuando quiere guardar los cambios realizados
								if(validarEnvio()){
									$('#registro').submit();
								}
								else{
									BootstrapDialog.alert({
							            title: '¡Error!',
							            message: 'Llene todos los campos obligatorios(*)',
							            type: BootstrapDialog.TYPE_WARNING, // <-- Default value is BootstrapDialog.TYPE_PRIMARY
							            closable: true,
							        });
								}
							}

						}
					}]
				});
	});

	$('#Modificar').click(function(){
		var id = $(".highlight ").children('td:not(#noRegistro):nth-child(1)').first().html();
		var seleccion = $(".highlight ").children('td:not(#noRegistro):nth-child(2)').first().html();
		var base_url = $('#base_url').val();
		$('#div-form').append("<div id='formu'></div>");
		if(id != undefined){
			BootstrapDialog.show({
						title: 'Agregar gestión académica',
						message: $('#formu').load(base_url+'index.php/User/gestionAca_form?seleccion='+seleccion+'&&id='+id),
						size: BootstrapDialog.SIZE_WIDE,
						buttons: [{
							label: 'Cancelar',
							cssClass: 'btn-danger',
							action: function(dialog) {
								dialog.close();
							}
						}, {
							label: 'Enviar',
							cssClass: 'btn-primary',
							action: function(dialog) {
								if(validarEnvio()){
									$('#registro').attr('action',base_url+'index.php/User/agregar_mod_gestion?id='+id);
									$('#registro').submit();
								}
							}
						}]
					});
		}
		else{
			id=-1;
			$(".DivELetrasrojas").show('slow');
		}
	});

	$('#EliminarB').click(function(){
		var id = $(".highlight ").children('td:not(#noRegistro):nth-child(1)').first().html();
		var base_url = $('#base_url').val();
		$('#div-form').append("<div id='formu'></div>");
		if(id != undefined){
			BootstrapDialog.confirm({
				title: "Advertencia",
				type: BootstrapDialog.TYPE_DANGER,
				message: "¿Seguro que desea eliminar el registro actual?",
				btnCancelLabel: 'Cancelar',
				btnOKLabel: 'Eliminar',
				closable: true,
				callback: function(result){
					if(result){
						$('#delete_form').append('<form id="form"method="post" action="'+base_url+'index.php/User/deleteGestion"><input type="hidden"name="id" value="'+id+'"></form>');
						$('#form').submit();
					}
				}
			});
		}
		else{
			id=-1;
			$(".DivELetrasrojas").show('slow');
		}
	})

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
	$('#detalles a').click(function(){
		$(this).parent().parent().addClass('detalles').siblings().removeClass('detalles');
		$('tr').removeClass('highlight');
		id = null;
		var id = $(".detalles ").children('td:nth-child(1)').first().html();
		var seleccion = $(".detalles ").children('td:nth-child(2)').first().html();
		var base_url = $('#base_url').val();
		$('#div-form').append("<div id='formu'></div>");
		if(id != undefined){
			BootstrapDialog.show({
						title: 'Agregar gestión académica',
						message: $('#formu').load(base_url+'index.php/User/gestionAca_form?seleccion='+seleccion+'&&id='+id),
						size: BootstrapDialog.SIZE_WIDE,
						buttons: [{
							label: 'OK',
							action: function(dialog) {
								$('tr').removeClass('detalles');
								dialog.close();
							}
						}]
					});
		}
	});
});
//esta función solo verifica que todos los inputs obligatorios esten llenos y regresa un true o false
function validarEnvio(){
	if( $('#cargo-act').val() != '' &&
		$('#fechaIni').val() != '' &&
		$('#resultados').val() != '' &&
		$('#funcion').val() != '' &&
		$('#estado').val() != '' &&
		$('#organo').val() != '' &&
		$('#ultimoReporte').val() != '' &&
		$('#IES').val() != '' &&
		$('#aprobado').val() != '' &&
		$('#horasSemana').val() != '' ){
			return true;
		}
		else
			return false;

}
