<?php $this->load->view('Helpers/User/header'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/styles/datosLaborales.css') ?>">

<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-3.2.1.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap-dialog.min.js'); ?>"></script>

  <div class="row"><p></p></div>
  <div class="row"><p></p></div>
  <div class="row"><p></p></div>
  <div class="row"><p></p></div>
  <div class="container">
    <div class="row">
      <section class="TituloPag">
      <h1><b>Premios o Distinciones</b></h1>
      </section>
    </div>
    <div class="row"><p></p></div>
    <div class="row"><p></p></div>
    <div class="row"><p></p></div>
    <div class="row" style=" ">
      <section class="TituloTabla">
        <h4><b>Lista de Premios o Distinciones</b></h4>
      </section>
    </div>
    <div class="row"><p></p></div>
    <div class="row" style="" >
        <div class="table-responsive">
          <table class="table table-hover" id="tablaEstudios">
            <thead id="EncabezadoTabla">
              <tr>
                <td hidden><b>ID</b></td>
                <td style="width: 25%;"><b>Nombre del Premio o Distincion</b></td>
                <td style="width: 15%;"><b>Fecha</b></td>
                <td style="width: 25%;"><b>Institucion Otorgante</b></td>
                <td style="width: 35%;"><b>Motivo</b></td>
              </tr> 
            </thead>
            <tbody>
              <?php if($datos!= null)
                    { foreach ($datos as $row){
              ?>
              <tr id="TablaLinea" onclick="datos('<?php echo $row->idPremios?>')">
                <td><?= $row->Nombre?></td>
                <td><?= date_format(date_create($row->Fecha), "d / m / Y")?></td>
                <?php foreach($inst->result() as $raw){
                  if($row->Instituciones_idInstituciones== $raw->idInstituciones ){
                ?>
                <td><?= $raw->Nombre ?></td>
              <?php } }?>
                <td><?= $row->Motivo?></td>
              </tr>
              <?php }}
                else
                { echo '<tr><td colspan = "5" align="center">No tiene registros</td></tr>';
                }
              ?>
             </tbody>
          </table>
        </div>
    </div>
  </div>
  <div align="center" >
    <div class="row">
      <div class="col-sx-12 col-sm-7 col-md-8 col-lg-8">
        <div class=" error">
        	<script type="text/javascript">
        		$(".error").hide();
        	</script>
        	<p>*No ha seleccionado ningun elemento</p>
        </div>
      </div>
      <div class="col-sx-12 col-sm-5 col-md-4 col-lg-4">
        <button class="btn btn-danger" id="delete">Eliminar</button>
        <button class="btn btn-primary" id="modify" >Modificar</button>
        <button class="btn btn-success" id="add">Agregar</button>
      </div>
    </div>
  </div>
  <input type="text" name="id_p" id="id_p" hidden="">
  <script type="text/javascript">var base_url = "<?php echo base_url();?>";</script>
  <script type="text/javascript" src="<?php echo base_url('assets/js/premiosoDistinciones.js'); ?>"></script>
