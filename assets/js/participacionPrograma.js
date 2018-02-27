function otroGrado()
{ if ($('#grado').val() == 0 &&  $('#grado').val() !="")
  { $('.otra').show();
    $('.primera').hide();
  }
}
$(document).ready(function(){
  $('#tablaEstudios').on('click', 'tbody tr', function(event){
    if($(this).attr('class') == 'highlight'){
      $(this).removeClass('highlight');
      $('#id_p').val('');
    }
    else{
      $(this).addClass('highlight').siblings().removeClass('highlight');
      $('#id_p').val($(this).children().attr("id"));
      $('.error').hide();
    }
  });
  $("#add").on('click', function(event){
    verifica(0);
  });
  $("#modify").on('click', function(event){
    verifica($('#id_p').val());
  });
  $('#delete').click(function(){
    borrar();
  });
});
function borrar()
{ if($('#id_p').val() !='')
  { BootstrapDialog.show({
      type: BootstrapDialog.TYPE_DANGER,
      title: 'Eliminar',
      cssClass: 'dialog',
      message: '¿Esta seguro de borrar este registro?',
      closable: false,
      draggable: true,
      buttons: [{ label: 'Cancelar',
                  cssClass: 'btn-default',
                  action: function(dialogRef)
                  {	dialogRef.close();
                  }
                },
                {
                  label: 'Borrar',
                  cssClass: 'btn-danger',
                  action: function()
                  {	window.location= base_url+"index.php/User/deleteParticipacion/" + $('#id_p').val();
                  }
                }]
    });
  }
  else
  {	$(".error").show();
  }
}
function verifica(dec)
{
  if(dec!='' || dec===0 )
  { BootstrapDialog.show({
      title: 'Agregar Nuevo ',
      cssClass: 'dialog',
      draggable: true,
      closable: false,
      message:$ ( '<div> </ div>' ). load ( base_url+'index.php/User/formParticipacion/'+ dec ),
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
                  { if( $('#programa').val() !='' && $('#fechacambio').val()!='' && ($('#grado').val()!=0 || ($('#grado').val()==0 &&
                        $('#og').val()!='')) && $('#des').val()!="" && ($('#archivo').val()!="" || dec!='') && $('#opc').val()!=1)
                    { if($('#archivo').val()!='')
                      { if($('#archivo').val().substring($('#archivo').val().lastIndexOf(".")).toLowerCase()!='.pdf')
                        {
                          BootstrapDialog.alert({
                               title: '¡Atención!',
                               message: 'Comprueba la extensión del archivo. Sólo puede subir archivos .pdf ',
                               type: BootstrapDialog.TYPE_DANGER
                            });
                        }
                        else  if ( ($('#archivo')[0].files[0].size/1024 < 4096))
                              {
                                $('#enviar').attr("disabled", true);
                                $("form").submit();
                              }
                              else
                              {
                                BootstrapDialog.alert({
                                     title: '¡Atención!',
                                     message: 'El archivo excede el tamaño maximo de 4MB.',
                                     type: BootstrapDialog.TYPE_DANGER
                                  });
                              }
                      }
                      else
                      {
                        $('#enviar').attr("disabled", true);
                        $("form").submit();
                      }
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
}
