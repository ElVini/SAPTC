
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

                <div class="row">
                  <div class="container col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1">
                    <section class="TituloTabla">
                      <h4><b>Producción</b></h4>
                    </section>
                  </div>
                </div>

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
                            <td><b>Citas</b></td>
                            <td><b>Tipo de producción</b></td>
                            <td><b>Para<br>CA</b></td>
                            <td><b>Miembros<br>CA</b></td>
                            <td><b>LGACs<br>Ind</b></td>
                            <td><b>LAGCs<br>CA</b></td>
                          </tr>
                        </thead>

                <tbody>
                  <?php
                    $inputId = 0;
                    foreach ($query->result() as $produccion) {
                      echo '<tr id="TablaLinea">
                      <td hidden>'.$produccion->idProduccionacademica.'</td>
                      <td>'.$produccion->Titulo.'</td>
                      <td>'.$produccion->Ano.'</td>
                      <td>'.$produccion->Numcitada.'</td>
                      <td>'.$produccion->Tipoproduccion.'</td>
                      <td>'.$produccion->ParaCA.'</td>
                      <td>'.$produccion->MiembrosCA.'</td>
                      <td>'.$produccion->Numlineasind.'</td>
                      <td>'.$produccion->NumlineasCA.'</td>
                      <td hidden>'.$produccion->HorasSemanales.'</td>

                          </tr>';
                      $inputId++;
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
            <div id="ajax"></div>
            <div id="divParaError" class="DivELetrasrojas">
              <p>Seleccione un registro</p>
            </div>


          </div>
        </div>
<?php $this->load->view('User/Helpers/footer'); ?>
