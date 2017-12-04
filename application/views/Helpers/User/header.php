<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?= $titulo?></title>

      <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
      <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/styles/bootstrap.css') ?>">
      <link rel="stylesheet" href="<?php echo base_url('assets/styles/bootstrap-dialog.min.css'); ?>">
      <link rel="stylesheet" href="<?php echo base_url('assets/styles/inicio_admin.css'); ?>">
      <script src="<?php echo base_url('assets/js/jquery-3.2.1.min.js'); ?>"></script>
</head>
<body>


  <input type="hidden" id="base_url" value="<?php echo base_url();?>">
  <header>
    <nav class="navbar navbar-inverse navbar-static-top" style="background-color: #2f4159;"role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navegacion-fm">
            <span class="sr-only">Desplegar / Ocultar menu</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a href="#" class="navbar-brand" style="color:white;">SAPTC</a>
        </div>
        <!--INICIA EL MENU-->

        <div class="collapse navbar-collapse" id="navegacion-fm">
          <ul class="nav navbar-nav">
               <!--PARA LA OPCION DE IR AL INICIO-->
            <li><a href="<?php echo base_url(); ?>" style="color:white;"><span class="glyphicon glyphicon-home"></span> Inicio</a></li>
            <li><a href="<?php echo base_url('index.php/User/perfil'); ?>" style="color:white;"><span class="glyphicon glyphicon-user"></span> Usuario</a></li>


   <!--PARA LA OPCION DE SERVICIO A ALUMNOS-->
            <li class="dropdown">
              <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" style="color:white;">
                <span class="glyphicon glyphicon-apple"></span> Servicios a alumnos <span class="caret"></span>
              </a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="<?php echo base_url('index.php/User/tutorias'); ?>">Tutorias</a> </li>
                <li class="divider"></li>
                <li><a href="#" >Docencias</a> </li>
                <li class="divider" ></li>
                <li><a href="#" >Dirección individualizada</a> </li>

              </ul>
            </li>
   <!--PARA LA OPCION DE ACTIVIDADES PARTICULRES-->
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" style="color:white;">
                <span class="glyphicon glyphicon-list-alt"></span> Actividades particulares <span class="caret"></span>
              </a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="<?php?>">Proyectos</a> </li>
                <li class="divider"></li>
                <li><a href="#" >LGAC</a> </li>
                <li class="divider" ></li>
                <li><a href="<?php echo base_url('index.php/User/produccion_academica')?>" >Producción Académica</a> </li>

              </ul>
            </li>

      <!--PARA LA OPCION DE ACTIVIDADES PARTICULRES-->
               <li class="dropdown">
                 <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" style="color:white;">
                   <span class="glyphicon glyphicon-education"></span> Profesor <span class="caret"></span>
                 </a>
                 <ul class="dropdown-menu" role="menu">
                   <li><a href="<?php echo base_url('index.php/User/estudiosRealizados'); ?>">Estudios Realizados</a> </li>
                   <li class="divider"></li>
                   <li><a href="<?php echo base_url('index.php/User/datosLaborales'); ?>" >Datos Laborales</a> </li>
                   <li class="divider" ></li>
                   <li><a href="<?php echo base_url('index.php/User/premiosoDisticiones'); ?>" >Premios o Distinciones</a> </li>
                   <li class="divider" ></li>
                   <li><a href="#" >Datos del Cuerpo Académico</a> </li>
                   <li class="divider" ></li>
                   <li><a href="#" >Participación en Programas Educativos</a> </li>

                 </ul>
               </li>


          </ul>
          <ul class="nav navbar-nav navbar-right">
           <li><a id="cerrarSesion" href="#"style="color:white;"><span class="glyphicon glyphicon-log-out" id="cerrar-sesion"></span > Cerrar Sesion</a></li>
          </ul>

        </div>
      </div>
    </nav>
  </header>

<script>
  var base_url = $('#base_url').val();
  $('#cerrarSesion').click(function(){
      BootstrapDialog.show({
          title: 'Cerrar sesión',
          message: '¿Seguro que desea cerrar la sesión?',
          buttons: [{
              label: 'Cancelar',
              cssClass: 'btn-default',
              action: function(dialog) {
                  dialog.close();
              }
          }, {
              label: 'Cerrar sesión',
              cssClass: 'btn-danger',
              action: function(dialog) {
                  window.location.href = base_url+'index.php/Login/logout';
              }
          }]
      });
  });
</script>
