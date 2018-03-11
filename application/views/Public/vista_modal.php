<div class="container">
  <div class="row">
    <div class="col-md-2 col-lg-2 col-sm-2">
        <a data-toggle="modal" data-target="#myModal">  <img src="<?php echo base_url($img); ?>" height="100px" class="img-fluid" width="100px" id="foto" style="border-radius: 100%;" title="Foto de perfil" alt="<?php echo "Imagen de ".$nombre ?>"> </a>
    </div>
    <div class="col-md-6 col-lg-6 col-sm-6" align="center">
        <h2><b><?php echo $nombre. ' ' .$apellidop. ' '. $apellidom  ?></b></h2>
        <h4><b>Profesor de Tiempo Completo</b></h4>
        <h5><b>Teléfono trabajo: </b> <?= $telefonot ?></h5>
        <h5><b>Correo electrónico: </b> <?= $correo ?></h5>
        <h5><b>Nacionalidad: </b><?= $nacionalidad ?></h5>
    </div>
  </div>
  <br>
  <div class="col-md-9 col-lg-9 col-sm-9 ">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">Servicio a alumnos</h3>
        <span class="pull-right clickable" data-toggle="collapse" data-target="#colapse1" aria-expanded="false" aria-controls="colapse1"><i class="glyphicon glyphicon-chevron-up"></i></span>
      </div>
      <div id="colapse1" class="collapse" aria-labelledby="uno" data-parent="#accordion">
        <div class="panel-body">
          <ul class="nav nav-pills mb-3" id="servicioa" role="tablist">
            <li class="nav-item">
              <a class="nav-link" id="tutoria" data-toggle="pill" href="#p-tutoria" role="tab" aria-controls="p-tutoria" aria-selected="false">Tutorías</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="docencia" data-toggle="pill" href="#p-docencia" role="tab" aria-controls="p-docencia" aria-selected="false">Docencias</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="direccionInd" data-toggle="pill" href="#p-direccionInd" role="tab" aria-controls="p-direccionInd" aria-selected="false">Dirección individualizada </a>
            </li>
          </ul>
          <div class="tab-content" id="servicioaContent">
            <div class="tab-pane fade" id="p-tutoria" role="tabpanel" aria-labelledby="tutoria">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</div>
            <div class="tab-pane fade" id="p-docencia" role="tabpanel" aria-labelledby="docencia">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</div>
            <div class="tab-pane fade" id="p-direccionInd" role="tabpanel" aria-labelledby="direccionInd">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</div>
          </div>
        </div>
      </div>
    </div>
   <!---------------------------------------------------------------->
    <div class="panel panel-default">
      <div class="panel-heading" id="headingTwo">
        <h3 class="panel-title">Actividades particulares</h3>
        <span class="pull-right clickable" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"><i class="glyphicon glyphicon-chevron-up"></i></span>
      </div>
      <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
        <div class="panel-body">
          <ul class="nav nav-pills mb-3" id="actividad" role="tablist">
            <li class="nav-item">
              <a class="nav-link" id="proyecto" data-toggle="pill" href="#p-proyecto" role="tab" aria-controls="p-proyecto" aria-selected="false">Proyectos</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="lgac" data-toggle="pill" href="#p-lgac" role="tab" aria-controls="p-lgac" aria-selected="false">LGAC</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="producciona" data-toggle="pill" href="#p-producciona" role="tab" aria-controls="p-producciona" aria-selected="false">Producción Académica</a>
            </li>
          </ul>
          <div class="tab-content" id="actividadContent">
            <div class="tab-pane fade" id="p-proyecto" role="tabpanel" aria-labelledby="proyecto">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</div>
            <div class="tab-pane fade" id="p-lgac" role="tabpanel" aria-labelledby="lgac">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</div>
            <div class="tab-pane fade" id="p-producciona" role="tabpanel" aria-labelledby="producciona">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</div>
          </div>
        </div>
      </div>
    </div>
   <!---------------------------------------------------------------->
    <div class="panel panel-default">
      <div class="panel-heading" id="headingThree">
        <h3 class="panel-title">Profesor</h3>
        <span class="pull-right clickable" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree"><i class="glyphicon glyphicon-chevron-up"></i></span>
      </div>
      <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
        <div class="panel-body">
          <ul class="nav nav-pills mb-3" id="profesor" role="tablist">
            <li class="nav-item">
              <a class="nav-link" id="estudio" data-toggle="pill" href="#p-estudio" role="tab" aria-controls="p-estudio" aria-selected="false">Estudios Realizados</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="datolab" data-toggle="pill" href="#p-datolab" role="tab" aria-controls="p-datolab" aria-selected="false">Datos Laborales</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="premio" data-toggle="pill" href="#p-premio" role="tab" aria-controls="p-premio" aria-selected="false">Premios o Distinciones</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="cuerpoAc" data-toggle="pill" href="#p-cuerpoAc" role="tab" aria-controls="p-cuerpoAc" aria-selected="false">Datos del Cuerpo Académico</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="participacion" data-toggle="pill" href="#p-participacion" role="tab" aria-controls="p-participacion" aria-selected="false">Participación en Programas Educativos</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="gestion" data-toggle="pill" href="#p-gestion" role="tab" aria-controls="p-gestion" aria-selected="false">Gestión Académica - Vinculación</a>
            </li>
          </ul>
          <div class="tab-content" id="profesorContent">
            <div class="tab-pane fade" id="p-estudio" role="tabpanel" aria-labelledby="estudio">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</div>
            <div class="tab-pane fade" id="p-datolab" role="tabpanel" aria-labelledby="datolab">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</div>
            <div class="tab-pane fade" id="p-premio" role="tabpanel" aria-labelledby="premio">
              <div class="table-responsive">
                <table class="table table-hover" id="tablaEstudios">
                  <thead id="TablaCabeza">
                    <tr>
                      <td hidden><b>ID</b></td>
                      <th style="width: 25%">Nombre del Premio o Distinción</th>
                      <th style="width: 15%">Fecha</th>
                      <th style="width: 25%">Institución Otorgante</th>
                      <th style="width: 35%">Motivo</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if($premio!= null)
                          {
                            foreach ($premio as $row){
                    ?>
                    <tr id="TablaLinea">
                      <td hidden="" id="<?= $row->idPremios ?>"></td>
                      <td><?= $row->NombrePremio?></td>
                      <td><?= date_format(date_create($row->Fecha), "d / m / Y")?></td>
                      <td><?= $row->Nombre?></td>
                      <td><?= $row->Motivo?></td>
                    </tr>
                    <?php }}
                      else
                      { echo '<tr><td colspan = "5" align="center">No tiene registros</td></tr>';
                      }
                    ?>
                   </tbody>
                </table>
              </div>
            </div>
            <div class="tab-pane fade" id="p-cuerpoAc" role="tabpanel" aria-labelledby="cuerpoAc">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</div>
            <div class="tab-pane fade" id="p-participacion" role="tabpanel" aria-labelledby="participacion">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</div>
            <div class="tab-pane fade" id="p-gestion" role="tabpanel" aria-labelledby="gestion">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<style>
  .panel-heading span
  {
      margin-top: -20px;
      font-size: 15px;
  }
  .clickable
  {
      cursor: pointer;
  }
</style>
<script type="text/javascript">
  jQuery(function ($) {
      $('.panel-heading span.clickable').on("click", function (e) {
          if ($(this).find('i').hasClass('glyphicon-chevron-down'))
              $(this).find('i').removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up');
          else
              $(this).find('i').removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');
      });
  });
</script>
