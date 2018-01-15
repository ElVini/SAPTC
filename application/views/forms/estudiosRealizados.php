<script type="text/javascript" src="<?php echo base_url('assets/js/popper.min.js') ?>"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/styles/bootstrap.min.css') ?>">
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>

<div class="row">
  <div class="col-md-12">

    <form id="formER" action="<?php if($datos == null){echo 'ERAgregar';} else {echo 'ERModificar';} ?>" method="post" enctype="multipart/form-data">

      <label>Nivel de Estudios</label>
      <input <?php if($disabled == 1){echo 'disabled="disabled"';} if($datos != null){echo ' value="'.$datos->Nivelestudios.'"';} ?> type="text" name="nivel" id="NivelEst" class="form-control">
      <label>Siglas del estudio</label>
      <input <?php if($disabled == 1){echo 'disabled="disabled"';} if($datos != null){echo ' value="'.$datos->Siglas.'"';} ?> type="text" name="siglas" id="siglas" class="form-control">
      <label>Estudios en</label>
      <input <?php if($disabled == 1){echo 'disabled="disabled"';} if($datos != null){echo ' value="'.$datos->Estudiosen.'"';} ?> type="text" name="estudiosen" id="EstdiosEn" class="form-control">
      <label>Área</label>
      <input <?php if($disabled == 1){echo 'disabled="disabled"';} if($datos != null){echo ' value="'.$datos->Area.'"';} ?> type="text" name="area" id="Area" class="form-control">
      <label>Disciplina</label>
      <input <?php if($disabled == 1){echo 'disabled="disabled"';} if($datos != null){echo ' value="'.$datos->Disciplina.'"';} ?> type="text" name="disciplina" id="Discip" class="form-control">
      <div class="form-group">

        <div id="divSelectInstit">
          <label for="selectInstit">Institucion: </label>
          <select <?php if($disabled == 1){echo 'disabled="disabled"';}?> class="form-control" id="selectInstit">
          </select>
        </div>
        <div id="divOtraInstit">
          <label for="otraInstit">Escriba otra institucion: </label>
          <div class="input-group">
            <input <?php if($disabled == 1){echo 'disabled="disabled"';} ?> type="text" class="form-control" placeholder="Ingrese una institucion" name="otrainstit" id="otraInstit">
            <span class="input-group-btn">
              <button class="btn btn-danger" type="button" id="cancelarOtraInstit">X</button>
            </span>
          </div>
        </div>
      </div>

      <label>País</label>
      <input <?php if($disabled == 1){echo 'disabled="disabled"';} if($datos != null){echo ' value="'.$datos->Pais.'"';} ?> type="text" name="pais" id="pais" class="form-control">

      <label>Estado</label>
      <select <?php if($disabled == 1){echo 'disabled="disabled"';} ?> class="form-control" id="estadoER" name="estadoER">
        <option>En Progreso</option>
        <option>Finalizado\Por obtener</option>
        <option>Obtenido</option>
      </select>

      <div id="FechaIniciado">
        <label>Iniciado el</label>
        <input <?php if($disabled == 1){echo 'disabled="disabled"';} if($datos != null){echo ' value="'.$datos->Fechadeinicio.'"';} ?> type="date" name="fechainicio" id="FechaIni" class="form-control">
      </div>
      <div id="FechaFinalizado">
        <label>Finalizado el<br></label>
        <input <?php if($disabled == 1){echo 'disabled="disabled"';} if($datos != null){echo ' value="'.$datos->Fechadefin.'"';} ?> type="date" name="fechafin" id="FechaFin" class="form-control">
      </div>
      <div id="FechaObtenido">
        <label>Obtenido el</label>
        <input <?php if($disabled == 1){echo 'disabled="disabled"';} if($datos != null){echo ' value="'.$datos->Fechadeobtencion.'"';} ?> type="date" name="fechaobt" id="FechaObt" class="form-control">

        <?php
        if($datos == null && $disabled != 1) echo '
        <label>Documento (PDF, PNG o JPEG)</label>
        <input id="PDFInputModal" name="PDFInputModal" type="file" accept=".pdf,.png,.jpg,.jpeg">
        ';

        if($datos != null && $datos->PDF == "" && $disabled != 1) echo '
        <label>Documento (PDF, PNG o JPEG)</label>
        <input id="PDFInputModal" name="PDFInputModal" type="file" accept=".pdf,.png,.jpg,.jpeg">
        ';

        $dir = "";
        if($datos != null && $datos->PDF != "")
        {
          $dir = $datos->PDF;
          echo '
          <br><a href="'.base_url().'index.php/User/descargarEstudio/'.$datos->idEstudiosrealizados.'" target="_blank">Abrir archivo</a><br><br>';
        }

        if($datos != null && $datos->PDF != ""  && $disabled != 1) echo '
        <label>¿Desea sustituir el documento?</label>
        <select id="ELEGIR" class="form-control" name="sustituir">
          <option>No</option>
          <option>Sí</option>
        </select>
        <div id="sustit"></div>
        ';


        ?>

      </div>

      <input type="hidden" id="BInstit" name="BInstit" value="">
      
      <?php
      if ($datos != null && $disabled !=1)
      {
        echo '<input id="idER" type="hidden" name="id" value="'.$datos->idEstudiosrealizados.'">';
      }
       ?>


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

  $('#FechaFinalizado').hide();
  $('#FechaObtenido').hide();

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

  <?php
  if($datos != null)
  {
    $instit='';
      if($datos->Institucion == 'Otra')
      {
        $instit=$datos->Institucionnoconsiderada;
      }
      else
      {
        $instit=$datos->Institucion;
      }
      echo ' $("#selectInstit").val("'.$instit.'");';
      echo ' $("#otraInstit").val("'.$instit.'");';

      if($datos->EstadoEstudio == 'En Progreso')
      {
        echo ' $("#estadoER").val("'.$datos->EstadoEstudio.'");';
      }
      if($datos->EstadoEstudio == 'Finalizado\Por obtener')
      {
        echo ' $("#estadoER").val("Finalizado\\\Por obtener");';
      }
      if($datos->EstadoEstudio == 'Obtenido')
      {
        echo ' $("#estadoER").val("'.$datos->EstadoEstudio.'");';
      }
    }
   ?>
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

    var inputGrupo = document.createElement("div");
    var label = document.createElement("label");
    label.innerHTML = "Sustituir documento (PDF, PNG o JPEG)"
    var br2 = document.createElement("br");
    var input = document.createElement("input");
    input.setAttribute("type","file");
    input.setAttribute("id","PDFInputModal");
    input.setAttribute("name","PDFInputModal");
    input.setAttribute("accept",".pdf,.png,.jpg,.jpeg");
    inputGrupo.appendChild(label);
    inputGrupo.appendChild(br2);
    inputGrupo.appendChild(input);
    $('#ELEGIR').on('change',function(){
      if($('#ELEGIR').val() == "Sí")
      {
        document.getElementById('sustit').appendChild(inputGrupo);
      }
      if($('#ELEGIR').val() == "No")
      {
        document.getElementById('PDFInputModal').value = "";
        document.getElementById('sustit').removeChild(document.getElementById('sustit').childNodes[0]);
      }
    });

});
</script>
