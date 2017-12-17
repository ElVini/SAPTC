<script type="text/javascript" src="<?php echo base_url('assets/js/popper.min.js') ?>"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/styles/bootstrap.min.css') ?>">
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>

<div class="row">
  <div class="col-md-12">

    <form id="formER" action="ERAgregar" method="post" enctype="multipart/form-data">

      <label>Nivel de Estudios</label>
      <input type="text" name="nivel" id="NivelEst" class="form-control">
      <label>Siglas del estudio</label>
      <input type="text" name="siglas" id="siglas" class="form-control">
      <label>Estudios en</label>
      <input type="text" name="estudiosen" id="EstdiosEn" class="form-control">
      <label>Área</label>
      <input type="text" name="area" id="Area" class="form-control">
      <label>Disciplina</label>
      <input type="text" name="disciplina" id="Discip" class="form-control">
      <div class="form-group">

        <div id="divSelectInstit">
          <label for="selectInstit">Seleccione una institucion: </label>
          <select class="form-control" id="selectInstit">
          </select>
        </div>
        <div id="divOtraInstit">
          <label for="otraInstit">Escriba otra institucion: </label>
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Ingrese una institucion" name="otrainstit" id="otraInstit">
            <span class="input-group-btn">
              <button class="btn btn-danger" type="button" id="cancelarOtraInstit">X</button>
            </span>
          </div>
        </div>
      </div>

      <label>País</label>
      <input type="text" name="pais" id="pais" class="form-control">

      <label>Estado</label>
      <select class="form-control" id="estadoER" name="estadoER">
        <option>En Progreso</option>
        <option>Finalizado\Por obtener</option>
        <option>Obtenido</option>
      </select>

      <div id="FechaIniciado">
        <label>Iniciado el</label>
        <input type="date" name="fechainicio" id="FechaIni" class="form-control">
      </div>
      <div id="FechaFinalizado">
        <label>Finalizado el<br></label>
        <input type="date" name="fechafin" id="FechaFin" class="form-control">
      </div>
      <div id="FechaObtenido">
        <label>Obtenido el</label>
        <input type="date" name="fechaobt" id="FechaObt" class="form-control">
        <label>Documento (PDF, PNG o JPEG)</label>
        <input id="PDFInputModal" name="PDFInputModal" type="file" accept=".pdf,.png,.jpg,.jpeg">

      </div>

      <input type="hidden" name="BInstit" id="BInstit">

    </form>
  </div>
</div>

<script type="text/javascript">
$(document).ready(function() {
  $('#divOtraInstit').hide();

  // datos cargados de la BD
  var instituciones = [
    <?php
    foreach ($instituciones->result() as $inst) {
      echo '"'.$inst->Nombre.'",';
    }
     ?>
  ];

  // poniendo los datos en el select
  $('#selectInstit').append('<option hidden="true">'+'Elija'+'</option>');
  for(var i=0;i<instituciones.length;i++){
    $('#selectInstit').append('<option>'+instituciones[i]+'</option>');
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

  // $('#FechaIniciado').hide();
  $('#FechaFinalizado').hide();
  $('#FechaObtenido').hide();

  // <select class="form-control" id="estadoER">
  //   <option>En Progreso</option>
  //   <option>Finalizado\Por obtener</option>
  //   <option>Obtenido</option>
  // </select>

  $('#estadoER').on('change',function(){
    if( $('#estadoER').val() == "En Progreso" ){
      $('#FechaIniciado').show();
      $('#FechaFinalizado').hide();
      $('#FechaObtenido').hide();
    }
    if( $('#estadoER').val() == "Finalizado\\Por obtener" ){
      $('#FechaIniciado').show();
      $('#FechaFinalizado').show();
      $('#FechaObtenido').hide();
    }
    if( $('#estadoER').val() == "Obtenido" ){
      $('#FechaIniciado').show();
      $('#FechaFinalizado').show();
      $('#FechaObtenido').show();
    }

  });

});
</script>
