<link rel="stylesheet" href="<?php echo base_url('assets/styles/bootstrap-select.min.css');?>">
<script src="<?php echo base_url('assets/js/bootstrap-select.min.js'); ?>"></script>
	<!-- Este input recibe el miembro en el que se encuentra el profesor si es que se encuentra en uno, de lo contrario queda vacio -->
	  <input id="miembroCA"type="hidden" name="miembroCA" value="<?php echo isset($miembro->id)? $miembro->id : "";?>">
	  <form method="post" name="registro" id="registro" action="<?php echo base_url('index.php/User/addProduccion') ?>">
		  <div class="row" >
			  <div class="col-md-12">
				  <label>Titulo*: </label>
				  <input type="text" name="Titulo" id="Titulo" class="form-control" placeholder="Titulo de producción">
			  </div>
	      </div>
		  <div class="row">
			  <div class="col-md-12">
				  <label>Año*: </label>
				  <input type="number" min="1900" max="2100" onkeypress="return event.charCode >= 48"name="Ano" id="Ano" class="form-control" value="<?php echo date('Y');?>">
			  </div>
	  	  </div>
	      <div class="row">
			  <div class="col-md-12" id="divProduccion">
				<label>Seleccione un tipo de producción*: </label>
				  <select name="tipoproduccion" id="tipoproduccion" class="form-control">
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
				<div id="divOtraProduccion" class="col-md-12">
				  <label for="OtraProduccion">Escriba otra producción*: </label>
				  <div class="input-group">
					<input type="text" class="form-control" placeholder="Ingrese una produccion" name="OtraProduccion" id="OtraProduccion">
					<span class="input-group-btn">
					  <button class="btn btn-danger" type="button" id="cancelarOtraProduccion">X</button>
					</span>
				  </div>
				</div>
	  		</div>
	  <div class="row">
		  <div class="col-md-12">
			  <label>Seleccionar LGAC ind*:<br></label>
			  <select name="" id="lgacInd"class="selectpicker form-control"data-live-search="true"title="Ninguna linea seleccionada" multiple
			  data-selected-text-format="count>3" data-count-selected-text="{0} lineas seleccionadas"data-none-results-text="Ningun resultado para {0}">
				  <?php
				  foreach ($query->result() as $linea) {
					  echo '<option value="'.$linea->idLineageneracion.'">'.$linea->Nombre;
				  } ?>
			  <input type="hidden" name="LgacInd" id="lgacIndPost"value="">
			  </select>
	  	  </div>
		  <div class="col-md-6">

		  </div>
	  </div>
	  <?php ?>
	  <div class="row">
		  <div class="col-md-12">
			  <label>¿Considerar para curriculum del CA?*: <br></label>
			  <select class="form-control" name="Para" id="para">
				  <option id="para-no" value="0">No</option>
				  <option value="1">Sí</option>
			  </select>
		  </div>
	  </div>
	  <div class="row" id="div-ca" hidden>
		  <div class="col-md-6">
			  <label>Miembros*: <br></label>
			  <select name="miembros" id="Miembros"class="selectpicker form-control"data-live-search="true"title="Ningun miembro seleccionada" multiple data-selected-text-format="count>1" data-count-selected-text="{0} miembros seleccionados"data-none-results-text="Ningun resultado para {0}">
				  <?php
				  if(isset($MiembrosCA))
				  {
					  foreach ($MiembrosCA as $miembros){
						echo '<option value="'.$miembros[0]->idDatosprofesor.'">'.$miembros[0]->Nombres." ".$miembros[0]->Primerapellido." ".$miembros[0]->Segundoapellido.'</option>';
					  }
			  	  }?>
			  </select>
			  <input type="hidden" name="Miembros" id="MiembrosPost" value="">
		  </div>
		  <div class="col-md-6">
			  <label>Seleccionar LGAC AC*:<br></label>
			  <input type="hidden" name="idLgac" value="<?php echo isset($MiembrosCA)?$lineaCA->idLineageneracion:''; ?>">
			  <input type="text" disabled class="form-control" name="LgacAC"id="lgacAC" value="<?php echo isset($MiembrosCA)?$lineaCA->Nombre:''; ?>">
		  </div>
	  </div>
		  <div id="msj">
			  <p>* Campos obligatorios</p>
		  </div>

		  <input type="hidden" name="id" id="id"value="">
</form>
<script type="text/javascript">
	$(document).ready(function() {
		$('.selectpicker').selectpicker();
	  $('#divOtraProduccion').hide();
	  $('#tipoproduccion').on('change',function(){
		if( $('#tipoproduccion').val() == "Otra" ){
		  $('#divProduccion').hide();
		  $('#divOtraProduccion').show();
		}
	  });

	  $('#cancelarOtraProduccion').on('click',function(){
		$('#divOtraProduccion').hide();
		$('#divProduccion').show();
		$('#tipoproduccion').val("");
	  });
	  //cuando se carga al darle click al boton modificar, hace la asignación de los valores
	  if(id!= -1){
		  var paraCA = $(".highlight ").children('td:nth-child(6)').first().html() == 'Sí'? 1:0;
		  var tipoProduccion = $(".highlight ").children('td:nth-child(5)').first().html();
		  $('#tipoproduccion option').each(function(){
			if($(this).val() == tipoProduccion){
				$('#tipoproduccion').val(tipoProduccion);
				return false;
			}
		  });
		  if($('#tipoproduccion').val() == ""){
			$('#divProduccion').hide();
			$('#divOtraProduccion').show();
			$('#OtraProduccion').val(tipoProduccion);
			$('#tipoproduccion').val("Otra");
		  }
		  $('#id').val(id);
		  $('#Titulo').val($(".highlight ").children('td:nth-child(2)').first().html());
		  $('#Ano').val($(".highlight ").children('td:nth-child(3)').first().html());
		  var lgacInd = $(".highlight ").children('td:nth-child(10)').first().html();
		  //selectpicer solo admite los datos en modo de arreglo
		  $('#lgacInd').selectpicker('val',lgacInd.split(","));

		  $('#para').val(paraCA);
		  if($('#para').val() == 1){
			  $('#div-ca').show();
			  var miembros = $(".highlight ").children('td:nth-child(8)').first().html();
			  $('#Miembros').selectpicker('val',miembros.split(","));

		  }
		  else{
			  $('#div-ca').hide();
		  }
		  id=-1;
	  }
	});

	$('#para').change(function(){
		//por si pertenece a un cuerpo academico
		if($('#para').val() == 1 && $('#miembroCA').val()!="")
		  $('#div-ca').show();
		//por si no pertenece a un cuerpo academico
		else if($('#para').val() == 1 && $('#miembroCA').val()==""){
			$('#para').val(0);
			BootstrapDialog.alert({
			            title: 'Advertencia',
			            message: 'Debe formar parte de un cuerpo académico para esta opción',
			            type: BootstrapDialog.TYPE_WARNING,
			            closable: true,
			    });
		}
		else
		  {
			  $('#div-ca').hide();
		  }
	});


	//el id se obtiene desde el js de produccion_academica
</script>
