<form method="post" id="nuevoCuerpoAcadForm" action="<?php echo base_url('index.php/User/unirseCA')?>">
  <div class="row" >
    <div class="form-group col-md-6 mb-3">
        <label>Cuerpos Académicos Existentes: </label>
        <select class="form-control" name="cuerpoAcademicoE" id="cuerpoAcademicoE" class="form-control">
          <option selected value="">Seleccione uno</option>
          <?php foreach ($cuerposAcademicos->result() as $ca) {
            echo "<option value='".$ca->idCuerpoacademico."'>".$ca->Nombre."</option>";
          } ?>
        </select>
      </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <a href="#" id="nuevoCA">¿No encuentra el Cuerpo Académico? Agrégalo.</a>
    </div>
  </div>
</form>

<script type="text/javascript">
//Cuando elige un cuerpo académico ya existente
  $('#btnAcepNuevoCA').click(function(){
    if($('#cuerpoAcademicoE').val() != ""){
        $('#nuevoCuerpoAcadForm').submit();
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

  $('#nuevoCA').click(function(){
    alertPrincipal();
  });
</script>
