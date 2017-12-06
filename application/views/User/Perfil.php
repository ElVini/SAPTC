<?php $this->load->view('Helpers/User/header'); ?>

<link rel="stylesheet" href="<?php echo base_url('assets/styles/avisos.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/styles/zabuto_calendar.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/styles/bootstrap-dialog.min.css'); ?>">
<script src="<?php echo base_url('assets/js/jquery-3.2.1.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/zabuto_calendar.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/avisos.js'); ?>"></script>
<script src="https://use.fontawesome.com/eb49eee3f9.js"></script>



<div class="row" style="background-color:#EEEEEE;">
    <center><div class="col-md-12">
        <img src="<?php echo base_url().$img ?>" height="100px" width="100px" style="border-radius: 100%;" alt="imagen de perfil">

    </div>
    <div class="col-md-12">
        <h2><?php echo $nombre. ' ' .$apellidop. ' '. $apellidom  ?></h2>
    </div></center>
</div>


    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
              <center><h1>Datos personales</h1>
            <button type="button" data-toggle="collapse" id="botonDatos" data-target="#infDesp" class="btn btn-primary" name="button">Mostrar datos</button></center>
        </div>
    </div>
    <div class="container">
    <div class="collapse" id="infDesp">
      <div class="container">

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


      <!--**************************Aqui va el calendario vergas ********************-->
      <div class="container col-xs-12 col-sm-12 col-md-12">
      	<div id="my-calendar" class="col-xs-12 col-sm-12 col-md-7 col-lg-7">
      	</div>
      	<div id="tabla-buttons" class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
      	    <div id="div-tabla" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      	        <table id="tabla" class="table table-hover">
      	            <thead>
      	                <tr>
      	                    <th colspan="3" id ="notif">Recordatorios</th>
      	                </tr>
      	                <tr>
      	                    <th>Fecha</th>
      	                    <th>Título</th>
      	                    <th>Detalles</th>
      	                </tr>
      	            </thead>
      				<tbody class="">
                    <?php
                      echo
                      '<script type="application/javascript">
                      var eventData= [];
                      var scrollCounter=0;
                      </script>';
      				foreach ($query as $usuario) {
      				 	$inputId = $usuario->idRecordatorios;
      	                $fecha = date_format(date_create($usuario->Dia),"d / m / Y");
      	                echo '<tr>
      	                      <td hidden id="id">'.$usuario->idRecordatorios.'</td>
      	                      <td hidden id="date">'.$usuario->Dia.'</td>
      	                        <td>'.$fecha.'</td>
      	                          <td id="title">'.$usuario->Titulo.'</td>
      	                            <td id ="details">'.$usuario->Descripcion.'</td>
      	                      </tr>';
      	                echo  '<script type="application/javascript">
      	                        eventData.push({date:"'.$usuario->Dia.'",badge:true,title:"'.$usuario->Titulo.'"});
      	                        if(scrollCounter > 2)
      	                        {
      	                          $("#div-tabla").addClass("scroll");
      	                        }
      	                        scrollCounter++;
      	                        </script>';
                      }
                      echo
                      '<script type="application/javascript">
                        $("#my-calendar").zabuto_calendar({
                            language:"es",
                            cell_border: true,
                            today: true,
                            weekstartson: 0,
                            data: eventData,
                          });
                      </script>';
                    ?>
                  </tbody>
      	        </table>

      	      </div>
      	      <div id="buttons">
      	        <button id="delete" class="btn btn-danger">Eliminar</button>
      	        <button id="edit" class="btn btn-primary">Modificar</button>
      	        <button id="add" class="btn btn-success">Agregar</button>
      	      </div>
      	      <div id="divParaError" class="DivELetrasrojas">
      	        <p></p>
      	      </div>
      	      <form id="formu"hidden></form>
      	    </div>
      	  </div>

<script type="text/javascript" src="<?php echo base_url('assets/js/perfil.js'); ?>"></script>
<?php $this->load->view('User/Helpers/footer') ?>
