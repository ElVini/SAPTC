<?php $this->load->view('helpers/admin/header'); ?>
<link rel="stylesheet" href="<?php echo base_url('assets/styles/Admin_usuarios.css'); ?>">

<link rel="stylesheet" href="<?php echo base_url('assets/styles/avisos.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/styles/imagenes.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/styles/bootstrap-dialog.min.css'); ?>">
<script src="<?php echo base_url('assets/js/jquery-3.2.1.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/zabuto_calendar.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/avisos.js'); ?>"></script>
<script src="https://use.fontawesome.com/eb49eee3f9.js"></script>

  <!-- espacio para el nombre y la foto de perfil -->

<div class="row" style="background-color:#EEEEEE;">
    <center><div class="col-md-12">
      <div class="view overlay hm-blue-light">
        <a data-toggle="modal" data-target="#myModal">  <img src="<?php echo base_url($img); ?>" height="100px" class="img-fluid" width="100px" id="foto" style="border-radius: 100%;" title="Cambiar foto de perfil" alt="<?php echo "Imagen de ".$nombre ?>"> </a>

      </div>
    </div>

    <div class="col-md-12">
        <h2><?php echo $nombre. ' ' .$apellidop. ' '. $apellidom  ?></h2>
    </div></center>
</div>

  <!-- Modal para cambiar la foto de perfil -->
  <div class="modal fade" id="myModal" role="dialog">
    <form action="<?php echo base_url('index.php/Administrador/cambiarImagen?id='.$id); ?>" method="post" enctype="multipart/form-data">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="background-color:#337AB7; color:white;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Cambiar foto</h4>
        </div>
        <div class="modal-body">
          <h4>Seleccione la fotografía:</h4> <br>
          <input type="file" name="foto" accept=".jpg">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
          <input type="submit" class="btn btn-primary" value="Enviar">
        </div>
      </div>

    </div>
    </form>
  </div>

</div>

  <!-- Aqui empiezan a mostrarse los datos personales -->
  <div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
              <h1>Datos personales</h1>
        </div>
    </div>
    <div class="container-fluid">
      <div>

      <hr>
        <form id="formDatos" action="<?php echo base_url('index.php/User/datos_profesor'); ?>" method="post">
            <div class="row form-group" style="margin-top: 20px;">
                <div class="col-md-4">
                    <label for="nombre">Nombre(s)</label>
                    <input class="form-control" type="text" id="nombre" name="nnombre" disabled value="<?php echo $nombre; ?>">
                </div>
                <div class="col-md-4">
                    <label for="apellidop">Apellido paterno</label>
                    <input class="form-control" id="apellidop" type="text" name="napellidop" disabled value="<?php echo $apellidop; ?>">
                </div>
                <div class="col-md-4">
                    <label for="apellidom">Apellido materno</label>
                    <input class="form-control" id="apellidom" type="text" name="napellidom" disabled value="<?php echo $apellidom; ?>">
                </div>
            </div>
            <div class="row form-group" style="margin-top: 20px;">
                <div class="col-md-4">
                    <label for="curp">Clave única de registro de población (CURP)</label>
                    <input class="form-control" disabled id="curp" type="text" name="ncurp" value="<?php echo $curp; ?>">
                </div>
                <div class="col-md-4">
                    <label for="registro">Registro federal de contribuyentes (RFC)</label>
                    <input class="form-control" type="text" disabled id="rfc" name="nrfc" value="<?php echo $rfc; ?>">
                </div>
                <div class="col-md-4">
                    <label for="fnac">Fecha de nacimiento</label>
                    <input class="form-control" type="date" id="fnac" disabled name="nfc" value="<?php echo $nacimiento; ?>">
                </div>
            </div>
            <div class="row form-group" style="margin-top: 20px;">
                <div class="col-md-4">
                    <label for="nacionalidad">Nacionalidad</label>
                    <input class="form-control" type="text" id="nacionalidad" disabled name="nnacionalidad" value="<?php echo $nacionalidad; ?>">
                </div>
                <div class="col-md-4">
                    <label for="enac">Estado de nacimiento</label>
                    <input class="form-control" type="text" id="enac" disabled name="nenac" value="<?php echo $enacimiento; ?>">
                </div>
                <div class="col-md-4">
                    <label for="ecivil">Estado civil</label>
                    <select class="form-control" id="ecivil" disabled name="necivil">
                        <option value="0">Seleccionar. . .</option>
                        <option <?php if($ecivil === 'Soltero') echo 'selected="selected"'?>value="Soltero">Soltero</option>
                        <option <?php if($ecivil === 'Casado') echo 'selected="selected"'?>value="Casado">Casado</option>
                        <option <?php if($ecivil === 'Divorciado')?>value="Divorciado">Divorciado</option>
                        <option <?php if($ecivil === 'Viudo') echo 'selected="selected"'?>value="Viudo">Viudo</option>
                    </select>
                </div>
            </div>
            <div class="row form-group" style="margin-top: 20px;">
                <div class="col-md-4">
                    <label for="telt">Teléfono trabajo</label>
                    <input class="form-control" type="text" id="telt" name="ntelt" disabled value="<?php echo $telefonot; ?>">
                </div>
                <div class="col-md-4">
                    <label for="telc">Teléfono casa</label>
                    <input class="form-control" type="text" id="telc" name="ntelc" disabled value="<?php echo $telefonoc; ?>">
                </div>
                <div class="col-md-4">
                    <label for="email">Correo electrónico</label>
                    <input class="form-control" type="text" id="email" name="nemail" disabled value="<?php echo $correo; ?>">
                </div>
            </div>
            <div class="row form-group" style="margin-top: 20px;">
                <div class="col-md-6">
                    <label for="telt">Teléfono personal</label>
                    <input class="form-control" type="text" id="telp" name="ntelp" disabled value="<?php echo $telefonop; ?>">
                </div>
                <div class="col-md-6">
                    <label for="telc">Sexo</label>
                    <input class="form-control" type="text" id="telc" name="ntelc" disabled value="<?php echo $sexo; ?>">
                </div>
            </div>
            <div style="float: right; margin-bottom: 20px;" id="botones">
                <button class="btn btn-primary" id="btnMod" type="button" onclick="modificar(event);" name="button">Modificar</button>
            </div>
        </form>

      </div>
</div>

</div>


<script type="text/javascript" src="<?php echo base_url('assets/js/perfil.js'); ?>"></script>
<?php $this->load->view('Helpers/Global/footer') ?>
