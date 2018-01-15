
		<?php $this->load->view('Helpers/User/header'); ?>

		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/styles/bootstrap-dialog.min.css') ?>">
		<link rel="stylesheet" href="<?php echo base_url('assets/styles/produccion_academica.css'); ?>">
		<script src="<?php echo base_url('assets/js/jquery-3.2.1.min.js'); ?>"></script>

		<script src="<?php echo base_url('assets/js/produccion_academica.js'); ?>"></script>


        <div class="row"><p></p></div>
        <div class="row"><p></p></div>
        <div class="row"><p></p></div>
        <div class="row"><p></p></div>
        <div class="row">
                  <div class="container col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1container col-xm-12 col-md-8 col-md-offset-2">
                    <section class="TituloPag">
                      <h1><b>Producción Academica</b></h1>
                    </section>
                  </div>
                </div>

                <div class="row"><p></p></div>
                <div class="row"><p></p></div>
                <div class="row"><p></p></div>
                <div class="row"><p></p></div>

                <div class="row">
                  <div class="container col-sm-12 col-lg-10 col-lg-offset-1">
                    <div class="table-responsive">
                      <table class="table table-hover" id="tablaEstudios">
                        <thead id="TablaCabeza">
                          <tr>
                            <td hidden><b>idProd</b></td>
                            <td><b>Titulo</b></td>
                            <td><b>Año</b></td>
                            <td hidden><b>Citas</b></td>
                            <td><b>Tipo de producción</b></td>
                            <td><b>Para<br>CA</b></td>
                            <td><b>Miembros<br>CA</b></td>
                            <td><b>LGACs<br>Ind</b></td>
                            <td hidden><b>LAGCs<br>CA</b></td>
							<td></td>
                          </tr>
                        </thead>

                <tbody>
                  <?php
				  	$numLineas=0;
					//esta parte es para imprimir los datos de la lineas individuales como hidden
					//se obtiene el numero total y el id de las mismas
					$id=[];
					foreach ($lineasInd as $lineas) {
						$numLineas=0;
						$id=[];
						foreach ($lineas as $linea) {
							$numLineas++;
							$id[] = $linea->id_lineageneracion;
						}
						$numLineasArray[]=$numLineas;
						$idsLineas[]= $id;
					}
					$counter=0;
                    foreach ($query->result() as $produccion) {
					  if($produccion->MiembrosCA != ""){
						  $array = explode(',', $produccion->MiembrosCA);
						  $miembros = count($array);
					  }
					  else{
						  $miembros = "-";
					  }
					  $paraCA = $produccion->ParaCA == 1 ? "Sí": "No";
					  $numLineas = $numLineasArray[$counter]!=""?$numLineasArray[$counter]:"-";
                      echo '<tr id="TablaLinea">
	                      <td hidden>'.$produccion->idProduccionacademica.'</td>
	                      <td>'.$produccion->Titulo.'</td>
	                      <td>'.$produccion->Ano.'</td>
	                      <td hidden></td>
	                      <td>'.$produccion->Tipoproduccion.'</td>
	                      <td>'.$paraCA.'</td>
						  <td>'.$miembros.'</td>
						  <td hidden>'.$produccion->MiembrosCA.'</td>
						  <td>'.$numLineas.'</td>
	                      <td hidden>'.implode(",",$idsLineas[$counter]).'</td>
	                      <td hidden></td>
	                      <td hidden></td>
						  <td id="detalles"><a href="#">Ver detalles</a></td>
                     	</tr>';
                      $counter++;
				  	}
                  ?>

                </tbody>
              </table>
            </div>
            <div id="BotonesTabla">
			  <span id="divCitas"><button type="button" id="btnCitas" class="btn" name="citas">Resumen de citas</button></span>
              <button type="button" id="EliminarB" class="btn btn-danger">Eliminar</button>
              <button type="button" id="Modificar" class="btn btn-primary">Modificar</button>
              <button type="button" id="Agregar" class="btn btn-success">Agregar</button>
            </div>
            <div id="ajax"></div>
            <div id="divParaError" class="DivELetrasrojas">
              <p>Seleccione un registro</p>
            </div>
			<div id="delete_form"></div> <!-- aqui inserto el id en un formulario para eliminar el registro -->


          </div>
        </div>
<?php $this->load->view('User/Helpers/footer'); ?>
