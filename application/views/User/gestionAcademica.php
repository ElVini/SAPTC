
		<?php $this->load->view('Helpers/User/header'); ?>
		<script src="<?php echo base_url('assets/js/jquery-3.2.1.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/js/gestionAcademica.js'); ?>"></script>
		<link rel="stylesheet" href="<?php echo base_url('assets/styles/produccion_academica.css'); ?>">
		<input type="hidden" id="base_url" value="<?php echo base_url(); ?>">
        <div class="row"><p></p></div>
        <div class="row"><p></p></div>
        <div class="row"><p></p></div>
        <div class="row"><p></p></div>
        <div class="row">
                  <div class="container col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-container col-xm-12 col-md-8 col-md-offset-2">
                    <section class="TituloPag">
                      <h1><b>Gestión académica</b></h1>
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
                            <td hidden><b>idGestion</b></td>
                            <td><b>Tipo</b></td>
                            <td><b>Cargo / Actividades</b></td>
                            <td><b>Fecha inicio</b></td>
                            <td><b>Fecha termino</b></td>
							<td><b>Estado</b></td>
							<td></td>
                          </tr>
                        </thead>
		                <tbody>
							<?php
							$count=0;
							foreach ($gestiones->result() as $gestion) {
								if($gestion->Cargo != ''){
									$tipo = 'Colectiva';
									$cargo_act = $gestion->Cargo;
								}
								else{
									$tipo = 'Individualizada';
									$cargo_act = $gestion->Actividades;
								}
								$fechaIni = date_format(date_create($gestion->Fechainicio),"d / m / Y");
								$fechaFin = date_format(date_create($gestion->Fechafin),"d / m / Y");
								echo '<tr>
										<td hidden>'.$gestion->idGestionac.'</td>
										<td>'.$tipo.'</td>
										<td>'.$cargo_act.'</td>
										<td hidden>'.$gestion->Fechainicio.'</td>
										<td>'.$fechaIni.'</td>
										<td hidden>'.$gestion->Fechafin.'</td>
										<td>'.$fechaFin.'</td>
										<td>'.$gestion->Estado.'</td>
										<td hidden>'.$gestion->Resultados.'</td>
										<td hidden>'.$gestion->Funcion.'</td>
										<td hidden>'.$gestion->Organocolegiado.'</td>
										<td hidden>'.$gestion->Horassemanales.'</td>
										<td hidden>'.$gestion->Aprovacion.'</td>
										<td hidden>'.$gestion->FechaUltimoReporte.'</td>
										<td hidden>'.$gestion->IES.'</td>
										<td id="detalles"><a href="#">Ver detalles</a></td>
									</tr>';
								$count++;
							}
							if($count==0){
								echo '<tr><td colspan="6"id="noRegistro"align="center">No hay registros</td></tr>';
							}
							?>
		                </tbody>
		              </table>
            		</div>
	            <div id="BotonesTabla">
	              <button type="button" id="EliminarB" class="btn btn-danger">Eliminar</button>
	              <button type="button" id="Modificar" class="btn btn-primary">Modificar</button>
	              <button type="button" id="Agregar" class="btn btn-success">Agregar</button>
	            </div>
	            <div id="div-form"></div>
	            <div id="divParaError" class="DivELetrasrojas">
	              <p>Seleccione un registro</p>
	            </div>
				<div id="delete_form"></div> <!-- aqui inserto el id en un formulario para eliminar el registro -->
			  </div>
        	</div>
<?php $this->load->view('User/Helpers/footer'); ?>
