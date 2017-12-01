<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
    <meta charset="UTF-8">
    <title><?=$titulo ?></title>
    <link rel="stylesheet" href="<?php echo base_url('assets/styles/acc.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/styles/bootstrap.min.css'); ?>" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo base_url('assets/styles/inicio_admin.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/styles/bootstrap-dialog.min.css'); ?>">
    <script src="<?php echo base_url('assets/js/jquery.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap-dialog.min.js'); ?>"></script>

<?php $this->load->view('User/Helpers/headeri');?>


<?php
  if(isset($correo_e))
  {
      $type="TYPE_DANGER";

      switch($correo_e){
        case 1:
          $a="Lo sentimos, esa dirección de correo electrónico no está registrada.";
        break;
        case 2:
          $a="Se ha enviado con éxito la recuperación de tu contraseña.";
          $type="TYPE_SUCCESS";
        break;
        case 3:
          $a="No se ha podido enviar el correo. Intentalo de nuevo.";
        break;
      }
      echo "<script type='text/javascript'>
        BootstrapDialog.show({
            title: '¡Atención!',
            message: '".$a."',
            type: BootstrapDialog.".$type.",
            buttons: [{
                label: 'Aceptar',
                action: function(dialog) {
                    dialog.close();
                }
            }]
        });
        </script>";
  }
?>

<div class="ini-sesion">
  <div class="container">
  	    <div class="row">
  	        <div class="col-sm-3 col-md-4 col-md-offset-4 col-lg-offset-5">
  	            <div class="login-panel panel panel-default">
  	                <div class="panel-heading" style="background-color: #2f4159; color: white;">
                       <center> <h3 class="panel-title">Inicio de Sesión</h3></center>
  	                </div>
  	                <div class="panel-body">
  	                    <form role="form" method="post" id="cuadroaccp"  action="<?=base_url('index.php/Login/ingresar')?>">
  	                        <fieldset>
  	                            <div class="form-group">
                                  <label for="usu" class="">Usuario</label>
                                  <!--pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}"!-->
  	                                <input class="form-control" id="usu" placeholder="Usuario" name="usu" type="email" autofocus>
  	                            </div>
  	                            <div class="form-group">
                                  <label for="usu" class="">Contraseña</label>
  	                                <input class="form-control" id="contra" placeholder="Contraseña" name="contra" type="password" >
  	                            </div>
  	                            <div class="form-group">
  	                                <small><a id="recordarC" href="" >He olvidado mi contraseña</a></small>
  	                            </div>
                                <?php if(isset($error))
                                {
                                    echo  "
                                    <script type='text/javascript'>
                                      BootstrapDialog.show({
                                          title: '¡Atención!',
                                          message: '".$error."',
                                          type: BootstrapDialog.TYPE_DANGER,
                                          buttons: [{
                                              label: 'Aceptar',
                                              action: function(dialog) {
                                                  dialog.close();
                                              }
                                          }]
                                      });
                                      </script>";
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
<input type="hidden" id="base_url" value="<?php echo base_url();?>">
<script type="text/javascript">
  $(document).ready(function(){
    $('#recordarC').click(function(event){
      event.preventDefault();
      BootstrapDialog.show({
          title: 'Recordar contraseña.',
          size: BootstrapDialog.SIZE_SMALL,
          message: `
            <form action='' id='recordar' class='recordar' method='post'><center><div><label for='correo'>Introduzca su correo electrónico.</label></div><div class='d-inline'><input type='text' name='correoR' class='form-control' id='correoR' placeholder='Correo electrónico.'> <div id="xmail" class="hide"><h6 class="text-danger">Ingresa un email valido</h6></div></div></center></form>`,
          type: BootstrapDialog.TYPE_PRIMARY,
          buttons: [{
              label: 'Enviar',
              cssClass: 'btn-primary',
              action: function() {
                  if(caracteresCorreoValido($('#correoR').val(), '#xmail')){
                      $( "form" ).attr( "action", $("#base_url").val()+"index.php/Login/recordarContra" );
                      document.getElementById('recordar').submit();
                  }
                }
              }, {
                label: 'Cancelar',
                cssClass: 'btn-danger',
                action: function(dialog) {
                    dialog.close();
                }
          }]
      });
    });

    $(document).on('submit','.recordar',function(event){
      event.preventDefault();
      if(caracteresCorreoValido($('#correoR').val(), '#xmail')){
        $( "form" ).attr( "action", $("#base_url").val()+"index.php/Login/recordarContra" );
        document.getElementById('recordar').submit();
      }
    });

    function caracteresCorreoValido(email, div){
      var caract = new RegExp(/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/);
      if (caract.test(email) == false){
          $(div).hide().removeClass('hide').slideDown('fast');
          return false;
      }else{
          $(div).hide().addClass('hide').slideDown('slow');
          return true;
      }
    }
  });
</script>
