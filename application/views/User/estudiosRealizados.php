<?php $this->load->view('User/Helpers/header'); ?>


<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/styles/style.css'); ?>">
<div class="container">
	<div class="page-header">
		<h1>Estudios Realizados</h1>
	</div>
</div>
<div class="container">
	<input id="url" hidden type="text" value="<?php echo base_url(); ?>">
	<div class="row tabla">
		<table class="table table-hover table-responsive">
			<tr>
				<th>idEstudio</th>
				<th>Siglas</th>
				<th>Estudios En</th>
				<th>Institucionnoconsiderada</th>
				<th>Fecha de Inicio</th>
				<th>Fecha de Fin</th>
				<th>Fecha de Obtención</th>
				<th>Área</th>
				<th>Disciplona</th>
				<th>País</th>
				<th>Institución</th>
				<th>Nivel de Estudios</th>
				<th>Id Profesor</th>
				<th>PDF</th>
				<th>Status</th>
			</tr>
			<tbody id="tabla">
				<?php
					if($estudios == null)
					{
						echo '<tr><td colspan = "13"><center>Aún no se cuenta con estudios realizados</center></td></tr>';
					}
					else
					{
						foreach($estudios->result() as $query)
						{
							echo '<tr>';
							echo '<td>'.$query->idEstudiosrealizados.'</td>';
							echo '<td>'.$query->Siglas.'</td>';
							echo '<td>'.$query->Estudiosen.'</td>';
							echo '<td>'.$query->Institucionnoconsiderada.'</td>';
							echo '<td>'.$query->Fechadeinicio.'</td>';
							echo '<td>'.$query->Fechadefin.'</td>';
							echo '<td>'.$query->Fechadeobtencion.'</td>';
							echo '<td>'.$query->Area.'</td>';
							echo '<td>'.$query->Disciplina.'</td>';
							echo '<td>'.$query->Pais.'</td>';
							echo '<td>'.$query->Institucion.'</td>';
							echo '<td>'.$query->Nivelestudios.'</td>';
							echo '<td>'.$query->Datosprofesores_idDatosprofesor.'</td>';
							echo '<td>'.$query->PDF.'</td>';
							echo '<td>'.$query->status.'</td>';
							echo '</tr>';
						}
					}
				?>
			</tbody>
		</table>
	</div>
</div>
<div class="container" id="botones">
	<div class="row left form-group">
		<button class="btn btn-danger boton" id="btnDel">Eliminar</button>
		<button class="btn btn-primary boton" id="btnMod">Modificar</button>
		<button class="btn btn-primary boton" id="btnAdd">Agregar</button>
	</div>
	<h1 id="msjError"></h1>
</div>


<?php $this->load->view('User/Helpers/footer'); ?>
