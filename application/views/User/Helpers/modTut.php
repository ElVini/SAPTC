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
