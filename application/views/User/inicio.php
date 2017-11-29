<?php $this->load->view('User/Helpers/header'); ?>

<script src="<?php echo base_url('assets/js/jquery-3.2.1.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/zabuto_calendar.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/avisos.js'); ?>"></script>


<div class="row container col-xs-12 col-sm-12 col-md-12">
	<div id="my-calendar" class="col-xs-12 col-sm-12 col-md-12 col-lg-7">
	</div>
	<div id="tabla-buttons" class="col-xs-12 col-sm-12 col-md-12 col-lg-5">
	    <div id="div-tabla" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	        <table id="tabla" class="table table-hover">
	            <thead>
	                <tr>
	                    <th colspan="3" id ="notif">Recordatorios</th>
	                </tr>
	                <tr>
	                    <th>Fecha</th>
	                    <th>Titulo</th>
	                    <th>Detalles</th>
	                </tr>
	            </thead>
	            <tbody class="">
	            </tbody>
	        </table>

	      </div>
	      <div id="buttons">
	        <button id="delete" class="btn btn-danger">Eliminar</button>
	        <button id="edit" class="btn btn-primary">Modificar</button>
	        <button id="add" class="btn btn-success">Agregar</button>
	      </div>
	      <div id="divPrueba">
	        <form id="formulario" method="post">
	          <input type="text" hidden id="idrecordatorios" name="idrecordatorios"value="">
	          <label>Fecha: </label>
	          <input type="date" id="fecha" name="date" value="" class="form-control">
	          <label>Titulo: </label>
	          <input type="text" id="titulo" name="title" value="" class="form-control">
	          <label>Descripcion: </label>
	          <input type="text" id="descripcion" name="description" value="" class="form-control"><br>
	          <button id="send" class="send btn btn-primary" value="">Enviar</button>
	          <button id="cancel" class="btn btn-danger">Cancelar</button>
	          <p id="error"></p>
	        </form>
	      </div>
	      <div  id="divParaError" class="DivELetrasrojas">
	        <p>Por favor seleccione una fila</p>
	      </div>
	      <script> $("#divPrueba").hide();</script>
	      <form id="formu"hidden></form>
	    </div>
	  </div>

<?php $this->load->view('User/Helpers/footer'); ?>