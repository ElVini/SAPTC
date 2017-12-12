
$(document).ready(function(){
  $('#tablaEstudios').on('click', 'tbody tr', function(event){
		if($(this).attr('class') == 'highlight'){
			$(this).removeClass('highlight');
      $('#eid').val('');
		}
		else{
			$(this).addClass('highlight').siblings().removeClass('highlight');
			$('#eid').val($(this).children().attr("id"));
      $('.error').hide();
		}
	});
  $('.detalles').click(function(){
    $(this).attr("id");
    BootstrapDialog.show({
        title: 'Detalles',
        cssClass: 'dialog',
        draggable: true,
        message: $('<div></div>').load( base_url+'index.php/User/form_datoslaborales/'+$(this).attr("id")+'/'+0),
        buttons:[{  label: 'Cerrar',
                    cssClass: 'btn-default',
                    action: function(dialogRef)
                           {	dialogRef.close();
                           }
                 }]
      });
  });
  $('#delete').click(function(){
  	if($('#eid').val()!='')
  	{
      BootstrapDialog.show({
  			type: BootstrapDialog.TYPE_DANGER,
  			title: 'Eliminar',
  			cssClass: 'dialog',
  			message: '¿Esta seguro de borrar este registro?',
  			closable: false,
  			draggable: true,
  			buttons: [{  label: 'Cancelar',
            					cssClass: 'btn-default',
            					action: function(dialogRef)
            					{	dialogRef.close();
            					}
          				},
          				{   label: 'Borrar',
            					cssClass: 'btn-danger',
            					action: function()
            					{	window.location= base_url+"index.php/User/deleteDatol/" + $('#eid').val();
            					}
          				}]
  			});
  		}
  		else
  		{	$(".error").show();
  		}
  });
  $('#contratonow').click(function(){
  	if($('#eid').val() !='')
  	{ BootstrapDialog.show({
  			title: '¡Atención!',
  			cssClass: 'dialog',
  			message: '¿Esta seguro de marcar este registro como contrato actual?',
  			closable: false,
  			draggable: true,
  			buttons: [{  label: 'Cancelar',
          						cssClass: 'btn-danger',
          						action: function(dialogRef)
          						{	dialogRef.close();
          						}
        					},
        					{   label: 'OK',
          						cssClass: 'btn-primary',
          						action: function()
          						{	window.location= base_url+"index.php/User/contratoactual/" + $('#eid').val();
          						}
        					}]
  				});
  		}
  		else
  		{	$(".error").show();
  		}
  });
  $('#firstcontrato').click(function(){
  	if($('#eid').val()!='')
  	{ BootstrapDialog.show({
  			title: '¡Atención!',
  			cssClass: 'dialog',
  			message: '¿Esta seguro de marcar este registro como primer contrato?',
  			closable: false,
  			draggable: true,
  			buttons: [{  label: 'Cancelar',
          					 cssClass: 'btn-danger',
          					 action: function(dialogRef)
                     {	dialogRef.close();
                     }
          				},
        					{   label: 'OK',
          						cssClass: 'btn-primary',
          						action: function()
          						{	window.location= base_url+"index.php/User/contratoprimero/" + $('#eid').val();
          						}
            			}]
      			});
      	}
      	else
      	{	$('.error').show();
      	}
  });
  $("#add").on('click', function(event) {
			BootstrapDialog.show({
  			title: 'Agregar Nuevo ',
  			cssClass: 'dialog',
  			draggable: true,
        closable: false,
        message: $('<div></div>').load( base_url+'index.php/User/form_datoslaborales/'+0+'/'+1),
  		  buttons:[{  label: 'Cancelar',
      			        cssClass: 'btn-danger',
      			        action: function(dialogRef)
      			        			{	dialogRef.close();
      				          	}
  		        	 },
  		        	 {  label: 'Enviar',
                    id: 'enviar',
    				        cssClass: 'btn-primary',
    				        action: function()
    				        { if($('#nom').val() !='' && $('#tipo_nom').val()!='' && $('#dedicacion').val()!='' &&  $('#dependencia').val()!='' && $('#unidad').val()!='' && $('#fecha_init').val() !=''  && ($('#fecha_fin').val()!='' || formu == false))
    			            {	$('#enviar').attr("disabled", true);
                        $.ajax({
      											type:"POST",
      											url: base_url+"index.php/User/agregaDatosLaborales",
      											data:$("form").serialize(),
														success: function() {
															location.reload();
														}
    											 });
    			               }
    			               else
    			               {	BootstrapDialog.alert({
                              type: BootstrapDialog.TYPE_DANGER,
                              title: '¡Atención!',
                              message: 'Favor de llenar todos los campos'
    										 		});
    			               }
    		            	}
    		     		 }]
		  });
  });
  $("#modify").on('click', function(event) {
			formu= false;
			if($('#eid').val()!='')
			{  BootstrapDialog.show({
  				title: 'Modificar',
  				cssClass: 'dialog',
  				draggable: true,
          closable: false,
  	      message: $('<div></div>').load( base_url+'index.php/User/form_datoslaborales/'+$('#eid').val()+'/'+1),
  		    buttons:[{  label: 'Cancelar',
          			      cssClass: 'btn-danger',
          			      action: function(dialogRef)
          			        		 {	dialogRef.close();
          					         }
  		        	   },
                   {	label: 'Enviar',
                      cssClass: 'btn-primary',
                      action: function()
                      { if( $('#nom').val() !='' && $('#tipo_nom').val()!='' &&  $('#dedicacion').val()!='' && $('#dependencia').val()!='' && $('#unidad').val()!='' && $('#fecha_init').val()!='' && ($('#fecha_fin').val()!='' || formu == false ))
                        {
                          $.ajax({
                      			type:"POST",
                      			url: base_url+"index.php/User/actualizaDatosLaborales/"+$('#eid').val(),
                        		data:$("form").serialize(),
                						success: function() {
                							location.reload();
                						}
                      		});
                        }
                      	else
                      	{	BootstrapDialog.alert({
                      			title: '¡Atención!',
                      			message: 'Favor de llenar todos los campos',
                      			type: BootstrapDialog.TYPE_DANGER
                      		});
                        }
                      }
                    }]
  		  });
  		}
  		else
  		{	$('.error').show();
  		}
  });
});

var formu=false;
function fecha(dec)
{
  if ($('#tipo_nom').val() == "Temporal")
  { $('.fecha').show();
    formu=true;
  }
  else if($('#tipo_nom').val() == "Indeterminado" && dec== null || $('#tipo_nom').val() == "")
      {	$('.fecha').hide();
      	formu=false
      }
      else
    	{	$('.fecha').show();
    		formu=false;
    	}
}
