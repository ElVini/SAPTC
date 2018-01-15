<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php $this->load->view('Helpers/User/header');?>
    <meta charset="UTF-8">
    <title><?=$titulo ?></title>
    <link rel="stylesheet" href="<?php echo base_url('assets/styles/bootstrap-dialog.min.css'); ?>">
    <script src="<?php echo base_url('assets/js/jquery.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap-dialog.min.js'); ?>"></script>
    <link rel="stylesheet" href="<?php echo base_url('assets/styles/estudiosRealizadosUsuario.css'); ?>">


<div class="row"><p></p></div>
<div class="row"><p></p></div>
<div class="row"><p></p></div>
<div class="row"><p></p></div>

<div class="row">
	<div class="container col-sm-10 col-sm-offset-1 col-md-10 container col-xm-12 col-md-8 col-md-offset-2">
		<section class="TituloPag">
			<h1><b>Cuerpo Académimco</b></h1>
		</section>
	</div>
</div>

<div class="row"><p></p></div>
<div class="row"><p></p></div>
<div class="row"><p></p></div>
<!--/////////////////////////////////////////////////////////////// -->
<div class="row">
	<div class="container col-xm-12 col-sm-10 col-sm-offset-1">
		<section class="TituloTabla">
			<h4><b>Datos del Cuerpo académico</b></h4>
		</section>
	</div>
</div>

<div class="row">
	<div class="container col-xm-12 col-sm-10 col-sm-offset-1">
		<div class="table-responsive">
			<table class="table table-hover" id="tablaCA">
				<thead id="TablaCabeza">
					<tr>
						<th hidden>id</th>
						<th>Nombre del cuerpo académico</th>
            <th>Clave</th>
						<th>Grado de consolidación</th>
					</tr>
				</thead>
				<tbody>
              <tr id="tablaCuerpo">
              <?php
                if ($cuerpoAc!=NULL) {
                  foreach ($cuerpoAc->result() as $ca) {?>
                  <td hidden id="cuerpoAcaID"><?php echo $ca->idCuerpoacademico; ?></td>
                  <td><?php echo $ca->Nombre; ?></td>
                  <td><?php echo $ca->Clave; ?></td>
                  <td><?php echo $ca->Grado; ?></td>
              <?php } } else{
                echo "<td colspan='3'><center>No se encuentra en ningún Cuerpo Académico</center></td>";
              } ?>
              </tr>
				</tbody>
			</table>
		</div>
		<div id="BotonesTabla">
      <?php if($cuerpoAc==NULL) {
        echo '<button type="button" id="modificarCA" class="btn btn-success">Agregar</button>';
      } else{
        echo '<button type="button" id="eliminarCA" class="btn btn-danger">Eliminar</button> ';
        echo '<button type="button" id="modificarCA" class="btn btn-primary">Modificar</button>';
       } ?>
		</div>
	</div>
</div>

<div class="row"><p></p></div>
<div class="row"><p></p></div>
<div class="row"><p></p></div>
<div class="row"><p></p></div>
<div class="row"><p></p></div>
<div class="row"><p></p></div>

<!--/////////////////////////////////////////////////////////////// -->
<?php if ($cuerpoAc!=NULL) {
   ?>
<div class="row">
	<div class="container col-xm-12 col-sm-10 col-sm-offset-1">
		<section class="TituloTabla">
			<h4><b>Línea de generación o aplicación innovadora del conocimiento que cultiva el cuerpo académico.</b></h4>
		</section>
	</div>
</div>

<div class="row">
	<div class="container col-xm-12 col-sm-10 col-sm-offset-1">
		<div class="table-responsive">
			<table class="table table-hover" id="tablaEstudios">
				<thead id="TablaCabeza">
					<tr>
						<th hidden>id</th>
						<th>Nombre</th>
						<th>Actividades</th>
						<th>Horas a la semana</th>
					</tr>
				</thead>
				<tbody>
						<tr id="tablaLineaC">
              <?php
                foreach ($cuerpoAcLi->result() as $cal) {?>
                <td hidden><?php echo $cal->idLineageneracion; ?></td>
                <td><?php echo $cal->Nombre; ?></td>
                <td><?php echo $cal->Actividades; ?></td>
                <td><?php echo $cal->HorasSemana; ?></td>
              <?php } ?>
            </tr>
				</tbody>
			</table>
		</div>
	</div>
</div>
<?php } ?>

<script src="<?php echo base_url('assets/js/cuerpoAcademico.js'); ?>"></script>
