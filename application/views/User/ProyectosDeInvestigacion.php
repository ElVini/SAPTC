<?php $this->load->view('Helpers/User/header'); ?>
<link rel="stylesheet" href="<?php echo base_url('assets/styles/estudiosRealizadosUsuario.css'); ?>">


<div class="row"><p></p></div>
<div class="row"><p></p></div>
<div class="row"><p></p></div>
<div class="row"><p></p></div>

<div class="row">
	<div class="container col-sm-10 col-sm-offset-1 col-md-10 container col-xm-12 col-md-8 col-md-offset-2">
		<section class="TituloPag">
			<h1><b>Proyectos de Investigación</b></h1>
		</section>
	</div>
</div>

<div class="row"><p></p></div>
<div class="row"><p></p></div>
<div class="row"><p></p></div>


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
						<th>Título del proyecto</th>
						<th>Fecha de inicio del proyecto</th>
						<th>Fecha de fin del proyecto</th>
						<th>Tipo de Patrocinador</th>
						<th>Para CA</th>
						<th>Mienmbros CA</th>
            <th>LGACs ind</th>
            <th>LGACs CA</th>
						<th></th>
					</tr>
				</thead>
				<tbody>


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

<?php $this->load->view('User/Helpers/footer') ?>
