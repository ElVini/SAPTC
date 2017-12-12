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
    <div class="col-md-10">
        <label>Nombre de la Dependencia: </label>
        <select class="form-control" name="np" id="np" onclick="otraInstitucion()">
          <option value="">Seleccione una</option>
          <?php if (isset($dependencias)) {
            foreach ($dependencias->result() as $dependencia) {
              echo '<option value="'.$dependencia->idInstituciones.'">'.$dependencia->Nombre.'</option>';
            }
          } ?>
          <option value="-1">Otra...</option>
        </select>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 otro">
        <label for="od" >Otra Dependencia: </label>
        <input type="text" name="od" id="od" class="form-control">
    </div>
  </div>
</form>

<script type="text/javascript">
$('.otro').hide();
$("#idd").val(id);
function otraInstitucion(){
  if($('#np').val() == -1){
    $('.otro').show();
  }
  else if($('#np').val() != -1){
    $('.otro').hide();
    $('#od').val('');
  }
}

if($("#idd").val()!=""){
  $("#nombre").val(nombre);
  $("#pre").val(programae);
  $("#fei").val(fechai);
  $("#noa").val(numa);
  $("#dus").val(durs);
  $("#ham").val(horam);
  $("#hos").val(horas);
  $("#np").val(nombredep);
}

$("#btnAcepD").click(function(){
  if( $("#nombre").val() == "" ||  $("#pre").val() == "" ||  $("#fei").val() == "" ||  $("#noa").val() == "" || $("#dus").val() == "" ||
      $("#ham").val() == "" || $("#hos").val() == "" || ($("#np").val() == "" || ($("#np").val() == -1 && $("#od").val() == "" ))){
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
