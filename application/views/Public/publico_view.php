<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="<?php echo base_url('assets/styles/acc.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/styles/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/styles/font-awesome/css/font-awesome.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/styles/publico.css'); ?>">

    <title>Listado de maestros</title>

  </head>
  <?php $this->load->view('User/Helpers/headeri');?>
  <body>
    <input type="hidden" id="base_url" value="<?php echo base_url(); ?>">
    <div class="container">
      <div class="row" id="espacio">
                  <div class="container col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1container col-xm-12 col-md-8 col-md-offset-2">
                    <section class="TituloPag">
                      <h1><b>Listado de Profesores</b></h1>
                    </section>
                  </div>
        </div>


        <div class="row busqueda">
          <div class="col-md-8"></div>

          <div class="col-md-4">
              <div class="input-group">
                <input class="form-control" id="busqueda" type="text" class="form-control" name="busqueda" placeholder="Nombre del profesor" autocomplete="off" maxlength="30">

              </div>
          </div>
        <br>
        <br><br>
    </div>
     <div id="listaProfesores" class="row">
      <table class="table table-responsive">
          <thead class="thead-inverse">
            <tr>
              <th>#</th>
              <th>NOMBRE DEL PROFESOR</th>
              <th>APELLIDO PATERNO</th>
              <th>APELLIDO MATERNO</th>
              <th>CARRERA</th>
              <th>NIVEL ACADEMICO</th>
            </tr>
          </thead>
          <tbody>
            <!-- MUESTRA LOS DATOS DE PROFESORES-->
            <?php
                  $cont=1;
                  foreach ($consulta->result() as $fila) { ?>
                  <tr>
                    <td><?php echo $cont; ?></td>
                    <td><?php echo $fila->Nombres; ?></td>
                    <td><?php echo $fila->Primerapellido; ?></td>
                    <td><?php echo $fila->Segundoapellido; ?></td>
                    <td><?php echo $fila->Disciplina; ?></td>
                    <td><?php echo $fila->Nivelestudios; ?></td>
                  </tr>
            <?php
                  $cont++;
              }

            ?>
          </tbody>
       </table>
    </div>

  </body>

  <script src="<?php echo base_url('assets/js/jquery-3.2.1.min.js'); ?>"></script>
  <script src="<?php echo base_url('assets/js/maestros.js');?>"></script>
</html>
