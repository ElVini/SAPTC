<?php $this->load->view('User/Helpers/header'); ?>


<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/styles/style.css'); ?>">
<div class="container">
	<div class="page-header">
		<h1>Tutorías</h1>
	</div>
</div>
<div class="container">
	<input id="url" hidden type="text" value="<?php echo base_url(); ?>">
	<div class="row tabla">
		<table class="table table-hover table-responsive">
			<tr>
				<th>Tutorías</th>
				<th>Nivel</th>
				<th>Fecha de inicio</th>
				<th>Fecha de término</th>
			</tr>
			<tbody id="tabla">
				<?php
					if($tutorias == null)
					{
						echo '<tr><td colspan = "5"><center>Aún no se cuenta con tutorías asignadas</center></td></tr>';
					}
					else
					{
						$posiscion = 1;
						foreach($tutorias->result() as $query)
						{
							echo '<tr name = "'.$query->idTutoria.'" onclick="getValue('.$query->idTutoria. ','.$posiscion.');">';
							echo '<td><input hidden type="text" value="'.$query->idTutoria.'" id="del"><a class="tutoria">Tutoría - Tutoría '.$query->Tipo.'</a></td>';
							echo '<td>'.$query->Nivelestudios.'</td>';
							echo '<td>'.$query->Fechainicio.'</td>';
							echo '<td>'.$query->Fechafin.'</td>';
							echo '</tr>';
							$posiscion++;
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
		<button class="btn btn-primary boton" id="btnMod" onclick="obtener()">Modificar</button>
		<button class="btn btn-primary boton" id="btnAdd">Agregar</button>
	</div>
	<h1 id="msjError"></h1>
</div>
<div hidden class="container" id="content">
	<div class="container formulario" id="container">
	<form method="post" id="formulario" action="<?php echo base_url('index.php/User/agregarTutoria') ?>">
		<div class="row form-group">
			<div class="col-md-4">
				<label for="nivel">Nivel:</label>
				<select id="nivel" name="nivel" class="form-control">
					<option value="0">Seleccionar. . .</option>
					<option value="Doctorado">Doctorado</option>
					<option value="Especialidad">Especialidad</option>
					<option value="Especialidad médica">Especialidad médica (CIFRHS)</option>
					<option value="Licenciatura">Licenciatura</option>
					<option value="Maestría">Maestría</option>
					<option value="Técnico">Técnico</option>
					<option value="Técnico superior universitario">Técnico superior universitario</option>
				</select>
			</div>

			<div class="col-md-4">
				<label for="programa">Programa educativo:</label>
				<select id="programa" name="programa" class="form-control">
					<option value="0">Seleccionar. . .</option>
					<option value="Ing. en informática">Ing. en informática</option>
					<option value="Ing. en nanotecnología">Ing. en nanotecnología</option>
					<option value="Ing. en mecatrónica">Ing. en mecatrónica</option>
					<option value="Ing. en biomédica">Ing. en biomédica</option>
					<option value="Ing. en bioteconología">Ing. en biotecnología</option>
					<option value="Ing. en energía">Ing. en energía</option>
					<option value="Ing. en teconología ambiental">Ing. en tecnología ambiental</option>
					<option value="Ing. en animación y efectos visuales">Ing. en animación y efectos visuales</option>
					<option value="Ing. en logística y transporte">Ing. en logísitca y transporte</option>
					<option value="Lic. en terapia fisica">Lic. en Terapía física</option>
					<option value="Lic. en administración y gestión de PyMes">Lic. en administración y gestión de PyMes</option>
					<option value="Maestría en enseñanza de las ciencas">Maestría en enseñanza de las ciencias</option>
					<option value="Maestría en ciencias aplicadas">Maestría en ciencias aplicadas</option>
				</select>
			</div>

			<div class="col-md-4">
				<label for="tipo">Tipo:</label>
				<select id="tipo" name="tipo" class="form-control" onchange="append()">
					<option value="0">Seleccionar. . .</option>
					<option value="Grupal">Grupal</option>
					<option value="Individual">Individual</option>
				</select>
			</div>
		</div>

		<div class="row form-group">
			<div class="col-md-4" id="grupal">

			</div>

			<div class="col-md-4">
				<label for="fechaInicio">Fecha de inicio:</label>
				<input type="date" class="form-control" name="fechaInicio" id="fechaInicio">
			</div>

			<div class="col-md-4">
				<label for="fechaFin">Fecha de término:</label>
				<input type="date" class="form-control" name="fechaFin" id="fechaFin">
			</div>
		</div>

		<div class="row form-group">
			<div class="col-md-4">
				<label for="estado">Estado:</label>
				<select id="estado" name="estado" class="form-control">
					<option value="0">Seleccionar. . .</option>
					<option value="En proceso">En proceso</option>
					<option value="Concluida">Concluida</option>
				</select>
			</div>
		</div>
	</form>
	<div class="form-group">
		<button class="btn btn-danger" id="btnCancel" onclick="cancelar(event);">Cancelar</button>
		<button class="btn btn-primary" id="btnGuardar">Guardar</button>
	</div>
	<p id="error"></p>
	</div>
</div>

<?php $this->load->view('User/Helpers/footer'); ?>
<script type="text/javascript" src="<?php echo base_url('assets/js/script.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/form.js'); ?>"></script>
<script type="text/javascript">
	function valnumero(e) {
		numeros = "01233456789";
		del = [8, 9, 127, 37, 38, 46, 164];
		tecla = e.keyCode || e.which;
		teclado = String.fromCharCode(tecla);
		teclado_especial = false;
		for (var i in del) {
			if (tecla==del[i]) {
				teclado_especial = true;
				break;
			}
		}
		if (numeros.indexOf(teclado)==-1 && !teclado_especial) {
			return false;
		}
	}
	function append() {
		var opcion = document.getElementById('tipo');
		var numero = opcion.options[opcion.selectedIndex].value;
		var grupal = document.getElementById('grupal');
		if(numero === "Grupal"){
			while(grupal.hasChildNodes()) {
				grupal.removeChild(grupal.lastChild);
			}
			var label = document.createElement('label');
			label.setAttribute('for','numEdu');
			label.innerHTML = "Número de estudiantes:"
			var input = document.createElement('input');
			input.type = 'text';
			input.setAttribute('name', 'n');
			input.setAttribute('id', 'numEdu');
			input.setAttribute('class', 'form-control');
			input.setAttribute('onkeypress', 'return valnumero(event)');
			grupal.appendChild(label);
			grupal.appendChild(input);
		}
		if(numero === "Individual") {
			while(grupal.hasChildNodes()) {
				grupal.removeChild(grupal.lastChild);
			}
			var label = document.createElement('label');
			label.setAttribute('for','nombreEdu');
			label.innerHTML = "Nombre del estudiante:"
			var input = document.createElement('input');
			input.type = 'text';
			input.setAttribute('name', 'n');
			input.setAttribute('id', 'nombreEdu');
			input.setAttribute('class', 'form-control');
			grupal.appendChild(label);
			grupal.appendChild(input);
		}
	}
</script>
