<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> UPSIN | SAPTC   </title>
      <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
      <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/styles/bootstrap.css') ?>">
      <link rel="stylesheet" href="<?php echo base_url('assets/styles/estudiosRealizadosUsuario.css'); ?>">
      <link rel="stylesheet" href="<?php echo base_url('assets/styles/bootstrap-dialog.min.css'); ?>">
      <script type="text/javascript" src="<?php echo base_url('assets/js/jquery-3.2.1.min.js'); ?>"></script>
      <script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
      <script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap-dialog.min.js'); ?>"></script>
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

          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="<?php echo base_url();?>" style="color:white;"><span class="glyphicon glyphicon-log-in" id="cerrar-sesion"></span > Iniciar Sesión</a></li>
          </ul>

        </div>
      </div>
    </nav>
  </header>
