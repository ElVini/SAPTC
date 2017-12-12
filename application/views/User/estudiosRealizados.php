<?php $this->load->view('Helpers/User/header'); ?>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-3.2.1.min.js') ?>"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/styles/bootstrap.min.css') ?>">
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/styles/bootstrap-dialog.min.css') ?>">
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap-dialog.min.js') ?>"></script>
<link rel="stylesheet" href="<?php echo base_url('assets/styles/estudiosRealizadosUsuario.css'); ?>">

<script type="text/javascript">
var idsER = [
	<?php foreach ($estudios->result() as $query)
	{
		echo '"'.$query->idEstudiosrealizados.'",';
	} ?>

]
</script>

<div class="row"><p></p></div>
<div class="row"><p></p></div>
<div class="row"><p></p></div>
<div class="row"><p></p></div>

<div class="row">
	<div class="container col-sm-10 col-sm-offset-1 col-md-10 container col-xm-12 col-md-8 col-md-offset-2">
		<section class="TituloPag">
			<h1><b>Estudios Realizados</b></h1>
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
			<h4><b>Lista de Estudios Realizados</b></h4>
		</section>
	</div>
</div>


<div class="row">
	<div class="container col-xm-12 col-sm-10 col-sm-offset-1">
		<div class="table-responsive">
			<table class="table table-hover" id="tablaEstudios">
				<thead id="TablaCabeza">
					<tr>
						<!-- <th>idEstudio</th> -->
						<th>Siglas</th>
						<th>Estudios En</th>
						<!-- <th>Institucionnoconsiderada</th>
						<th>Fecha de Inicio</th>
						<th>Fecha de Fin</th>
						<th>Fecha de Obtención</th> -->
						<th>Área</th>
						<th>Disciplina</th>
						<!-- <th>País</th> -->
						<th>Institución</th>
						<th>Nivel de Estudios</th>
						<!-- <th>Id Profesor</th>
						<th>PDF</th>
						<th>Status</th> -->
						<th></th>
					</tr>
				</thead>
				<tbody>

					<?php
					if($estudios == null)
					{
						echo '<tr><td colspan = "6"><center>Aún no se cuenta con estudios realizados</center></td></tr>';
					}
					else
					{
						$x = 0;
						foreach($estudios->result() as $query)
						{
							echo '<tr id="TablaLinea" data-valor="'.$x.'">';
							//echo '<td>'.$query->idEstudiosrealizados.'</td>';
							echo '<td>'.$query->Siglas.'</td>';
							echo '<td>'.$query->Estudiosen.'</td>';
							// echo '<td>'.$query->Institucionnoconsiderada.'</td>';
							// echo '<td>'.$query->Fechadeinicio.'</td>';
							// echo '<td>'.$query->Fechadefin.'</td>';
							// echo '<td>'.$query->Fechadeobtencion.'</td>';
							echo '<td>'.$query->Area.'</td>';
							echo '<td>'.$query->Disciplina.'</td>';
							// echo '<td>'.$query->Pais.'</td>';

							echo '<td>';
							if($query->Institucion == "Otra"){
								echo $query->Institucionnoconsiderada;
							}else {
								echo $query->Institucion;
							}
							echo '</td>';
							echo '<td>'.$query->Nivelestudios.'</td>';
							// echo '<td>'.$query->Datosprofesores_idDatosprofesor.'</td>';
							// echo '<td>'.$query->PDF.'</td>';
							// echo '<td>'.$query->status.'</td>';
							echo '<td id="detalles"><a href="#">Ver detalles</a></td>';

							echo '</tr>';
							$x++;
						}
					}
				?>

				</tbody>
			</table>
		</div>
		<div id="BotonesTabla">
			<button type="button" id="EliminarB" class="btn btn-danger">Eliminar</button>
			<button type="button" id="ModificarB" class="btn btn-primary">Modificar</button>
			<button type="button" id="AgregarB" class="btn btn-success">Agregar</button>
		</div>


	</div>
</div>

<script type="text/javascript" src="<?php echo base_url('assets/js/estudiosRealizadosUsuario.js') ?>"></script>

<?php $this->load->view('User/Helpers/footer'); ?>
