<form method="post" id="formDocencia">
  <div class="row" >
    <div class="col-md-4"  hidden="true">
        <input type="text" name="idd" id="idd" class="form-control">
    </div>
    <div class="col-md-10">
        <label>Nombre: </label>
        <input type="text" name="nombre" id="nombre" class="form-control">
    </div>
    <div class="col-md-5">
        <label>Programa educativo: </label>
        <select class="form-control" name="pre" id="pre">
          <option value="">Seleccione una</option>
          <option value="Ing. en Informática">Ing. en Informática</option>
          <option value="Ing. en Nanotecnología">Ing. en Nanotecnología</option>
          <option value="Ing. en Mecatrónica">Ing. en Mecatrónica</option>
          <option value="Ing. en Biomédica">Ing. en Biomédica</option>
          <option value="Ing. en Bioteconología">Ing. en Biotecnología</option>
          <option value="Ing. en Energía">Ing. en Energía</option>
          <option value="Ing. en Teconología Ambiental">Ing. en Tecnología Ambiental</option>
          <option value="Ing. en Animación y Efectos Visuales">Ing. en Animación y Efectos Visuales</option>
          <option value="Ing. en Logística y Transporte">Ing. en Logísitca y Transporte</option>
          <option value="Lic. en Terapia Física">Lic. en Terapía Física</option>
          <option value="Lic. en Administración y Gestión de PyMes">Lic. en Administración y Gestión de PyMes</option>
          <option value="MaestrÍa en Enseñanza de las Ciencas">Maestría en Enseñanza de las Ciencias</option>
          <option value="MaestrÍa en Ciencias Aplicadas">Maestría en Ciencias Aplicadas</option>
        </select>
    </div>
    <div class="col-md-5">
        <label>Fecha de inicio: </label>
        <input type="date" name="fei" id="fei" class="form-control">
    </div>
    <div class="col-md-5">
        <label>No. de alumnos: </label>
        <input type="number" name="noa" min="1" value="1" id="noa" class="form-control">
    </div>
    <div class="col-md-5">
        <label>Duración en semanas: </label>
        <input type="number" name="dus" min="1" value="1" id="dus" class="form-control">
    </div>
    <div class="col-md-5">
        <label>Horas de asesorías mensuales: </label>
        <input type="number" name="ham" min="1" value="1" id="ham" class="form-control">
    </div>
    <div class="col-md-5">
        <label>Horas semanales: </label>
        <input type="number" name="hos" min="1" value="1" id="hos" class="form-control">
    </div>
    <div class="col-md-10"  id="divSelectInstit">
      <label for="selectInstit">Dependencia: </label>
      <select class="form-control" id="selectInstit">
      </select>
    </div>
    <div class="col-md-10" id="divOtraInstit">
      <label for="otraInstit">Escriba otra institucion: </label>
      <div class="input-group">
        <input type="text" class="form-control" placeholder="Ingrese una institucion" name="otrainstit" id="otraInstit">
        <span class="input-group-btn">
          <button class="btn btn-danger" type="button" id="cancelarOtraInstit">X</button>
        </span>
      </div>
  </div>
</form>

<script type="text/javascript">
$("#idd").val(id);
$(document).ready(function(){
  //Instituciones
  $('#divOtraInstit').hide();

  // datos cargados de la BD
  var instituciones = [
    <?php
    foreach ($dependencias->result() as $inst) {
      echo '"'.$inst->Nombre.'",';
    }
     ?>
  ];

  var institucionesid = [
    <?php
    foreach ($dependencias->result() as $id) {
      echo '"'.$id->idInstituciones.'",';
    }
     ?>
  ];

  // poniendo los datos en el select
  $('#selectInstit').append('<option hidden="true">'+'Elija'+'</option>');
  for(var i=0;i<instituciones.length;i++){
    $('#selectInstit').append('<option value = "'+institucionesid[i]+'">'+instituciones[i]+'</option>');
  }
  $('#selectInstit').append('<option>'+'Otra'+'</option>');

  $('#selectInstit').on('change',function(){
    if( $('#selectInstit').val() == "Otra" ){
      $('#otraInstit').val("");
      $('#divSelectInstit').hide();
      $('#divOtraInstit').show();
    }
    else{
      $('#otraInstit').val($('#selectInstit').val());
    }
  });

  $('#cancelarOtraInstit').on('click',function(){
    $('#otraInstit').val("");
    $('#selectInstit').val("Elija");
    $('#divOtraInstit').hide();
    $('#divSelectInstit').show();
  });
  //fin de instituciones

  if($("#idd").val()!=""){
    $("#nombre").val(nombre);
    $("#pre").val(programae);
    $("#fei").val(fechai);
    $("#noa").val(numa);
    $("#dus").val(durs);
    $("#ham").val(horam);
    $("#hos").val(horas);
    console.log(nombredep);
    $("#selectInstit").val(nombredep);
  }
});




$("#btnAcepD").click(function(){
  if( $("#nombre").val() == "" ||  $("#pre").val() == "" ||  $("#fei").val() == "" ||  $("#noa").val() == "" || $("#dus").val() == "" ||
      $("#ham").val() == "" || $("#hos").val() == "" || $("#otraInstit").val() == ""){
        BootstrapDialog.alert({
              title: '¡Atención!',
              message: 'No ha completado todos los campos.',
              type: BootstrapDialog.TYPE_DANGER,
              closable: true,
              buttonLabel: 'Aceptar',
          });
      }
      else{
        if($("#idd").val()==""){
            $('#formDocencia').attr("action", base_url+'index.php/User/agrDocencia');
        }else{
            $('#formDocencia').attr("action", base_url+'index.php/User/mdDocencia');
        }
        $("#formDocencia").submit();
      }
});

</script>
