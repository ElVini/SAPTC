<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<html>
<head>
    <meta charset="UTF-8">
    <title><?=$titulo ?></title>
    <link rel="stylesheet" href="<?php echo base_url('assets/styles/acc.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/styles/bootstrap.min.css'); ?>" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/inicio_admin.css'); ?>">
</head>

<?php $this->load->view('User/Helpers/headeri');?>

<div class="ini-sesion">
  <div class="container">
  	    <div class="row">
  	        <div class="col-sm-3 col-md-4 col-md-offset-4 col-lg-offset-5">
  	            <div class="login-panel panel panel-default">
  	                <div class="panel-heading" style="background-color: #2f4159; color: white;">
                       <center> <h3 class="panel-title">Inicio de Sesión</h3></center>

  	                </div>
  	                <div class="panel-body">



  	                    <form role="form" method="post" id="cuadroaccp"  action="<?=base_url('index.php/Login/ingresar')?>" novalidate>
  	                        <fieldset>
  	                            <div class="form-group">
                                  <label for="usu" class="">Usuario</label>
  	                                <input class="form-control" id="usu" placeholder="Usuario" name="usu" type="email" autofocus>
  	                            </div>
  	                            <div class="form-group">
                                  <label for="usu" class="">Contraseña</label>
  	                                <input class="form-control" id="contra" placeholder="Contraseña" name="contra" type="password" >
  	                            </div>
  	                            <div class="form-group">
  	                                <small><a href="recordar.php" >He olvidado mi contraseña</a></small>
  	                            </div>
                                <?php if(isset($error))
                                {
                                		echo 'Contraseña incorrecta';
                                }
                                ?>
  	                            <input id="btn" type="submit" value="Iniciar Sesión" class="btn btn-lg btn-primary btn-block" style="background-color: #2f4159;">
  	                        </fieldset>
  	                    </form>
  	                </div>
  	            </div>
  	        </div>
  	    </div>
  	</div>
</div>
