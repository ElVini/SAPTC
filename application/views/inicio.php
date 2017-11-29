<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<html>
<head>
    <meta charset="UTF-8">
    <title><?=$titulo ?></title>
    <link rel="stylesheet" href="<?php echo base_url('assets/styles/acc.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/styles/bootstrap.min.css'); ?>" crossorigin="anonymous">
</head>

<?php $this->load->view('User/Helpers/headeri');?>
<div id="subtitulo">
 <h1>Inicio de Sesión</h1>
</div>

<div id="cuadroaccp">
 <form id="cuadroacc" method="post" action="<?php echo base_url('index.php/Login/ingresar'); ?>" class="container" novalidate>

         <div class="letra">
         	<label for="usu"></label>
            <input type="text" class="form-control" id="usu" placeholder="Usuario:" name="usu">
         </div>

         <div class="letra">
         	<label for="contra"></label>
            <input type="password" class="form-control" id="contra"  placeholder="Contraseña:" name="contra">
         </div>

       <div id="divolvidado">
           <a href="recordar.php">He olvidado mi contraseña.</a>
       </div>
       <?php if(isset($error))
       {
       		echo 'Contraseña incorrecta';
       }
       ?>

       <div class="enviarbtn">
           <button id="btn" type="submit" class="btn btn-outline-primary">Enviar</button>
     </div>
 </form>
</div>
</html>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-3.2.1.min.js'); ?>"></script>
