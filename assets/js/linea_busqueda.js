$('#tablaLinea').on('click', 'tbody tr', function(event) {
  		$(".error").hide();
  		$(this).addClass('highlight');
  		$('tbody tr').removeClass('highlight');
  		$(this).addClass('highlight');
  	});

  function desplegarDialogo(nombre,actividades,horas){
	  BootstrapDialog.show({
		  size: BootstrapDialog.SIZE_NORMAL,
		  closable: true,
		  title: 'Nueva Línea de Generación',
		  type: BootstrapDialog.TYPE_PRIMARY,
		  message: `<div id="divPrueba"> <form id="formulario" method="post"> <input type="text" hidden id="idlinea" name="idlinea" value="">
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
                                    url: base_url+"index.php/User/agregarLinea/",
                                    data:{
                                        'nombre':            nombre,
                                        'actividades':       actividades,
                                        'horas':             horas
                                    },
                                    success:function (data) 
                                    {
                                        BootstrapDialog.alert('Agregado correctamente');
                                        setTimeout(function(){location.href= base_url+"index.php/User/buscarLinea/"+nombre, 1000} );   
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

  var btnAsociar = document.getElementById('Asociar');
  btnAsociar.addEventListener('click', function(event) {
    event.preventDefault();
    bandera=true;
    var id = $(".highlight ").children('td:nth-child(1)').first().html();
    if(id != undefined){
	  	var nombre = $(".highlight").children('td:nth-child(2)').first().html();
	  	var actividades =  '';
	  	var horas =  '';

	  	desplegarDialogo(nombre, actividades, horas);
    }
    else
    {
      $(".DivELetrasrojas").show('slow');
    }
  });

  var btnAgregar = document.getElementById('Agregar');
  btnAgregar.addEventListener('click', function(event) {
    event.preventDefault();
    
  	BootstrapDialog.show({
        title: 'Nuevo nivel',
        message: "<input id='txtNombre' class='form-control' placeholder='Escribe el nombre de la línea de generación'></input>"+
        		 "<br><input id='txtActividades' class='form-control' placeholder='Escribe las actividades realizadas'></input>"+
        		 "<br><input id='txtHoras' class='form-control' placeholder='Escribe las horas' type='number'></input>",
        buttons: [{
            label: 'Cancelar',
            cssClass: 'btn-danger',
            action: function(dialogItself) {
                dialogItself.close();
            }
        },{
            label: 'Guardar',
            cssClass: 'btn-success',
            hotkey: 13, // Enter.
            action: function() {
               var nombre 		= $('#txtNombre').val();
               var actividades  = $('#txtActividades').val();
               var horas 		= $('#txtHoras').val();
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
                                    url: base_url+"index.php/User/agregarLinea/",
                                    data:{
                                        'nombre':            nombre,
                                        'actividades': 		   actividades,
                                        'horas': 			       horas
                                    },
                                    success:function (data) 
                                    {
                                        BootstrapDialog.alert('Agregado correctamente');
                                        setTimeout(function(){location.href= base_url+"index.php/User/buscarLinea/"+nombre, 1000} );   
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
    
  });

  var btnRegresar = document.getElementById('Regresar');
  btnRegresar.addEventListener('click', function(event) {
    event.preventDefault();
        location.href= base_url+"index.php/User/linea_generacion/";
    });