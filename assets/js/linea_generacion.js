$(document).ready(function(){
  $('#tablaLinea').on('click', 'tbody tr', function(event) {
  		$(".error").hide();
  		$(this).addClass('highlight');
  		$('tbody tr').removeClass('highlight');
  		$(this).addClass('highlight');
  	});

  function desplegarDialogo(id,nombre,actividades,horas){
	  BootstrapDialog.show({
		  size: BootstrapDialog.SIZE_NORMAL,
		  closable: true,
		  title: 'Nueva Línea de Generación',
		  type: BootstrapDialog.TYPE_PRIMARY,
		  message: `<div id="divPrueba"> <form id="formulario" method="post"> <input type="text" hidden id="idlinea" name="idlinea" value="`+id+`">
		  	          <label>Nombre: </label>
		  	          <input type="text" id="txtNombre" name="nombre" value="`+nombre+`" class="form-control">
		  	          <label>Actividades: </label>
		  	          <input type="text" id="txtActividades" name="actividades" value="`+actividades+`" class="form-control">
		  	          <label>Horas Semanales: </label>
		  	          <input type="number" id="txtHoras" name="horas" value="`+horas+`" class="form-control"><br>
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
        var id    = $('#idlinea').val();
				var nombre    = $('#txtNombre').val();
               var actividades  = $('#txtActividades').val();
               var horas    = $('#txtHoras').val();
               if(actividades === '' && nombre === '' && horas === ''){
                    BootstrapDialog.alert({
                       title: 'Error',
                        message: 'Falta llenar un campo',
                        type: BootstrapDialog.TYPE_DANGER
                    });
               }else{
                    BootstrapDialog.confirm({
                        title: 'GUARDAR',
                        message: '¿Seguro que desea guardar?',
                        type: BootstrapDialog.TYPE_PRIMARY, // <-- Default value is BootstrapDialog.TYPE_PRIMARY
                        closable: true, // <-- Default value is false
                        draggable: true, // <-- Default value is false
                        btnCancelLabel: 'Cancelar', // <-- Default value is 'Cancel',
                        btnCancelClass: 'btn-danger',
                        btnOKLabel: 'Confirmar', // <-- Default value is 'OK',
                        btnOKClass: 'btn-success', // <-- If you didn't specify it, dialog type will be used,
                        callback: function(result) {
                            // result will be true if button was click, while it will be false if users close the dialog directly.
                            if(result) {
                                $.ajax({
                                    type:"POST",
                                    url: base_url+"index.php/User/modificarLinea/",
                                    data:{
                                        'id':                id,
                                        'nombre':            nombre,
                                        'actividades':       actividades,
                                        'horas':             horas
                                    },
                                    success:function (data) 
                                    {
                                        BootstrapDialog.alert('Agregado correctamente');
                                        setTimeout ("location.reload();", 1000); 
                                    },error:function(jqXHR, textStatus, errorThrown){
                                        console.log('error:: '+ errorThrown);
                                    }
                                });
                            }else {
                                BootstrapDialog.alert('No se guardaran los cambios');
                            }
                        }
                    });    
                }
			  }
		  }]
	  });
  }

  var btnElim = document.getElementById('EliminarB');
  btnElim.addEventListener('click', function(event) {
    var id = $(".highlight ").children('td:nth-child(1)').first().html();
    BootstrapDialog.show({
                title: '¿Seguro?',
                message: '¿Esta seguro que desea borrar esta línea de generación?',
                buttons: [
                {
                    label: 'Cancelar',
                    cssClass: 'btn-danger',
                    id: 'btnModalCancelar',
                    action: function(dialog){
                        dialog.close();
                    }
                },
                {
                  label: 'Aceptar',
                  cssClass: 'btn-primary btnSi',
                  action: function(dialog){
                    if(id!= undefined)
                    {
                      //location.href = base_url+"index.php/User/eliminarLinea/"+id;
                       $.ajax({
                                    type:"POST",
                                    url: base_url+"index.php/User/eliminarLinea/",
                                    data:{
                                        'id':                id
                                    },
                                    success:function (data) 
                                    {
                                        BootstrapDialog.alert('Eliminado correctamente');
                                        setTimeout ("location.reload();", 1000); 
                                    },error:function(jqXHR, textStatus, errorThrown){
                                        BootstrapDialog.alert('Esta acción no puede ser realizada hasta que no se hayan eliminado los registros vinculados anteriormente');
                                        console.log('error:: '+ errorThrown);
                                    }
                                });
                    }
                    else{
                      $(".DivELetrasrojas").show('slow');
                    }

                    $('.btnSi').prop('disabled', true);
                   //location.reload();

                      dialog.close();
                  }
              }
            ]
          });
  });
/*--------------------------MODIFY BUTTON-----------------------*/
  var btnEdit = document.getElementById('Modificar');
  btnEdit.addEventListener('click', function(event) {
    event.preventDefault();
    bandera=true;
    var id = $(".highlight ").children('td:nth-child(1)').first().html();
    if(id != undefined){
    	var nombre = $(".highlight").children('td:nth-child(2)').first().html();
    	var actividades =  $(".highlight").children('td:nth-child(3)').first().html();
    	var horas =  $(".highlight").children('td:nth-child(4)').first().html();
      desplegarDialogo(id, nombre, actividades, horas);
    }
    else
    {
      $(".DivELetrasrojas").show('slow');
    }
  });
/*--------------------------AGREGAR BUTTON-----------------------*/
  var btnAgregar = document.getElementById('Agregar');
  btnAgregar.addEventListener('click', function(event) {
    event.preventDefault();
    BootstrapDialog.show({
      size: BootstrapDialog.SIZE_NORMAL,
      closable: true,
      title: 'Editar Línea de Generación',
      type: BootstrapDialog.TYPE_PRIMARY,
      message: `<div id="divPrueba"> <form id="formulario" method="post"> 
                  <label>Nombre: </label>
                  <input type="text" id="txtNombre" name="nombre" value="" class="form-control">
                  </form>   </div>`,
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
            var descripcion      = $('#txtNombre').val();
            if(descripcion === ''){
              location.href = base_url+"index.php/User/buscarLinea/"+0;
            }else{
              location.href = base_url+"index.php/User/buscarLinea/"+descripcion;
            }
        }
      }
      ]
    });
  });
});