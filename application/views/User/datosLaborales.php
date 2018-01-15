<?php $this->load->view('Helpers/User/header'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/styles/estudiosRealizadosUsuario.css') ?>">
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-3.2.1.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap-dialog.min.js'); ?>"></script>

<div class="row"><p></p></div>
<div class="row"><p></p></div>
<div class="row"><p></p></div>
<div class="row"><p></p></div>

<div class="row">
  <div class="container col-sm-10 col-sm-offset-1 col-md-10 container col-xm-12 col-md-8 col-md-offset-2">
    <section class="TituloPag">
      <h1><b>Datos Laborales</b></h1>
    </section>
  </div>
</div>

<div class="row"><p></p></div>
<div class="row"><p></p></div>
<div class="row"><p></p></div>

<div class="row">
  <div class="container col-xm-12 col-sm-10 col-sm-offset-1">
    <section class="TituloTabla">
      <h4><b>Lista de Datos Laborales.</b></h4>
    </section>
  </div>
</div>
<div class="row">
	<div class="container col-xm-12 col-sm-10 col-sm-offset-1">
		<div class="table-responsive ">
			<table  class="table table-hover" id="tablaEstudios">
				<thead id="TablaCabeza">
					<tr>
						<th>Nombramiento</th>
						<th>Dedicación</th>
						<th>Unidad Academica de abscripción</th>
						<th>Inicio de contrato</th>
						<th>Cronología</th>
						<th>Detalles</th>
					</tr>
				</thead>
				<tbody>
		    <?php
				if($datos!= null)
				{
					foreach ($datos->result() as $row){
				?>
					<tr id="TablaLinea">
						<td hidden="" id="<?= $row->idDatoslaborales?>"></td>
		        <td style="width: 23%"><?= $row->Nombramiento?></td>
		        <td style="width: 12%"><?= $row->Dedicacion?></td>
		        <td style="width: 28%"><?= $row->Unidadacademica?></td>
		        <td style="width: 15%"><?= date_format(date_create($row->Fechadeiniciocontrato), "d / m / Y")?></td>
		        <td style="width: 12%"><?= $row->Cronologia?></td>
						<td style="width: 10%"><a href="#" class="detalles" id="<?= $row->idDatoslaborales?>">Ver detalles</a></td>
					</tr>
				<?php
					}
				}
				else
				{
					echo '<tr><td colspan = "8" align="center">No tiene registros</td></tr>';
				}
				?>
				</tbody>
			</table>
		</div>
    <div class="row" align="right">
      <div class="col-sm-12 col-md-4 col-lg-4" align="left">
        <div class="error">
          <script type="text/javascript">
            $(".error").hide();
          </script>
          <p>*No ha seleccionado ningún elemento</p>
        </div>
      </div>

      <div class="col-md-4 col-lg-4" style="margin-bottom: 5px;" >
        <button class="btn btn-default" id="contratonow">Contrato actual</button>
        <button  class="btn btn-default" id="firstcontrato">Primer contrato</button>
      </div>
      <div class="col-sm-12 col-md-4 col-lg-4">
          <button class="btn btn-danger" id="delete">Eliminar</button>
          <button class="btn btn-primary" id="modify" >Modificar</button>
          <button class="btn btn-success" id="add">Agregar</button>
      </div>
      </div>
	</div>
</div>
<input type="text" name="eid" id="eid" hidden="">
<script type="text/javascript">var base_url = "<?php echo base_url();?>";</script>
<script type="text/javascript" src="<?php echo base_url('assets/js/datosLaborales.js'); ?>"></script>
</body>
</html>
