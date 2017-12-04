function modificar(event) {
    event.preventDefault();
    BootstrapDialog.show({
        title: '<h4>Aviso<h4>',
        message: 'Sólo algunos elementos están disponibles para su modificación, si necesita cambiar otros, contacte al soporte del sistema.',
        type: BootstrapDialog.TYPE_PRIMARY,
        buttons: [{
            label: 'Aceptar',
            cssClass: 'btn btn-primary',
            action: function(dialogItself) {
                dialogItself.close();
                $("#btnMod").remove();
                $("#rfc").removeAttr('disabled');
                $("#ecivil").removeAttr('disabled');
                $("#telt").removeAttr('disabled');
                $("#telc").removeAttr('disabled');
                $("#telp").removeAttr('disabled');
                $("#email").removeAttr('disabled');
                $("#botones").append('<button class="btn btn-danger" id="btnCancel" onclick="cancelar(event);">Cancelar</button> <button class="btn btn-primary" id="btnCancel" onclick="guardar(event);">Guardar</button>');
            }
        }]
    });
}

function guardar(event) {
    event.preventDefault();
    if($("#rfc").val() == '' || $("#ecivil").val() == '0' || $("#telt").val() == '' || $("#telc").val() == '' || $("#telp").val() == '') {
        BootstrapDialog.show( {
            title: 'Error',
            type: BootstrapDialog.TYPE_WARNING,
            message: 'Favor de llenar todos los campos',
            buttons: [{
                label: 'Aceptar',
                cssClass: 'btn btn-warning',
                action: function(dialogItself) {
                    dialogItself.close();
                }
            }]
        });
    }
    else {
        $("#formDatos").submit();
    }
}

function cancelar(event) {
    event.preventDefault();
    location.reload();
}
