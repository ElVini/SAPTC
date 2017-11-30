<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> UPSIN | SAPTC   </title>

      <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
      <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/styles/bootstrap.css') ?>">
      <link rel="stylesheet" href="<?php echo base_url('assets/styles/avisos.css'); ?>">
      <link rel="stylesheet" href="<?php echo base_url('assets/styles/zabuto_calendar.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/css/inicio_admin.css') ?>">

</head>
<body>



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
            <li><a href="<?php echo base_url(); ?>" style="color:white;"><span class="glyphicon glyphicon-home"></span> Inicio</a></li>

            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" style="color:white;">
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

            <li><a href="#" style="color:white;"><span class="glyphicon glyphicon-list-alt"></span> Actividades particulares</a> </li>

          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="<?php echo base_url('index.php/Login/logout');?>" style="color:white;"><span class="glyphicon glyphicon-log-out" id="cerrar-sesion"></span > Cerrar Sesion</a></li>
          </ul>

        </div>
      </div>
    </nav>
  </header>
