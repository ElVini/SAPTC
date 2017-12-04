<!DOCTYPE html>
<html>
  <head>
    <meta name=viewport width=device-width initial-scale=1 >
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/styles/bootstrap.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/styles/header-user-dropdown.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/styles/color.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/styles/bootstrap-dialog.min.css'); ?>">

    <title><?=$titulo ?></title>
  </head>

<body>

<header class="color header-user-dropdown">

  <div class="header-limiter">
    <h1><a href="#">SAPTC</a></h1>

    <nav class="center">
      <a href="<?php echo base_url(); ?>">Inicio</a>
      <a href="<?php echo base_url('index.php/User/tutorias'); ?>">Servicios a alumnos</a>
      <div class="hiden-submenu">
        <a href="#">Tutorías</a>
        <a href="#">Docencias</a>
        <a href="#">Dirección individualizada</a>
      </div>
      <a href="#">Actividades particulares</a>
      <a href="#">Profesor</a>
      <a href="<?php echo base_url('index.php/Login/logout'); ?>">Cerrar sesión</a>
    </nav>

    <div class="user-image">
      <a href="#"><img src="assets/2.jpg" alt="User Image"/></a>
    </div>

  </div>

</header>
