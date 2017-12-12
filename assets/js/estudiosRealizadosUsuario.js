$(document).ready(function(){

    $('td:not(#detalles)').click(function(){
      //cuando ya tiene la clase
      if($(this).parent().attr('class') == 'highlight'){
        $(this).parent().removeClass('highlight');
      }
      //cuando no la tiene la asigna al tr y la elimina de los demas
      else{
        $(this).parent().addClass('highlight').siblings().removeClass('highlight');
        $(".DivELetrasrojas").hide('slow');
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
        message: $(`<div class="clearfix"></div>`).load(base_url+'index.php/User/ERform/2'),
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

              if($('#NivelEst').val() != "" && CaracteresValidosER($('#NivelEst').val()) &&
                 $('#siglas').val() != "" && CaracteresValidosER($('#siglas').val()) &&
                 $('#EstdiosEn').val() != "" && CaracteresValidosER($('#EstdiosEn').val()) &&
                 $('#Area').val() != "" && CaracteresValidosER($('#Area').val()) &&
                 $('#Discip').val() != "" && CaracteresValidosER($('#Discip').val()) &&
                 $('#otraInstit').val() != "" && CaracteresValidosER($('#otraInstit').val()) &&
                 $('#FechaIni').val() != "" && CaracteresValidosER($('#FechaIni').val()) &&
                 $('#FechaFin').val() != "" && CaracteresValidosER($('#FechaFin').val()) &&
                 $('#FechaObt').val() != "" && CaracteresValidosER($('#FechaObt').val()) &&
                 $('#pais').val() != "" && CaracteresValidosER($('#pais').val())
                ){
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
                                 //se agrega si es 1

                                 $.ajax({
                                    type:"POST",
                                    url:base_url+"index.php/User/ERAgregar",
                                    data:{
                                      'nivel' : $('#NivelEst').val(),
                                      'siglas' : $('#siglas').val(),
                                      'estudiosen' : $('#EstdiosEn').val(),
                                      'area' : $('#Area').val(),
                                      'disciplina' : $('#Discip').val(),
                                      'otrainstit' : $('#otraInstit').val(),
                                      'BInstit' : BInstit,
                                      'fechainicio' : $('#FechaIni').val(),
                                      'fechafin' : $('#FechaFin').val(),
                                      'fechaobt' : $('#FechaObt').val(),
                                      'pais' : $('#pais').val()
                                    },
                                    success:function (data)
                                    {
                                        alert('Datos agregados correctamente');
                                        //location.reload();
                                    },error:function(jqXHR, textStatus, errorThrown){
                                        console.log('error:: '+ errorThrown);
                                    }

                            });

                                 $('.btnSi').prop('disabled', true);
                                   //location.reload();
                                   // PONLO CUANDO LE DES OK AL agregado correctamente
                                   dialog.close();
                                   dialogItself.close();
                               }
                           }
                         ]
                       });
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
                         }
               }
            }
        }
      ]

      });
    }
    function ModificarEstudio(){
      BootstrapDialog.show({

        title: 'Modificar Estudio',
        message: $(`
          <form>
            <div class="row"><div class="form-group col-md-12">
              <label for="TiposInputModal">Seleccione un tipo</label>
              <select class="form-control" name="TiposInputModal" id="TiposInputModal"></select>
              <label for="TituloInputModal">Titulo:</label>
              <input value="`+tituloAce+`" type="text" name="ModalTitulo" id="TituloInputModal" class="form-control">
              <label for="AutorInputModal">Autor:</label>
              <input value="`+autorAce+`" type="text" name="ModalAutor" id="AutorInputModal" class="form-control">
              <label for="EditorialInputModal">Editorial:</label>
              <input value="`+editorialAce+`" type="text" name="ModalEditorial" id="EditorialInputModal" class="form-control">
              <label for="AnoInputModal">Año:</label>
              <input maxlength="4" min="2012" type="number"  value="`+anoAce+`"type="text"name="ModalAno"id="AnoInputModal"class="form-control">
              <input hidden value="`+idAcervo+`"name="ModalId" id="IdInputModal" type="text">
            </div>
          </div>
          </form>
          `),
        buttons: [
        {
            label: 'Cancelar',
            cssClass: 'btn-danger',
            id: 'btnModalCancelar',
            action: function(dialogItself){

                dialogItself.close();
            }
        },
        {
            label: 'Guardar',
            cssClass: 'btn-primary',
            action: function(dialogItself){

              if(true
                ){
                   BootstrapDialog.show({
                           title: '¿Seguro?',
                           message: '¿Esta seguro que desea efectuar este cambio?',
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

                                 //$('.btnSi').prop('disabled', true);
                                 cargarTabla();
                                   dialog.close();
                                   dialogItself.close();
                               }
                           }
                         ]
                       });
               }else{

                 if(false)
                   {
                          alert('Por favor llene todos los campos');
                   }else
                      if(false)
                         {
                            alert('Por favor solo ingrese caracteres validos');
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
                         'id' : idsER[$('.highlight').data('valor')]
                       },
                       success:function (data)
                       {
                           alert('Datos borrados exitosamente');
                       },error:function(jqXHR, textStatus, errorThrown){
                           console.log('error:: '+ errorThrown);
                       }

               });

                    $('.btnSi').prop('disabled', true);
                      //location.reload();
                      // PONLO CUANDO LE DES OK AL agregado correctamente
                      dialog.close();
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

      });
    $('#EliminarB').on('click', function(event) {
      if($('.highlight').children().length > 0){
        EliminarEstudio();
      }

      });
    $('#DatallesB').on('click', function(event) {

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
