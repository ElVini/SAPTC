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
      <h1><b>Participación en Programas Educativos</b></h1>
    </section>
  </div>
</div>

<div class="row"><p></p></div>
<div class="row"><p></p></div>
<div class="row"><p></p></div>

<div class="row">
  <div class="container col-xm-12 col-sm-10 col-sm-offset-1">
    <section class="TituloTabla">
      <h4><b>Lista de Participación en Programas Educativos.</b></h4>
    </section>
  </div>
</div>
<div class="row">
  <div class="container col-xm-12 col-sm-10 col-sm-offset-1">
    <div class="table-responsive">
      <table class="table table-hover" id="tablaEstudios">
        <thead id="TablaCabeza">
          <tr>
            <td hidden><b>ID</b></td>
            <th style="width: 25%">Nombre del Programa Educativo</th>
            <th style="width: 25%">Grado de intervención</th>
            <th style="width: 14%">Fecha del cambio</th>
            <th style="width: 26%">Descripcion</th>
            <th style="width: 10%">Archivo</th>
          </tr>
        </thead>
        <tbody>
          <?php if($data!= null)
                { foreach ($data->result() as $row){
          ?>
          <tr id="TablaLinea">
            <td hidden="" id="<?= $row->idParticipacion ?>"></td>
            <td><?= $row->Programaeducativo?></td>
            <td><?= $row->nombre ?></td>
            <td><?= date_format(date_create($row->Fechaimplementacion), "d / m / Y")?></td>
            <td><?= $row->Descripcion ?></td>
            <td><?= '<a href="'.base_url().'index.php/User/archivo/'.$row->idParticipacion.'" target="_blank" >Abrir archivo</a>'?></td>
          <?php }}
            else
            { echo '<tr><td colspan = "5" align="center">No tiene registros</td></tr>';
            }
          ?>
        </tr>
        </tbody>
      </table>
    </div>
    <div class="row" align="right">
      <div class="col-sm-12 col-md-8 col-lg-8" align="left">
        <div class="error">
          <script type="text/javascript">
            $(".error").hide();
          </script>
          <p>*No ha seleccionado ningún elemento</p>
        </div>
      </div>
      <div class="col-sm-12 col-md-4 col-lg-4">
        <button class="btn btn-danger" type="button" id="delete">Eliminar</button>
        <button class="btn btn-primary" type="button" id="modify" >Modificar</button>
        <button class="btn btn-success" type="button" id="add">Agregar</button>
      </div>
    </div>
  </div>
</div>


<input type="text" name="id_p" id="id_p" hidden="">
<script type="text/javascript">var base_url = "<?php echo base_url();?>";</script>
<script type="text/javascript" src="<?php echo base_url('assets/js/participacionPrograma.js'); ?>"></script>
<!--<?php $this->load->view('Helpers/Global/footer'); ?>-->
