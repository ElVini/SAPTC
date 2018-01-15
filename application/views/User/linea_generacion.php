
		<?php $this->load->view('Helpers/User/header'); ?>

		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/styles/bootstrap-dialog.min.css') ?>">
		<link rel="stylesheet" href="<?php echo base_url('assets/styles/produccion_academica.css'); ?>">
		<script src="<?php echo base_url('assets/js/jquery-3.2.1.min.js'); ?>"></script>

		<script src="<?php echo base_url('assets/js/linea_generacion.js'); ?>"></script>


        <div class="row"><p></p></div>
        <div class="row"><p></p></div>
        <div class="row"><p></p></div>
        <div class="row"><p></p></div>
        <div class="row">
                  <div class="container col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1container col-xm-12 col-md-8 col-md-offset-2">
                    <section class="TituloPag">
                      <h1><b>Línea de Generación</b></h1>
                    </section>
                  </div>
                </div>

                <div class="row"><p></p></div>
                <div class="row"><p></p></div>
                <div class="row"><p></p></div>

                <div class="row">
                  <div class="container col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1">
                    <section class="TituloTabla">
                      <h4><b>Líneas de Generación</b></h4>
                    </section>
                  </div>
                </div>

                <div class="row"><p></p></div>

                <div class="row">
                  <div class="container col-sm-12 col-lg-10 col-lg-offset-1">
                    <div class="table-responsive">
                      <table class="table table-hover" id="tablaLinea">
                        <thead id="TablaCabeza">
                          <tr>
                            <td hidden><b>idLinea</b></td>
                            <td><b>Nombre</b></td>
                            <td><b>Actividades</b></td>
                            <td><b>Horas Semanales</b></td>
                          </tr>
                        </thead>
                <tbody>
                  <?php
                    $inputId = 0;
                    foreach ($query->result() as $linea) {
                      echo '<tr id="TablaLinea">
                          <td hidden>'.$linea->idLineageneracion.'</td>
                          <td>'.$linea->Nombre.'</td>
                          <td>'.$linea->Actividades.'</td>
                          <td>'.$linea->HorasSemana.'</td>
                          <td hidden>'.$linea->Datosprofesores_idDatosprofesor.'</td>
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
<script>
    var base_url = "<?php echo base_url(); ?>"
</script>
<?php $this->load->view('User/Helpers/footer'); ?>
