<link rel="stylesheet" href="<?php echo base_url('assets/styles/bootstrap-select.min.css');?>">
<script src="<?php echo base_url('assets/js/bootstrap-select.min.js'); ?>"></script>
	  <form method="post" name="form_citas" id="form_citas" action="<?php echo base_url('index.php/User/addCita?id='.$id_prod); ?>">
		  <input type="hidden" name="id_cita" id="id_citaForm"value="-1">
		  <div class="row" >
			  <div class="col-md-12">
				  <label>Titulo*: </label>
				  <input type="text" name="Titulo" id="titulo_cita" class="form-control" placeholder="Titulo de producción">
			  </div>
		  </div>
		  <div class="row">
			  <div class="col-md-12">
				  <label>Año*: </label>
				  <input type="number" min="1900" max="2100" onkeypress="return event.charCode >= 48"name="ano_cita" id="ano_cita" class="form-control" value="<?php echo date('Y');?>">
			  </div>
			  <div class="col-md-12" id="divProduccion_cita">
				<label>Tipo de producción*: </label>
				  <select name="tipoproduccion" id="tipoproduccion_cita" class="form-control">
					  <option value="">Seleccione producción</option>
					  <option value="Articulo de difusión y divulgación">Artículo de difusión y divulgación</option>
					  <option value="Articulo Arbitrado">Artículo Arbitrado</option>
					  <option value="Articulo en revista indexada">Artículo en revista indexada</option>
					  <option value="Asesoría">Asesoria</option>
					  <option value="Capítulo del libro">Capítulo del libro</option>
					  <option value="Consultoria">Consultoría</option>
					  <option value="Informe técnico">Informe técnico</option>
					  <option value="Libro">Libro</option>
					  <option value="Manuales de opercacion">Manuales de opercacion</option>
					  <option value="Material de apoyo">Material de apoyo</option>
					  <option value="Material didáctico">Material didáctico</option>
					  <option value="Memorias">Memorias</option>
					  <option value="Memorias en extenso">Memorias en extenso</option>
					  <option value="Productividad innovadora">Productividad innovadora</option>
					  <option value="Producción artistica">Producción artistica</option>
					  <option value="Prototipo">Prototípo</option>
					  <option value="Otra">Otra</option>
				  </select>
				</div>
				<div id="divOtraProduccion_cita" class="col-md-12">
				  <label for="otraProduccion_cita">Escriba otra producción*: </label>
				  <div class="input-group">
					<input type="text" class="form-control" placeholder="Ingrese una produccion" name="otraProduccion_cita" id="otraProduccion_cita"value="">
					<span class="input-group-btn">
					  <button class="btn btn-danger" type="button" id="cancelarOtraProduccion">X</button>
					</span>
				  </div>
				</div>
			</div>
			<div class="row">
			  <div class="col-md-12">
				  <label>Información adicional*:<br></label>
				  <input type="text" class="form-control"name="infAdic" id="infAdic"value=""placeholder="Información adicional">
		  	  </div>
	  		</div>
  		  </div>
  </form>


  <script type="text/javascript">
	  $('#divOtraProduccion_cita').hide();
	  $('#tipoproduccion_cita').on('change',function(){
		if( $('#tipoproduccion_cita').val() == "Otra" ){
		  $('#divProduccion_cita').hide();
		  $('#divOtraProduccion_cita').show();
		}
	  });

	  $('#cancelarOtraProduccion').on('click',function(){
		$('#divOtraProduccion_cita').hide();
		$('#divProduccion_cita').show();
		$('#tipoproduccion_cita').val("");
	  });

	  if(citas_id != -1)
	  {
		  var tipoProduccion = $(".highlight ").children('#Tablacitas td:nth-child(3)').first().html();
		  $('#tipoproduccion_cita option').each(function(){
			if($(this).val() == tipoProduccion){
				$('#tipoproduccion_cita').val(tipoProduccion);
				return false;
			}
		  });
		  if($('#tipoproduccion_cita').val() == ""){
			$('#divProduccion_cita').hide();
			$('#divOtraProduccion_cita').show();
			$('#otraProduccion_cita').val(tipoProduccion);
			$('#tipoproduccion_cita').val("Otra");
		  }
		  $('#id_citaForm').val(citas_id);
		  $('#titulo_cita').val($(".highlight ").children('#Tablacitas td:nth-child(2)').first().html());
		  $('#ano_cita').val($(".highlight ").children('#Tablacitas td:nth-child(4)').first().html());
		  $('#infAdic').val($(".highlight ").children('#Tablacitas td:nth-child(5)').first().html());
	  }

  </script>
