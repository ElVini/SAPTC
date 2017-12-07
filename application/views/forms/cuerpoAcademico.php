<form method="post" id="cuerpoAcadForm">
  <div class="row" >
    <div class="col-md-4"  hidden="true">
        <input type="text" name="idca" id="idca" class="form-control">
    </div>
    <div class="col-md-4">
        <label>Nombre: </label>
        <input type="text" name="nombre" id="nombre" class="form-control">
    </div>
    <div class="col-md-4">
        <label>Clave: </label>
        <input type="text" name="clave" id="clave" class="form-control">
    </div>
    <div class="col-md-4">
        <label>Grado de consolidación: </label>
        <select class="form-control" name="grado" id="grado">
            <option value="">Seleccione uno</option>
            <option value="En consolidación">En consolidación</option>
            <option value="Consolidado">Consolidado</option>
        </select>
    </div>
  </div>
</form>

<style>
   .login-dialog .modal-dialog {
        width: 450px;
    }
</style>


<script type="text/javascript">
var acc = 0;
var nombre="", clave="";
$(document).ready(function(){
  var base_url = $('#base_url').val();
  var idCA = $('#tablaCA tr:nth-child(1) td:nth-child(1)').text();
  if(!isNaN(idCA)){
    //1 - es para modificar
    acc=1;
    $('#cuerpoAcadForm').attr("action", base_url+'index.php/User/modCuerpo');
    document.getElementById('idca').value = idCA;
    document.getElementById('nombre').value = $('#tablaCA tr:nth-child(1) td:nth-child(2)').text();
    document.getElementById('clave').value = $('#tablaCA tr:nth-child(1) td:nth-child(3)').text();
    document.getElementById('grado').value = $('#tablaCA tr:nth-child(1) td:nth-child(4)').text();
    nombre = document.getElementById('nombre').value;
    clave = document.getElementById('clave').value;
  }
  else{
    //2 - es para agregar
    acc=2;
    $('#cuerpoAcadForm').attr("action", base_url+'index.php/User/agCuerpoN');
  }
});

$('#btnAcepCA').click(function(){

  if($('#nombre').val() != "" && $('#clave').val() != "" && $('#grado').val() != ""){
    var n = $('#nombre').val();
    var c = $('#clave').val();

    if(acc==1){
      if(nombre == n){
        n=0;
      }
      if(clave == c){
        c=0;
      }
    }

    $.ajax({
        type: "POST",
        url: 'checarCA',
        data: "nombre="+ n + "&clave=" + c+"&accion="+acc,
        cache: false,
        success: function(response)
        {
          if(!isNaN(response)){
            var msj='';
            if(response.indexOf("1") != -1){
              msj = "<br><b>Nombre.</b>";
            }
            if(response.indexOf("2") != -1){
              msj = msj+"<br><b>Clave.</b>";
            }
              BootstrapDialog.show({
                    title: '¡Atención!',
                    cssClass: 'login-dialog',
                    message: 'Ya se encuentra un cuerpo académico con los siguientes datos: '+msj+' <br>Favor de cambiarlos.',
                    type: BootstrapDialog.TYPE_DANGER,
                    closable: true,
                    buttons: [{
                        label: 'Aceptar',
                        cssClass: 'btn-default',
                        action: function(dialog){
                             dialog.close();
                        }
                     }]
                });
          }else{
              $('#cuerpoAcadForm').submit();
          }

        }
    });

  }
  else {
    BootstrapDialog.alert({
          title: '¡Atención!',
          message: 'No ha completado todos los campos.',
          type: BootstrapDialog.TYPE_DANGER,
          closable: true,
          buttonLabel: 'Aceptar',
      });
  }
});
</script>
