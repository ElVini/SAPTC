// Premios o Distinciones JS
  function datos(id)
  {$('#id_p').val(id);
  }
  function otraInstitucion()
  { if ($('#io').val() == 0)
    { $('.otra').show();
    }
    else if ($('#io').val() != 0)
    { $('.otra').hide();
      $('#oio').val('');
    }
  }
$(document).ready(function(){
  $('#tablaEstudios').on('click', 'tbody tr', function(event) {
    $(".error").hide();
    $(this).addClass('highlight');
    $('tbody tr').removeClass('highlight');
    $(this).addClass('highlight');
  });
  $("#add").on('click', function(event) {
        BootstrapDialog.show({
          title: 'Agregar Nuevo ',
          cssClass: 'dialog',
          draggable: true,
          closable: false,
          message: $ ( '<div> </ div>' ). load ( base_url+'index.php/User/formu_premios/'+0 ),
          buttons:[{  label: 'Cancelar',
                      cssClass: 'btn-danger',
                      action: function(dialogRef)
                            {	dialogRef.close();
                            }
                   },
                   {  label: 'Enviar',
                      cssClass: 'btn-primary',
                      action: function()
                      { if( $('#npd').val() !='' && $('#f').val()!='' && ($('#io').val()!=0 || ($('#io').val()==0 && $('#oio').val()!='')) && $('#m').val()!='' )
                        { if ($('#oio').val()!='')
                          {   $.ajax({
                                type:"POST",
                                url: base_url+"index.php/User/agregaPremiosoDistinciones",
                                data:{	'npd': $('#npd').val(),
                                        'f': $('#f').val(),
                                        'io':0,
                                        'm': $('#m').val(),
                                        'oio': $('#oio').val(),
                                        'profe':$('#profe').val(),
                                        'ins': $('#oio').val()// es para agregar la otra Institucion
                                      },
                                success: function() {
                                  location.reload();
                                }
                              });
                          }
                          else
                          {   $.ajax({
                                type:"POST",
                                url: base_url+"index.php/User/agregaPremiosoDistinciones",
                                data:{	'npd': $('#npd').val(),
                                        'f': $('#f').val(),
                                        'io':$('#io').val(),
                                        'm': $('#m').val(),
                                        'oio': $('#oio').val(),
                                        'profe':$('#profe').val()
                                      },
                                success: function() {
                                  location.reload();
                                }
                              });
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
  });
  $("#modify").on('click', function(event) {
        var id= $('#id_p').val();
        if(id!='')
        { BootstrapDialog.show({
            title: 'Modificar',
            cssClass: 'dialog',
            draggable: true,
            closable: false,
            message: $ ( '<div> </ div>' ). load ( base_url+'index.php/User/formu_premios/'+id),
            buttons:[{  label: 'Cancelar',
                        cssClass: 'btn-danger',
                        action: function(dialogRef)
                               {	dialogRef.close();
                               }
                     },
                     {	label: 'Enviar',
                        cssClass: 'btn-primary',
                        action: function()
                        { if( $('#npd').val() !='' && $('#f').val()!='' && ($('#io').val()!=0 || ($('#io').val()==0 && $('#oio').val()!='')) && $('#m').val()!='' )
                          { if ($('#oio').val()!='')
                            {   $.ajax({
                                  type:"POST",
                                  url: base_url+"index.php/User/actualizaPremios",
                                  data:{	'id': id,
                                          'npd': $('#npd').val(),
                                          'f': $('#f').val(),
                                          'io':0,
                                          'm': $('#m').val(),
                                          'oio': $('#oio').val(),
                                          'ins': $('#oio').val()// es para agregar la otra Institucion
                                        },
                                  success: function() {
                                    location.reload();
                                  }
                                });
                            }
                            else
                            { $.ajax({
                                  type:"POST",
                                  url: base_url+"index.php/User/actualizaPremios",
                                  data:{	'id': id,
                                          'npd': $('#npd').val(),
                                          'f': $('#f').val(),
                                          'io':$('#io').val(),
                                          'm': $('#m').val(),
                                          'oio': $('#oio').val()
                                        },
                                  success: function() {
                                    location.reload();
                                  }
                                });
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
  });
  $('#delete').click(function(){
    var id= $('#id_p').val();
    if(id!='')
    {
      BootstrapDialog.show({
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
                    {	window.location= base_url+"index.php/User/deletePremios/" + id;
                    }
                  }]
      });
    }
    else
    {	$(".error").show();
    }
  });
});
