<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.tagsinput.js'); ?>"></script>
<link rel="stylesheet" href="<?php echo base_url('assets/styles/jquery.tagsinput.css');?>">
<link href="https://use.fontawesome.com/eb49eee3f9.css" media="all" rel="stylesheet">
<style>
    #registro div{
        margin-top: 7px;
    }

    #registro div input{
        cursor: default;
    }
    #registro div select{
        cursor: default;
    }
</style>
      <form method="post" name="registro" id="registro" action="">
          <div class="row" >
              <div class="col-md-4">
                  <label>Titulo: </label>
                  <input disabled type="text" name="Titulo" id="Titulo" class="form-control">
              </div>
              <div class="col-md-4">
                  <label>Año: </label>
                  <input disabled type="number" min="1900" max="2100" name="Ano" id="Ano" class="form-control" value="">
              </div>
              <div class="col-md-4">
                  <label>Num. Citas: </label>
                  <input disabled type="number"min="0" name="Citas" id="Citas" class="form-control">
              </div>
          </div>

      <div class="row">
        <div class="col-md-12" id="divProduccion">
          <label>Tipo de producción: </label>
            <select disabled name="tipoproduccion" id="tipoproduccion" class="form-control">
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
			<label for="OtraProduccion">Tipo de producción:  </label>
			  <input type="text" class="form-control" placeholder="Ingrese una produccion" name="OtraProduccion" id="OtraProduccion" disabled style="border-radius:4px;">
		  </div>
	  </div>
	  <div class="row">
	      <div class="col-md-4">
	          <label>Para CA: <br></label>
	          <select disabled class="form-control" name="Para" id="para">
	              <option value="0">No</option>
	              <option value="1" selected>Sí</option>
	          </select>
	          <!-- <input disabled type="text" name="Ind" id="Ind" class="form-control"> -->
	      </div>
		  <div class="col-md-4" id="ca-div">
			<label>LAGCs CA: </label>
			<input disabled type="text" min="0"name="CA" id="CA" class="form-control"value="<?php echo $lineaCA->Nombre;?>">
		  </div>
	  </div>
	  <div class="row">
          <div class="col-md-8" id="miebrosmas"style="border-bottom:1.5px solid grey;margin-left:15px;"  data-toggle="collapse" data-target="#miembros-div">
              <label>Miembros CA: </label>
			  <i class="fa fa-plus"id="icon"style="float:right;"></i>
			  <div class="collapse" id="miembros-div">
				  <ul>
					  <?php foreach ($MiembrosCA as $miembro){
						echo "<li>".$miembro->Nombres." ".$miembro->Primerapellido." ".$miembro->Segundoapellido."</li>";
					  }
					  ?>
				  </ul>
			  </div>
          </div>
      </div>

      <div class="row">
          <div class="col-md-8"id="lineasmas"style="border-bottom:1.5px solid grey;margin-left:15px;"  data-toggle="collapse" data-target="#lineas-div">
              <label>LGACs Ind: </label>
			  <i class="fa fa-plus"id="iconlineas"style="float:right;"></i>
			  <div class="collapse" id="lineas-div">
				  <ul>
					  <?php
					  	foreach ($lineas as $linea) {
					  		echo "<li>".$linea->Nombre."</li>";
					  	}
					   ?>
				  </ul>
			  </div>
          </div>
      </div>
          <input disabled type="hidden" name="id" id="id"value="">

          <script type="text/javascript">
		  		//se asignan todos los valores a los input deshabilitados
              $(document).ready(function(){
				  $('#miebrosmas').on("shown.bs.collapse",function(){
						$('#icon').attr('class','fa fa-minus')
				  });
				  $('#miebrosmas').on("hidden.bs.collapse",function(){
						$('#icon').attr('class','fa fa-plus');
				  });
				  $('#lineasmas').on("shown.bs.collapse",function(){
						$('#iconlineas').attr('class','fa fa-minus')
				  });
				  $('#lineasmas').on("hidden.bs.collapse",function(){
						$('#iconlineas').attr('class','fa fa-plus');
				  });

                  var paraCA = $(".detalles ").children('td:nth-child(6)').first().html() == 'Sí'? 1:0;
				  var miembros = $(".detalles ").children('td:nth-child(7)').first().html().replace(/;/g , "\n"); //cambia los ; por un salto de linea

				  //Checa si el tipo de producción se encuentra en el select o en el input de otros y hace los cambios correspondientes
				  var tipoProduccion = $(".detalles ").children('td:nth-child(5)').first().html();
				  $('#tipoproduccion option').each(function(){
					if($(this).val() == tipoProduccion){
						$('#tipoproduccion').val(tipoProduccion);
						$('#divOtraProduccion').hide();
						return false;
					}
				  });
				  if($('#tipoproduccion').val() == ""){
					$('#divProduccion').hide();
					$('#divOtraProduccion').show();
					$('#OtraProduccion').val(tipoProduccion);
					$('#tipoproduccion').val("Otra");
				  }
				  //se asignan los valores obteniendose de la clase detalles
                  $('#id').val(id);
                  $('#Titulo').val($(".detalles ").children('td:nth-child(2)').first().html());
                  $('#Ano').val($(".detalles ").children('td:nth-child(3)').first().html());
                  $('#Citas').val($(".detalles ").children('td:nth-child(4)').first().html());
                  $('#tipoproduccion').val($(".detalles ").children('td:nth-child(5)').first().html());
				  //checa si tiene miembros o no
                  $('#para').val(paraCA);
                  if($('#para').val() == 1){
                      $('#Miembros').importTags(miembros); //importa los miembros
                  }
                  else{
                      $('#miebrosmas').hide();//esconde los miembros
					  $('#ca-div').hide();
                  }
                  $('#Ind').val($(".detalles ").children('td:nth-child(8)').first().html());
                  //$('#Horas').val($(".detalles ").children('td:nth-child(10)').first().html());

	  			});
          </script>
</form>
