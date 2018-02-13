
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
    detalles($(this).attr("id"));
  });
});
function detalles(id)
{
  BootstrapDialog.show({
      title: 'Detalles',
      cssClass: 'dialog',
      draggable: true,
      message: $('<div></div>').load( base_url+'index.php/User/form_datoslaborales/'+id+'/'+0),
      buttons:[{  label: 'Cerrar',
                  cssClass: 'btn-default',
                  action: function(dialogRef)
                         {	dialogRef.close();
                         }
               }]
    });
}
function agregar()
{
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
                { confirmaForm(true)
                }
             }]
  });
}
function borrar(){
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
}
function contratoActual(){
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
}
function primerContrato(){
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
}

function modificar(){
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
                    { confirmaForm(false);
                    }
                  }]
      });
    }
    else
    {	$('.error').show();
    }
}
function confirmaForm(dec)
{
  if(dec == true)
    var datos=  base_url+"index.php/User/agregaDatosLaborales";
  else
    var datos=  base_url+"index.php/User/actualizaDatosLaborales/"+$('#eid').val();
  if($('#nom').val() !='' && $('#tipo_nom').val()!='' && $('#dedicacion').val()!='' &&  $('#dependencia').val()!='' && $('#unidad').val()!='' && $('#fecha_init').val() !=''  && ($('#fecha_fin').val()!='' || formu == false))
    {	$('#enviar').attr("disabled", true);
      $.ajax({
          type:"POST",
          url: datos,
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
