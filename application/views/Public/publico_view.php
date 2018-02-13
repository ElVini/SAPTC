  <?php $this->load->view('User/Helpers/headeri');?>
  <body>
  <input type="hidden" id="base_url" value="<?php echo base_url(); ?>">
  <div class="container" align="center">
    <div class="row" id="espacio">
      <div class="container col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1container col-xm-12 col-md-8 col-md-offset-2">
        <section class="">
          <h1><b>Listado de Profesores</b></h1>
        </section>
      </div>
    </div>
    <div class="row busqueda">
      <div class="col-md-8 "></div>
      <div class="col-md-4">
          <div class="input-group">
            <input class="form-control" id="busqueda" type="text" class="form-control" name="busqueda" placeholder="Nombre del profesor" autocomplete="off" maxlength="30">
            <span class="input-group-btn">
              <button class="btn btn-default" type="button"><span class="glyphicon glyphicon-search"></span></button>
            </span>
          </div>
      </div>
      <br><br><br>
      </div>

      <div class="col-md-12 col-lg-12">
        <div class="table table-responsive">
          <div id="listaProfesores">
            <table class="table table-hover">
              <thead id="TablaCabeza">
                <tr>
                  <th hidden>ID</th>
                  <th>Nombre</th>
                  <th>Apellido paterno</th>
                  <th>Apellido materno</th>
                  <th>Carrera</th>
                  <th>Nivel academico</th>
                  <th>Ver</th>
                </tr>
              </thead>
              <tbody>
                <!-- MUESTRA LOS DATOS DE PROFESORES-->
                <?php
                $cont=1;
                foreach ($consulta->result() as $fila) { ?>
                <tr id="TablaLinea">
                  <td hidden><?php echo $fila->idDatosprofesor; ?></td>
                  <td><?php echo $fila->Nombres; ?></td>
                  <td><?php echo $fila->Primerapellido; ?></td>
                  <td><?php echo $fila->Segundoapellido; ?></td>
                  <td><?php echo $fila->Disciplina; ?></td>
                  <td><?php echo $fila->Nivelestudios; ?></td>
                  <td><button class="btn btn-default" onclick='muestraInf(<?php echo $fila->idDatosprofesor; ?>)'><span class="glyphicon glyphicon-eye-open"></span></button></td>
                </tr>
                <?php
                $cont++;
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </body>
  <script type="text/javascript">var base_url = "<?php echo base_url();?>";</script>
  <script src="<?php echo base_url('assets/js/maestros.js');?>"></script>
</html>
