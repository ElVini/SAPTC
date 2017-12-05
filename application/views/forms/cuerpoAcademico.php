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
        <label>Grado: </label>
        <input type="text" name="grado" id="grado" class="form-control">
    </div>
  </div>
</form>

<script type="text/javascript">
$(document).ready(function(){
  //<?php //echo base_url('index.php/User/modCuerpo') ?>
  var base_url = $('#base_url').val();
  var idCA = $('#tablaCA tr:nth-child(1) td:nth-child(1)').text();
  if(!isNaN(idCA)){
    console.log("modificar");
    $('#cuerpoAcadForm').attr("action", base_url+'index.php/User/modCuerpo');
    document.getElementById('idca').value = idCA;
    document.getElementById('nombre').value = $('#tablaCA tr:nth-child(1) td:nth-child(2)').text();
    document.getElementById('clave').value = $('#tablaCA tr:nth-child(1) td:nth-child(3)').text();
    document.getElementById('grado').value = $('#tablaCA tr:nth-child(1) td:nth-child(4)').text();

    $('#btnAcepCA').click(function(){
      if($('#nombre').val() != "" && $('#clave').val() != "" && $('#grado').val() != ""){
        $('#cuerpoAcadForm').submit();
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
  }
  else{
    console.log("agregar");
    $('#cuerpoAcadForm').attr("action", base_url+'index.php/User/agCuerpoN');
    $('#btnAcepCA').click(function(){
      if($('#nombre').val() != "" && $('#clave').val() != "" && $('#grado').val() != ""){
        $('#cuerpoAcadForm').submit();
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
  }
});
</script>
