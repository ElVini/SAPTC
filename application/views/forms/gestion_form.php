<div id="formu">
  <form method="post" name="registro" id="registro" action="<?php echo base_url('index.php/User/agregar_mod_gestion');?>">
	  <input type="hidden" id="id" value="<?php echo isset($id)?$id:-1;?>">
    <div class="row">
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
			<?php
			$txtSeleccion = "";
			if($seleccion == 'Colectiva'){
				$txtSeleccion = 'Cargo dentro de la comisión y cuerpo colegiado*: ';
			}
			else if($seleccion){
				$txtSeleccion = 'Actividades de gestión académica o vinculación realizadas*: ';
			}
			?>
			<input type="hidden" name="seleccion" value="<?php echo $seleccion;?>">
            <label for="cargo-act"><?php echo $txtSeleccion;?></label>
            <input class="form-control" type="text" name="cargo-act" id="cargo-act">
        </div>
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
			<br>
            <label for="fechaIni" >Fecha de inicio*: </label>
            <input type="date" name="fechaIni" id="fechaIni" class="form-control">
        </div>
		<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
			<br>
			<label for="resultados" >Resultados obtenidos*: </label>
			<input type="text" name="resultados" id="resultados" class="form-control">
		</div>
      </div>
	  <br>
      <div class="row ">
	      <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
	          <label for="funcion" >Función encomendada*: </label>
			  <input type="text" name="funcion" id="funcion" class="form-control">
	      </div>
          <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
              <label for="fechaTer" >Fecha de término: </label>
              <input type="date" name="fechaTer" id="fechaTer" class="form-control">
          </div>
		  <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
			  <label for="estado">Estado*:</label>
			  <select class="form-control"name="estado"id="estado">
				<option value="">Seleccione un estado</option>
				<option value="Progreso">En progreso</option>
				<option value="Por obtener">Finalizado/Por obtener</option>
				<option value="Obtenido">Obtenido</option>
			</select>
		</div>
      </div>
	  <br>
	  <div class="row ">
		<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
			<label for="organo" >Organo colegiado al que fue presentado el reporte*: </label>
			<input type="text" name="organo" id="organo" class="form-control">
		</div>

		  <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
			  <br>
			  <label for="ultimoReporte" >Fecha del ultimo reporte presentado*: </label>
			  <input type="date" name="ultimoReporte" id="ultimoReporte" class="form-control">
		  </div>
		<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
			<label for="IES">IES en la que realiza la gestión académica*: </label>
			<input type="text" class="form-control" name="IES" id="IES"value="">
	  	</div>
	  </div>
	  <br>
	  <div class="row ">
		<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
			<br>
			<label for="aprobado" >Aprovado*: </label>
			<select name="aprobado" id="aprobado" class="form-control">
				<option value="">Seleccione un campo</option>
				<option value="Sí">Sí</option>
				<option value="No">No</option>
			</select>
		</div>
	    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
		    <label for="horasSemana" >Horas a la semana dedicadas a esta gestión*: </label>
		    <input type="number" name="horasSemana" id="horasSemana" class="form-control">
	    </div>
	  </div>
  </form>
  <script type="text/javascript">
  //condicion para cuando se le da click a modificar
	if($('#id').val()!=-1){
		$('#cargo-act').val($(".highlight ").children('td:not(#noRegistro):nth-child(3)').first().html());
		$('#fechaIni').val($(".highlight ").children('td:not(#noRegistro):nth-child(4)').first().html());
		$('#fechaTer').val($(".highlight ").children('td:not(#noRegistro):nth-child(6)').first().html());
		$('#estado').val($(".highlight ").children('td:not(#noRegistro):nth-child(8)').first().html());
		$('#resultados').val($(".highlight ").children('td:not(#noRegistro):nth-child(9)').first().html());
		$('#funcion').val($(".highlight ").children('td:not(#noRegistro):nth-child(10)').first().html());
		$('#organo').val($(".highlight ").children('td:not(#noRegistro):nth-child(11)').first().html());
		$('#ultimoReporte').val($(".highlight ").children('td:not(#noRegistro):nth-child(14)').first().html());
		$('#aprobado').val($(".highlight ").children('td:not(#noRegistro):nth-child(13)').first().html());
		$('#IES').val($(".highlight ").children('td:not(#noRegistro):nth-child(15)').first().html());
		$('#horasSemana').val($(".highlight ").children('td:not(#noRegistro):nth-child(12)').first().html());
	}
	//condicion para cuando se le da click en ver detalles
	if($("tr").hasClass("detalles")){
		$('#cargo-act').val($(".detalles").children('td:nth-child(3)').first().html());
		$('#fechaIni').val($(".detalles").children('td:nth-child(4)').first().html());
		$('#fechaTer').val($(".detalles").children('td:nth-child(6)').first().html());
		$('#estado').val($(".detalles").children('td:nth-child(8)').first().html());
		$('#resultados').val($(".detalles").children('td:nth-child(9)').first().html());
		$('#funcion').val($(".detalles").children('td:nth-child(10)').first().html());
		$('#organo').val($(".detalles").children('td:nth-child(11)').first().html());
		$('#ultimoReporte').val($(".detalles").children('td:nth-child(14)').first().html());
		$('#aprobado').val($(".detalles").children('td:nth-child(13)').first().html());
		$('#IES').val($(".detalles").children('td:nth-child(15)').first().html());
		$('#horasSemana').val($(".detalles").children('td:nth-child(12)').first().html());

		$('input').attr('disabled','true');
		$('select').attr('disabled','true');

	}
  </script>
</div>
