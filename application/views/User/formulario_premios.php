
<?php
if (isset($user))
{	foreach ($user->result() as $row)
	{
?>
<script type="text/javascript">
		$('#npd').val("<?= $row->Nombre;  ?>");
		$('#f').val("<?= $row->Fecha;  ?>");
		$('#io').val("<?= $row->Instituciones_idInstituciones;  ?>");
		$('#m').val("<?= $row->Motivo;  ?>");
</script>

<?php }}

 ?>
 <?php if ( $inst!= null){ ?>
	 <script type="text/javascript">
	 	$('.otra').hide();
	 </script>
<?php } ?>
<div id="formu">
  <form method="post" name="registro" id="registro" action="./">
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <label for="npd">Nombre del Premio o Distincion*: </label>
            <input class="form-control" type="text" name="npd" id="npd" >
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <label for="f" >Fecha*: </label>
            <input type="date" name="f" id="f" class="form-control">
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <label for="io" >Institucion Otorgante*: </label>
              <select type="text" name="io" id="io" class="form-control" onclick="otraInstitucion()">
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

        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <label for="m" >Motivo*: </label>
            <input type="text" name="m" id="m" class="form-control">
        </div>
      </div>
      <div class="row otra">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <label for="oio" >Otra Institucion Otorgante*: </label>
            <input type="text" name="oio" id="oio" class="form-control">
        </div>
    </div>
  </form>
</div>
