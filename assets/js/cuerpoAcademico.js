var base_url = $('#base_url').val();
$(document).ready(function(){
  $('#modificarCA').click(function() {
    var idCA = $('#tablaCA tr:nth-child(1) td:nth-child(1)').text();
    console.log('aaa'+isNaN(idCA));
    if(isNaN(idCA)){
      BootstrapDialog.show({
            message: $('<div></div>').load(base_url+'index.php/User/formCuerpoAcademicoA'),
            type: BootstrapDialog.TYPE_SUCCESS,
            title: 'Unirse a un Cuerpo Académico',
            buttons: [{
                  id: 'btnAcepNuevoCA',
                  label: 'Enviar',
                  cssClass: 'btn-success',
                  action: function() {
                  }
              }, {
                id: 'btnCanNuevoCA',
                label: 'Cancelar',
                cssClass: 'btn-danger',
                action: function(dialog){
                     dialog.close();
                }
             }]
        });
    } else{
      alertPrincipal();
    }
  });

  $('#eliminarCA').click(function() {
    BootstrapDialog.confirm({
            title: '¡Atención!',
            message: '¿Estás seguro que desea eliminar su Cuerpo Académico?',
            type: BootstrapDialog.TYPE_DANGER,
            closable: true,
            btnCancelLabel: 'No',
            btnOKLabel: 'Sí',
            btnOKClass: 'btn-danger',
            callback: function(result) {
                if(result) {
                    var idCA = $('#tablaCA tr:nth-child(1) td:nth-child(1)').text();
                    console.log(idCA);
                    location.href = base_url+'index.php/User/elimCuerpo';
                }
            }
        });
  });
});


 function alertPrincipal(){
  BootstrapDialog.show({
        message: $('<div></div>').load(base_url+'index.php/User/formCuerpoAcademico'),
        title: 'Cuerpo Académico',
        buttons: [{
              id: 'btnAcepCA',
              label: 'Enviar',
              cssClass: 'btn-primary',
              action: function() {
              }
          }, {
            id: 'btnCancCA',
            label: 'Cancelar',
            cssClass: 'btn-danger',
            action: function(dialog){
                 dialog.close();
            }
         }]
    });
}
