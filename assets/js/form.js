var container = document.getElementById('container');
var btnGuardar = document.getElementById('btnGuardar');
var btnCancelar = document.getElementById('btnCancel');
var tipoTutoria = document.getElementById('tipo');
var nivel = document.getElementById('nivel');
var pEdu = document.getElementById('programa');
var fechaInicio = document.getElementById('fechaInicio').value;
var fechaFin = document.getElementById('fechaFin').value;
var estado = document.getElementById('estado');
var error = document.getElementById('error');
var x = 0;



function guardar() {
	event.preventDefault();
	if(tipoTutoria.selectedIndex == 0 || nivel.selectedIndex == 0 || pEdu.selectedIndex == 0 || fechaInicio == null|| fechaFin == null || estado.selectedIndex == 0) {
		BootstrapDialog.show({
			title: 'Error',
			message: 'Favor de rellenar todos los campos',
			type: BootstrapDialog.TYPE_WARNING,
			buttons: [ {
				label: 'Aceptar',
				cssClass: 'btn btn-warning',
				action: function(dialogItself) {
					dialogItself.close();
				}
			}]
		});
	}
	else {
		document.getElementById('formulario').submit();
	}
}

function cancelar(event) {
	event.preventDefault();
	BootstrapDialog.show({
		title: 'Confirmar',
		message: 'Se descartarán todos lo cambios realizados. ¿Desea continuar?',
		type: BootstrapDialog.TYPE_PRIMARY,
		buttons: [{
			label: 'Cancelar',
			cssClass: 'btn btn-danger',
			action: function(dialogItself) {
				dialogItself.close();
			}
		}, {
			label: 'Continuar',
			cssClass: 'btn btn-primary',
			action: function(dialogItself) {
				location.reload();
			}
		}]
	});
}
