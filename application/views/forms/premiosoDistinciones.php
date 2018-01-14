<?php
if (isset($user))
{ foreach ($user->result() as $row)
  { echo "<script type='text/javascript'>
            $('#npd').val('$row->Nombre ');
            $('#f').val('$row->Fecha');
            $('#io').val('$row->Instituciones_idInstituciones');
            $('#m').val('$row->Motivo  ');
          </script>";
  }
}
if ( $inst!= null)
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
<div id="formu">
  <form method="post" name="registro" id="registro" action="./">
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <label for="npd">Nombre del Premio o Distinción: </label>
            <input class="form-control" type="text" name="npd" id="npd" maxlength="70">
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <label for="f" >Fecha: </label>
            <input type="date" name="f" id="f" class="form-control">
        </div>
      </div>
      <div class="row ">
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 primera">
            <label for="io" >Institución Otorgante: </label>
              <select type="text" name="io" id="io" class="form-control" onclick="otraInstitucion()">
                <option value="">Seleccione...</option>
                <?php
									if ( $inst!=null)
									{
									foreach ($inst->result() as $row){  ?>
                    <option value='<?= $row->idInstituciones?>'><?= $row->Nombre ?></option>
               <?php } }
								?>
							 <option value='0'>Otra...</option>
            </select>
        </div>
        <div class=" otra">
          <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
              <label for="oio" >Institución Otorgante: </label>
              <div class="input-group">
                <input type="text" name="oio" id="oio" class="form-control" maxlength="45">
                <span class="input-group-btn">
                  <button class="btn btn-danger" type="button" id="canceloo">X</button>
                </span>
              </div>
          </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <label for="m" >Motivo: </label>
            <input type="text" name="m" id="m" class="form-control" maxlength="100">
        </div>
      </div>
  </form>
</div>
<script type="text/javascript">
  $(document).ready(function(){
    $("#canceloo").on('click', function(event) {
      <?php if ( $inst!=null){?>
        $('.primera').show();
        $('.otra').hide();
      <?php }else { ?>
        $('.otra').show();
        $('.primera').hide();
      <?php } ?>
      $('#io, #oio').val('');
    });
  });
</script>
