$(document).ready(function(){

    $('td:not(#detalles)').click(function(){
      //cuando ya tiene la clase
      if($(this).parent().attr('class') == 'highlight'){
        $(this).parent().removeClass('highlight');
      }
      //cuando no la tiene la asigna al tr y la elimina de los demas
      else{
        if($(this).parent().attr('id') != 'nohay')
        {
          $(this).parent().addClass('highlight').siblings().removeClass('highlight');
          $(".DivELetrasrojas").hide('slow');
        }
      }
    });
    //remueve el highlight de todos los tr cuando se le pica a la etiqueta a
    $('#detalles a').click(function(){
      $('tr').removeClass('highlight');
    });



    function AgregarEstudio(){
      BootstrapDialog.show({
        size: BootstrapDialog.SIZE_WIDE,
        title: 'Agregar Estudio',
        message: $(`<div class="clearfix"></div>`).load(base_url+'index.php/User/ERform/0/0'),
        buttons: [
        {
            label: 'Cancelar',
            cssClass: 'btn-danger',
            id: 'btnModalCancelar',
            action: function(dialogItself){
              //alert($('#NivelEst').val());
                dialogItself.close();
            }
        },
        {
            label: 'Guardar',
            cssClass: 'btn-primary',
            action: function(dialogItself){

              //por si de repente cambio estado, que no se suba ese valor
              if($('#estadoER').val() == 'En Progreso'){
                $('#FechaFinalizado').val('');
                $('#FechaObtenido').val('');
              }
              if($('#estadoER').val() == 'Finalizado'){
                $('#FechaObtenido').val('');
              }

              if($('#NivelEst').val() != "" && CaracteresValidosER($('#NivelEst').val()) &&
                 $('#siglas').val() != "" && CaracteresValidosER($('#siglas').val()) &&
                 $('#EstdiosEn').val() != "" && CaracteresValidosER($('#EstdiosEn').val()) &&
                 $('#Area').val() != "" && CaracteresValidosER($('#Area').val()) &&
                 $('#Discip').val() != "" && CaracteresValidosER($('#Discip').val()) &&
                 $('#otraInstit').val() != "" && CaracteresValidosER($('#otraInstit').val()) &&
                 // $('#FechaIni').val() != "" && CaracteresValidosER($('#FechaIni').val()) &&
                 // $('#FechaFin').val() != "" && CaracteresValidosER($('#FechaFin').val()) &&
                 // $('#FechaObt').val() != "" && CaracteresValidosER($('#FechaObt').val()) &&
                 $('#pais').val() != "" && CaracteresValidosER($('#pais').val()) &&
                 ($('#estadoER').val() == 'En Progreso' && $('#FechaIni').val() != "") ||
                 ($('#estadoER').val() == 'Finalizado\\Por obtener' && $('#FechaIni').val() != "" && $('#FechaFin').val() != "") ||
                 ($('#estadoER').val() == 'Obtenido' && $('#FechaIni').val() != "" && $('#FechaFin').val() != "" && $('#FechaObt').val() != "" && document.getElementById("PDFInputModal").files.length > 0)
                ){

                  var file_extension = document.getElementById('PDFInputModal').value.split('.').pop();
                  if(($('#estadoER').val() == 'Obtenido' && (file_extension=='pdf'||file_extension=='png'||file_extension=='jpg'||file_extension=='jpeg')) || $('#estadoER').val() == 'Finalizado\\Por obtener' || $('#estadoER').val() == 'En Progreso')
                  {
                  //////////////
                   BootstrapDialog.show({
                           title: '¿Seguro?',
                           message: '¿Esta seguro que desea agregar estos estudios?',
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

                                 var BInstit = ($('#selectInstit').val() == "Otra")?1:0;
                                 $('#BInstit').val(BInstit);
                                 //se agrega si es 1

                                 $('.btnSi').prop('disabled', true);
                                 $('#formER').submit();
                                   //location.reload();
                                   // PONLO CUANDO LE DES OK AL agregado correctamente
                                   dialog.close();
                                   dialogItself.close();
                               }
                           }
                         ]
                       });
                       /////////////////////
                     }


               }else{

                 if(
                   $('#NivelEst').val() == "" ||
                   $('#siglas').val() == "" ||
                   $('#EstdiosEn').val() == "" ||
                   $('#Area').val() == "" ||
                   $('#Discip').val() == "" ||
                   $('#otraInstit').val() == "" ||
                   $('#FechaIni').val() == "" ||
                   $('#FechaFin').val() == "" ||
                   $('#FechaObt').val() == "" ||
                   $('#pais').val() == ""
                 )
                   {
                          alert('Por favor llene todos los campos');
                   }else
                      if(
                        !CaracteresValidosER($('#NivelEst').val()) ||
                        !CaracteresValidosER($('#siglas').val()) ||
                        !CaracteresValidosER($('#EstdiosEn').val()) ||
                        !CaracteresValidosER($('#Area').val()) ||
                        !CaracteresValidosER($('#Discip').val()) ||
                        !CaracteresValidosER($('#otraInstit').val()) ||
                        !CaracteresValidosER($('#FechaIni').val()) ||
                        !CaracteresValidosER($('#FechaFin').val()) ||
                        !CaracteresValidosER($('#FechaObt').val()) ||
                        !CaracteresValidosER($('#pais').val())
                      )
                         {
                            alert('Por favor solo ingrese caracteres validos');
                         }else {
                           if(document.getElementById("PDFInputModal").files.length < 1)
                           {
                             alert('Por favor suba un archivo');
                           }else {
                             if(file_extension!='pdf'&&file_extension!='png'&&file_extension!='jpg'&&file_extension!='jpeg')
                             {
                               alert('Ingrese un archivo con una de las extensiones permitidas');
                             }
                           }
                         }
               }
            }
        }
      ]

      });
    }
    function ModificarEstudio(idERD){
      BootstrapDialog.show({
        size: BootstrapDialog.SIZE_WIDE,
        title: 'Modificar Estudio',
        message: $(`<div class="clearfix"></div>`).load(base_url+'index.php/User/ERform/'+idERD+'/0'),
        buttons: [
        {
            label: 'Cancelar',
            cssClass: 'btn-danger',
            id: 'btnModalCancelar',
            action: function(dialogItself){
                //le da a cancelar
                dialogItself.close();
            }
        },
        {
            label: 'Guardar',
            cssClass: 'btn-primary',
            action: function(dialogItself){

              if($('#estadoER').val() == 'En Progreso'){
                $('#FechaFinalizado').val('');
                $('#FechaObtenido').val('');
              }
              if($('#estadoER').val() == 'Finalizado'){
                $('#FechaObtenido').val('');
              }

              if($('#NivelEst').val() != "" && CaracteresValidosER($('#NivelEst').val()) &&
                 $('#siglas').val() != "" && CaracteresValidosER($('#siglas').val()) &&
                 $('#EstdiosEn').val() != "" && CaracteresValidosER($('#EstdiosEn').val()) &&
                 $('#Area').val() != "" && CaracteresValidosER($('#Area').val()) &&
                 $('#Discip').val() != "" && CaracteresValidosER($('#Discip').val()) &&
                 $('#otraInstit').val() != "" && CaracteresValidosER($('#otraInstit').val()) &&
                 // $('#FechaIni').val() != "" && CaracteresValidosER($('#FechaIni').val()) &&
                 // $('#FechaFin').val() != "" && CaracteresValidosER($('#FechaFin').val()) &&
                 // $('#FechaObt').val() != "" && CaracteresValidosER($('#FechaObt').val()) &&
                 $('#pais').val() != "" && CaracteresValidosER($('#pais').val()) &&
                 (
                 ($('#estadoER').val() == 'En Progreso' && $('#FechaIni').val() != "") ||
                 ($('#estadoER').val() == 'Finalizado\\Por obtener' && $('#FechaIni').val() != "" && $('#FechaFin').val() != "") ||
                 ($('#estadoER').val() == 'Obtenido' && $('#FechaIni').val() != "" && $('#FechaFin').val() != "" && $('#FechaObt').val() != "" && (typeof $('#ELEGIR').val() == 'undefined'
                 || $('#ELEGIR').val() == "No")) ||
                 ($('#estadoER').val() == 'Obtenido' && $('#FechaIni').val() != "" && $('#FechaFin').val() != "" && $('#FechaObt').val() != "" && (typeof $('#ELEGIR').val() == 'undefined'
                 || $('#ELEGIR').val() == "Sí")
                  && document.getElementById('PDFInputModal').value != 0)
                )
                ){

                  if(document.getElementById('PDFInputModal') != null && document.getElementById('PDFInputModal').files.length > 0)
                  {
                    var file_extension = document.getElementById('PDFInputModal').value.split('.').pop();
                  }
                  alert(file_extension);
                  if(($('#estadoER').val() == 'Obtenido' && ((typeof $('#ELEGIR').val() == 'undefined' || $('#ELEGIR').val() == "No") || ((typeof $('#ELEGIR').val() == 'undefined'
                  || $('#ELEGIR').val() == "Sí")&&(file_extension=='pdf'||file_extension=='png'||file_extension=='jpg'||file_extension=='jpeg'))))
                   || $('#estadoER').val() == 'Finalizado\\Por obtener' || $('#estadoER').val() == 'En Progreso')
                  {
                  //////////////
                   BootstrapDialog.show({
                           title: '¿Seguro?',
                           message: '¿Esta seguro que desea modificar este estudio?',
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

                                 var BInstit = ($('#selectInstit').val() == "Otra")?1:0;
                                 $('#BInstit').val(BInstit);
                                 //se agrega si es 1

                                 $('.btnSi').prop('disabled', true);
                                 $('#formER').submit();
                                   //location.reload();
                                   dialog.close();
                                   dialogItself.close();
                               }
                           }
                         ]
                       });
                       /////////////////////
                     }


               }else{

                 if(
                   $('#NivelEst').val() == "" ||
                   $('#siglas').val() == "" ||
                   $('#EstdiosEn').val() == "" ||
                   $('#Area').val() == "" ||
                   $('#Discip').val() == "" ||
                   $('#otraInstit').val() == "" ||
                   $('#FechaIni').val() == "" ||
                   $('#FechaFin').val() == "" ||
                   $('#FechaObt').val() == "" ||
                   $('#pais').val() == "" ||
                   document.getElementById('PDFInputModal').files.length < 1
                 )
                   {
                          alert('Por favor llene todos los campos');
                   }else
                      if(
                        !CaracteresValidosER($('#NivelEst').val()) ||
                        !CaracteresValidosER($('#siglas').val()) ||
                        !CaracteresValidosER($('#EstdiosEn').val()) ||
                        !CaracteresValidosER($('#Area').val()) ||
                        !CaracteresValidosER($('#Discip').val()) ||
                        !CaracteresValidosER($('#otraInstit').val()) ||
                        !CaracteresValidosER($('#FechaIni').val()) ||
                        !CaracteresValidosER($('#FechaFin').val()) ||
                        !CaracteresValidosER($('#FechaObt').val()) ||
                        !CaracteresValidosER($('#pais').val())
                      )
                         {
                            alert('Por favor solo ingrese caracteres validos');
                         }else {
                           if($('#ELEGIR').val() == "Sí" && document.getElementById("PDFInputModal").files.length < 1)
                           {
                             alert('Por favor suba un archivo');
                           }else {

                             if(file_extension!='pdf'&&file_extension!='png'&&file_extension!='jpg'&&file_extension!='jpeg')
                             {
                               alert('Ingrese un archivo con una de las extensiones permitidas (PDF, PNG o JPEG)');
                             }
                           }
                         }
               }
            }
        }
      ]

      });
    }
    function EliminarEstudio(){
      BootstrapDialog.show({
              title: '¿Seguro?',
              message: '¿Esta seguro que desea borrar estos estudios?',
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
                    $.ajax({
                       type:"POST",
                       url:base_url+"index.php/User/EREliminar",
                       data:{
                         'id' : idsER[$('.highlight').data('valor')].id
                       },
                       success:function (data)
                       {
                           // alert('Datos borrados exitosamente');
                       },error:function(jqXHR, textStatus, errorThrown){
                           console.log('error:: '+ errorThrown);
                       }

               });

                    $('.btnSi').prop('disabled', true);
                    location.reload();

                      dialog.close();
                      dialogItself.close();
                  }
              }
            ]
          });
    }
    function Detalles(idERD){

      BootstrapDialog.show({
        size: BootstrapDialog.SIZE_WIDE,
        title: 'Ver Detalles',
        message: $(`<div class="clearfix"></div>`).load(base_url+'index.php/User/ERform/'+idERD+'/1'),
        buttons: [
        {
            label: 'Aceptar',
            cssClass: 'btn-primary',
            id: 'btnModalCancelar',
            action: function(dialogItself){
                dialogItself.close();
            }
        }
      ]
    });

    }
    $('#AgregarB').on('click', function(event) {
       AgregarEstudio();
      });
    $('#ModificarB').on('click', function(event) {
      if($('.highlight').children().length > 0)//si hay algo seleccionado
      {
        ModificarEstudio(idsER[$('.highlight').data('valor')].id);
      }
      });
    $('#EliminarB').on('click', function(event) {
      if($('.highlight').children().length > 0)//si hay algo seleccionado
      {
        EliminarEstudio();
      }

      });
    $('.detallesB').on('click', function(event) {
       Detalles(idsER[$(this).parent().data('valor')].id);
      });



});
function CaracteresValidosER( inputtxt ){
     var letterNumber = /^[0-9a-zA-Z \-_ñáéíóú]+$/;
     if(inputtxt.match(letterNumber)){
        return true;
      }
      else{
        return false;
      }
  }
