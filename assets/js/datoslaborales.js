$(document).ready(function(){
  $('#tablaEstudios').on('click', 'tbody tr', function(event) {
  		$(".error").hide();
  		$(this).addClass('highlight');
  		$('tbody tr').removeClass('highlight');
  		$(this).addClass('highlight');
  });
  $('#delete').click(function(){
  	var id= $('#eid').val();
  	if(id!='')
  	{ BootstrapDialog.show({
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
            					{	window.location= base_url+"index.php/User/deleteDatol/" + id;
            					}
          				}]
  			});
  		}
  		else
  		{	$(".error").show();
  		}
  });
  $('#contratonow').click(function(){
  	var id= $('#eid').val();
  	if(id !='')
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
          						{	window.location= base_url+"index.php/User/contratoactual/" + id;
          						}
        					}]
  				});
  		}
  		else
  		{	$(".error").show();
  		}
  });
  $('#firstcontrato').click(function(){
  	var id= $('#eid').val() ;
  	if(id!='')
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
          						{	window.location= base_url+"index.php/User/contratoprimero/" + id;
          						}
            			}]
      			});
      	}
      	else
      	{	$('.error').show();
      	}
  });
  $("#add").on('click', function(event) {
			formu=false;
			BootstrapDialog.show({
  			title: 'Agregar Nuevo ',
  			cssClass: 'dialog',
  			draggable: true,
        closable: false,
        message: $('<div></div>').load( base_url+'index.php/User/form_datoslaborales/'+0),
  		  buttons:[{  label: 'Cancelar',
      			        cssClass: 'btn-danger',
      			        action: function(dialogRef)
      			        			{	dialogRef.close();
      				          	}
  		        	 },
  		        	 {  label: 'Enviar',
    				        cssClass: 'btn-primary',
    				        action: function()
    				        { if($('#nom').val() !='' && $('#tipo_nom').val()!='' && $('#dedicacion').val()!='' &&  $('#dependencia').val()!='' && $('#unidad').val()!='' && $('#fecha_init')!='' && ($('#fecha_fin').val()!='' || formu == false))
    			            {	$.ajax({
      											type:"POST",
      											url: base_url+"index.php/User/agregaDatosLaborales",
      											data:{	'nom': $('#nom').val(),
      															'fecha_init': $('#fecha_init').val(),
      															'fecha_fin':$('#fecha_fin').val(),
      															'tipo_nom':  $('#tipo_nom').val(),
      															'dedicacion': $('#dedicacion').val(),
      															'dependencia':$('#dependencia').val(),
      															'unidad': $('#unidad').val(),
      															'profe': $('#profe').val()
      														},
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
			var id= $('#eid').val();
			formu= false;
			if(id!='')
			{  BootstrapDialog.show({
  				title: 'Modificar',
  				cssClass: 'dialog',
  				draggable: true,
          closable: false,
  	      message: $('<div></div>').load( base_url+'index.php/User/form_datoslaborales/'+id),
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
                        {	$.ajax({
                      			type:"POST",
                      			url: base_url+"index.php/User/actualizaDatosLaborales",
                        		data:{  'id_d': id,
                        						'nom': $('#nom').val(),
                        						'fecha_init': $('#fecha_init').val(),
                        						'fecha_fin':$('#fecha_fin').val(),
                        						'tipo_nom': $('#tipo_nom').val(),
                        						'dedicacion': $('#dedicacion').val(),
                        						'dependencia':$('#dependencia').val(),
                        						'unidad': $('#unidad').val(),
                        						'profe': $('#profe').val()
                        					},
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
function datos(id)
{$('#eid').val(id);
}
var formu;
function fecha(dec)
{
  if ($('#tipo_nom').val() == "Temporal")
  { $('.fecha').show();
    formu=true;
  }
  else if($('#tipo_nom').val() == "Indeterminado" && dec== null)
      {	$('.fecha').hide();
      	formu=false
      }
      else
    	{	$('.fecha').show();
    		formu=false;
    	}
}
