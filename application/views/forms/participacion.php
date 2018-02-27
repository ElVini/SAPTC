<?php
if(isset($data))
{ foreach  ($data->result() as $datos)
  {?><script type="text/javascript">
      $('#programa option[value="<?= $datos->Programaeducativo ?>"]').attr('disabled',true);
    </script><?php
  }
}
if (isset($user))
{ foreach ($user->result() as $row)
  { ?><script type='text/javascript'>
            $('#programa').val('<?= $row->Programaeducativo?>');
            $('#fechacambio').val('<?= $row->Fechaimplementacion?>');
            $('#grado').val('<?= $row->Grado_idGrado?>');
            $('#des').val('<?= $row->Descripcion?>');
            $('#archivodiv').hide();
            var accion= base_url+'index.php/User/actualizaParticipacion/'+$('#id_p').val();
            $('#formu').attr('action', accion);
            $('#programa option[value="<?= $row->Programaeducativo ?>"]').attr('disabled',false);
      </script><?php
  }
}
else{
  echo "<script type='text/javascript'>
          $('#opcion').hide()
          var accion= base_url + 'index.php/User/agregarParticipacion';
          $('#formu').attr('action', accion);
        </script>";
}
if ( $grado!= null)
 echo "<script type='text/javascript'>
         $('.otra').hide();
         $('.primera').show();
        </script>";
else
  echo "<script type='text/javascript'>
         $('.otra').show();
         $('.primera').hide();
        </script>";
?>
<input type="text" hidden name="pro" value="" id="pro">
<form method="post" action="" enctype="multipart/form-data" id="formu">
  <div class="row">
    <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
      <label for="programa">Nombre del programa educativo: </label>
      <select class="form-control" id="programa" name="programa">
        <option value="">Seleccione...</option>
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
    <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
      <label for="fechacambio">Fecha de implementación del cambio: </label>
      <input class="form-control" type="date" name="fechacambio" id="fechacambio">
    </div>
  </div>
  <div class="row primera">
    <div class="form-group col-lg-12">
      <label for="grado">Grado de intervención: </label>
      <select class="form-control" id="grado" name="grado" onclick="otroGrado()">
        <option value="">Seleccione...</option>
        <?php
          if ( $grado!=null)
          {
          foreach ($grado->result() as $row){  ?>
            <option value='<?= $row->idGrado?>'><?= $row->nombre ?></option>
       <?php } }
        ?>
        <option value='0'>Otra...</option>
      </select>
    </div>
  </div>
  <div class="row otra">
    <div class="form-group col-lg-12">
        <label for="og">Grado de intervención: </label>
        <div class="input-group">
          <input type="text" name="og" id="og" class="form-control" maxlength="45">
          <span class="input-group-btn">
            <button class="btn btn-danger" type="button" id="canceloo">X</button>
          </span>
        </div>
    </div>
  </div>
  <div class="row">
    <div class="form-group col-lg-12 ">
      <label for="des">Descripción: </label>
      <textarea class="form-control" name="des" maxlength="100" style="max-width: 570px; max-height: 100px;" id="des"></textarea>
    </div>
  </div>
  <div class="file">
    <?php
    if (isset($user))
    {
    foreach ($user->result() as $row)
      {
        echo '<a href="'.base_url().'index.php/User/archivo/'.$row->idParticipacion.'" target="_blank" >Abrir archivo</a>';
      }
    }
    ?>
  </div>
  <div class="row" id="opcion">
    <div class="form-group col-lg-12">
      <label for="opc">¿Desea sustituir el documento?</label>
      <select class="form-control" name="opc" id="opc" onclick="respuesta()">
        <option value="0">No</option>
        <option value="1">Si</option>
      </select>
    </div>
  </div>
  <div class="row">
    <div class="form-group col-lg-12 " id="archivodiv">
        <label class="control-label" for="archivo">Resumen del proyecto (PDF):</label>
          <input id="archivo" type="file" style="display:none" name="archivo"  accept=".pdf">
          <div class="input-append">
            <button type="button" class="btn btn-file btn btn-secondary"><i class="glyphicon glyphicon-level-up"></i>Seleccionar</button>
            <!--<input id="falso1" class="input-xlarge" type="text" name="falso1">-->
            <span id="muestra">

            </span>
          </div>
    </div>
    <!-- El input normal 'menos estetico'
    <div class="form-group col-lg-12" id="archivodiv">
        <input type="file" name="archivo" accept=".pdf" id="archivo">
    </div>-->

  </div>
</form>

<script type="text/javascript">
function respuesta()
{ if($('#opc').val()!=0)
    $('#archivodiv').show();
  else
    $('#archivodiv').hide();
}
$(document).ready(function(){
  $("#canceloo").on('click', function(event) {
    <?php if ( $grado!=null){?>
      $('.primera').show();
      $('.otra').hide();
    <?php }else { ?>
      $('.otra').show();
      $('.primera').hide();
    <?php } ?>
    $('#grado, #og').val('');
  });
  $('.btn-file').on('click', function(){
    $(this).parent().prev().click();
  });
  $('input[type=file]').on('change', function(e){
  //$(this).next().find('input').val($(this).val());
  $("#muestra").html($('#archivo').val().split('C:\\fakepath\\'));
  });
});
</script>
