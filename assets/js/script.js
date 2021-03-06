var btnDel = document.getElementById('btnDel');
var btnMod = document.getElementById('btnMod');
var btnAdd = document.getElementById('btnAdd');
var btnCancel = document.getElementById('btnCancel');
var btnGuardar = document.getElementById('btnGuardar');
var divBoton = document.getElementById('botones');
var error = document.getElementById('msjError');
var x=0;
var ac = 0;
var seleccion;

var filas = document.getElementsByTagName('tr');	//Crea un array con los elementos de la tabla
var deleteElement;
var selected;
var send;
var elemento;

function getValue(valor, posicion) {
	deleteElement = valor;
	selected = filas[posicion];
	elemento = posicion;
	selected.setAttribute('id','clickEvent');
	for(var i = 1; i<filas.length; i++) {
		if(i != posicion)
			filas[i].setAttribute('id', '#');
	}
	ac = 1;
}

function obtener() {
	if(ac!=0) {
		var formulario = document.createElement('form');
		formulario.setAttribute('action', 'index.php?m=1&t=m');
		formulario.setAttribute('method','post');
		var caja = document.createElement('input');
		caja.setAttribute('name', 'elemento');
		caja.setAttribute('type', 'hidden');
		caja.value = deleteElement;
		formulario.appendChild(caja);
		document.body.appendChild(formulario);
		formulario.submit();
	}
	else {
		error.innerHTML = 'Por favor, seleccione un elemento a modificar';
	}
	return false;
}

btnDel.addEventListener('click', function(event) {
	event.preventDefault();
	if(ac!=0) {
		var formulario = document.createElement('form');
		formulario.setAttribute('action', $("#url").val() + 'index.php/User/eliminarTutoria?id=' + deleteElement);
		formulario.setAttribute('method','post');
		var caja = document.createElement('input');
		caja.setAttribute('name', 'elemento');
		caja.setAttribute('type', 'hidden');
		caja.value = deleteElement;
		formulario.appendChild(caja);
		document.body.appendChild(formulario);
		BootstrapDialog.show({
			title: 'Confirmar',
			message: 'El elemento seleccionado será eliminado, esta acción no se puede deshacer, ¿Desea continuar?',
			type: BootstrapDialog.TYPE_DANGER,
			buttons: [{
				label: 'Confirmar',
				cssClass: 'btn btn-primary',
				action: function enviar() {
					formulario.submit();
				}
				}, {
					label: 'Cancelar',
					cssClass: 'btn btn-danger',
					action: function cerrar(dialogItself) {
						dialogItself.close();
					}
			}]
		});
	}
	else {
		BootstrapDialog.show({
			title: 'Error',
			message: 'Favor de seleccionar un elemento a eliminar',
			type: BootstrapDialog.TYPE_WARNING,
			buttons: [{
				label: 'Aceptar',
				cssClass: 'btn btn-warning',
				action: function(dialogItself) {
					dialogItself.close();
				}
			}]
		});
	}
});
/*btnMod.addEventListener('click', function(event) {
	event.preventDefault();
});*/

function guardar() {
	$("#formulario").submit();
}
