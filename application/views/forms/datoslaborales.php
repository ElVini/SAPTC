<script type="text/javascript">$('.fecha').hide();</script>
<?php
if (isset($user))
{	foreach ($user->result() as $row)
	{	echo "<script type='text/javascript'>
				$('#id_d').val('$row->idDatoslaborales');
				$('#nom').val('$row->Nombramiento');
				$('#tipo_nom').val('$row->Tipo');
				$('#dedicacion').val('$row->Dedicacion');
				$('#dependencia').val( '$row->NombreDependencia');
				$('#unidad').val( '$row->Unidadacademica');
				$('#fecha_init').val( '$row->Fechadeiniciocontrato');
				$('#fecha_fin').val(' $row->Fechafincontrato');
				$('.fecha').show();
			</script>";
		}
}?>
<form  method="post" action="#" >
  <div class="row">
    <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
      <label for="nom">Nombramiento*:</label>
      <input class="form-control" type="text" name="nom" id="nom">
    </div>
    <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
      <label for="tipo_nom">Tipo de nombramiento*:</label>
      <select class="form-control" id="tipo_nom" name="tipo_nom" onchange="fecha(<?= $dec; ?>)" >
        <option value="Indeterminado">Indeterminado</option>
        <option value="Temporal">Temporal</option>
      </select>
		</div>
    </div>
		<div class="row">
      <div class="form-group col-md-12">
        <label for="dedicacion">Dedicación*:</label>
        <select class="form-control" name="dedicacion" id="dedicacion">
          <option value="Tiempo completo">Tiempo completo</option>
          <option value="Medio tiempo">Medio tiempo</option>
          <option value="Por horas">Por horas</option>
        </select>
      </div>
  	</div>
  <div class="row">
    <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-6">
      <label for="dependencia">Dependencia de Educación Superior de abscripción*:</label>
      <input class="form-control" type="text" name="dependencia" id="dependencia" >
    </div>
    <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-6">
      <label for="unidad">Unidad Academica de abscripción*:</label>
      <select class="form-control" id="unidad" name="unidad">
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
  </div>
	<div class="row">
		<div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
			<label for="fecha_init">Fecha de inicio del contrato*:</label>
			<input class="form-control" type="date" name="fecha_init" id="fecha_init">
		</div>
		<div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6 fecha">
			<label for="fecha_fin">Fecha de fin del contrato*:</label>
			<input class="form-control" type="date" name="fecha_fin" id="fecha_fin">
		</div>
	</div>
</form>
