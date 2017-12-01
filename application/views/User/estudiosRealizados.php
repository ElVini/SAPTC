<?php $this->load->view('Helpers/User/header'); ?>

<link rel="stylesheet" href="<?php echo base_url('assets/css/estudiosRealizadosUsuario.css'); ?>">

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
						<td hidden><b>IDest</b></td>
						<td><b>Nivel de Estudios</b></td>
						<td><b>Área</b></td>
						<td><b>Ámbito</b></td>
						<td><b>Inició el</b></td>
						<td><b>Finalizó el</b></td>
					</tr>
				</thead>
				<tbody>

					<?php

							//echo '<tr id="TablaLinea">';

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



<?php $this->load->view('User/Helpers/footer'); ?>
